<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        
        return response()->json([
            'message' => 'Categories retrieved successfully',
            'data' => $kategoris
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:kategoris',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori = Kategori::create($request->all());

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $kategori
        ], 201);
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Category retrieved successfully',
            'data' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori->update($request->all());

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $kategori
        ]);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}
