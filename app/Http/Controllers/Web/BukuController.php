<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }
        
        $books = $query->paginate(12);
        $categories = Kategori::all();
        
        return view('books.index', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Buku::with('kategori')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function create()
    {
        $categories = Kategori::all();
        return view('books.create', compact('categories'));
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
            return back()->withErrors($validator)->withInput();
        }

        Buku::create($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $book = Buku::findOrFail($id);
        $categories = Kategori::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Buku::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Buku::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
