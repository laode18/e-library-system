<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();
        
        return response()->json([
            'message' => 'Books retrieved successfully',
            'data' => $bukus
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $buku = Buku::create($request->all());
        $buku->load('kategori');

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $buku
        ], 201);
    }

    public function show($id)
    {
        $buku = Buku::with('kategori')->find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Book retrieved successfully',
            'data' => $buku
        ]);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'sometimes|string|max:255',
            'penulis' => 'sometimes|string|max:255',
            'penerbit' => 'sometimes|string|max:255',
            'kategori_id' => 'sometimes|exists:kategoris,id',
            'stok' => 'sometimes|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $buku->update($request->all());
        $buku->load('kategori');

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $buku
        ]);
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ]);
    }
}
