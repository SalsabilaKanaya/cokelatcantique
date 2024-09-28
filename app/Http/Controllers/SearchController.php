<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisCokelat;
use App\Models\KarakterCokelat;

class SearchController extends Controller
{
    protected $pages = [
        ['title' => 'Tentang Kami', 'content' => 'Informasi tentang perusahaan kami.', 'route' => 'user.tentang'],
        ['title' => 'Kontak Kami', 'content' => 'Cara menghubungi kami.', 'route' => 'user.kontak'],
        ['title' => 'Cara Pemesanan', 'content' => 'Panduan cara memesan.', 'route' => 'user.cara_pemesanan'],
        ['title' => 'FAQ', 'content' => 'Pertanyaan yang sering diajukan.', 'route' => 'user.faq'],
        ['title' => 'Gift Idea', 'content' => 'Ide Hadiah', 'route' => 'user.gift_idea'],
        ['title' => 'Produk', 'content' => 'Produk', 'route' => 'user.jenis_cokelat'],
        ['title' => 'Karakter', 'content' => 'Karakter cokelat', 'route' => 'user.karakter_cokelat'],
        ['title' => 'Testimoni', 'content' => 'Testimoni dari pelanggan kami', 'route' => 'beranda', 'anchor' => '#testimoni'],
    ];

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Pencarian jenis cokelat
        $jenisCokelats = JenisCokelat::where('nama', 'LIKE', "%{$query}%")
                                     ->orWhere('kategori', 'LIKE', "%{$query}%")
                                     ->get();

        // Pencarian karakter cokelat
        $karakterCokelats = KarakterCokelat::where('nama', 'LIKE', "%{$query}%")
                                           ->orWhere('kategori', 'LIKE', "%{$query}%")
                                           ->get();

        // Pencarian halaman informasi
        $pages = collect($this->pages)->filter(function ($page) use ($query) {
            return stripos($page['title'], $query) !== false || stripos($page['content'], $query) !== false;
        });

        // Jika hanya satu halaman ditemukan, arahkan ke halaman tersebut
        if ($pages->count() === 1) {
            $page = $pages->first();
            return redirect()->route($page['route']);
        }

        // Log hasil pencarian untuk debugging
        \Log::info('Jenis Cokelat:', $jenisCokelats->toArray());
        \Log::info('Karakter Cokelat:', $karakterCokelats->toArray());

        return view('user.search_results', compact('jenisCokelats', 'karakterCokelats', 'pages', 'query'));
    }
}