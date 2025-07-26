<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $stats = [
                'total_books' => Buku::count(),
                'total_categories' => Kategori::count(),
                'total_users' => User::where('role', 'user')->count(),
                'active_borrowings' => Peminjaman::where('status', 'dipinjam')->count(),
            ];
            
            $recentBorrowings = Peminjaman::with(['user', 'buku'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
                
            return view('dashboard.admin', compact('stats', 'recentBorrowings'));
        } else {
            $stats = [
                'borrowed_books' => Peminjaman::where('user_id', $user->id)
                    ->where('status', 'dipinjam')
                    ->count(),
                'returned_books' => Peminjaman::where('user_id', $user->id)
                    ->where('status', 'dikembalikan')
                    ->count(),
                'total_books' => Buku::count(),
            ];
            
            $recentBorrowings = Peminjaman::with('buku')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
                
            return view('dashboard.user', compact('stats', 'recentBorrowings'));
        }
    }
}
