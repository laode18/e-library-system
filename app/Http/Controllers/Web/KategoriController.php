<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $categories = Kategori::withCount('bukus')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:kategoris',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Kategori::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function show($id)
    {
        $category = Kategori::with('bukus')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Kategori::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Kategori::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $id,
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = Kategori::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
