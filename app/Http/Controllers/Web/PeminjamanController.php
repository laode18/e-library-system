<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $borrowings = Peminjaman::with('buku')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('borrowings.index', compact('borrowings'));
    }

    public function adminIndex()
    {
        $borrowings = Peminjaman::with(['user', 'buku'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('borrowings.admin', compact('borrowings'));
    }

    public function store(Request $request)
    {
        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Buku sedang tidak tersedia!');
        }

        // Check if user already borrowed this book and hasn't returned it
        $existingBorrow = Peminjaman::where('user_id', auth()->id())
            ->where('buku_id', $request->buku_id)
            ->where('status', 'dipinjam')
            ->first();

        if ($existingBorrow) {
            return back()->with('error', 'Anda sudah meminjam buku ini dan belum mengembalikannya!');
        }

        Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => Carbon::now()->toDateString(),
            'status' => 'dipinjam'
        ]);

        // Decrease book stock
        $buku->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam!');
    }

    public function returnBook($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = auth()->user();

        // Check if user is admin or the borrower
        if (!$user->isAdmin() && $peminjaman->user_id !== $user->id) {
            return back()->with('error', 'Anda tidak memiliki akses untuk mengembalikan buku ini!');
        }

        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan!');
        }

        $peminjaman->update([
            'tanggal_kembali' => Carbon::now()->toDateString(),
            'status' => 'dikembalikan'
        ]);

        // Increase book stock
        $peminjaman->buku->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }
}
