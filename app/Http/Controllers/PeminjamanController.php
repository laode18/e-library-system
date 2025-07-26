<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->isAdmin()) {
            $peminjamans = Peminjaman::with(['user', 'buku'])->get();
        } else {
            $peminjamans = Peminjaman::with(['buku'])
                ->where('user_id', $user->id)
                ->get();
        }

        return response()->json([
            'message' => 'Borrowing history retrieved successfully',
            'data' => $peminjamans
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buku_id' => 'required|exists:bukus,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $buku = Buku::find($request->buku_id);

        if ($buku->stok <= 0) {
            return response()->json([
                'message' => 'Book is out of stock'
            ], 400);
        }

        // Check if user already borrowed this book and hasn't returned it
        $existingBorrow = Peminjaman::where('user_id', $request->user()->id)
            ->where('buku_id', $request->buku_id)
            ->where('status', 'dipinjam')
            ->first();

        if ($existingBorrow) {
            return response()->json([
                'message' => 'You have already borrowed this book and haven\'t returned it yet'
            ], 400);
        }

        $peminjaman = Peminjaman::create([
            'user_id' => $request->user()->id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => Carbon::now()->toDateString(),
            'status' => 'dipinjam'
        ]);

        // Decrease book stock
        $buku->decrement('stok');

        $peminjaman->load(['user', 'buku']);

        return response()->json([
            'message' => 'Book borrowed successfully',
            'data' => $peminjaman
        ], 201);
    }

    public function returnBook(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'message' => 'Borrowing record not found'
            ], 404);
        }

        $user = $request->user();

        // Check if user is admin or the borrower
        if (!$user->isAdmin() && $peminjaman->user_id !== $user->id) {
            return response()->json([
                'message' => 'Unauthorized to return this book'
            ], 403);
        }

        if ($peminjaman->status === 'dikembalikan') {
            return response()->json([
                'message' => 'Book has already been returned'
            ], 400);
        }

        $peminjaman->update([
            'tanggal_kembali' => Carbon::now()->toDateString(),
            'status' => 'dikembalikan'
        ]);

        // Increase book stock
        $peminjaman->buku->increment('stok');

        $peminjaman->load(['user', 'buku']);

        return response()->json([
            'message' => 'Book returned successfully',
            'data' => $peminjaman
        ]);
    }
}
