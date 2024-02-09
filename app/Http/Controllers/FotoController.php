<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index()
    {
        $foto = Foto::get();
        $album = Album::get();

        return view('admin.foto', compact('foto', 'album'));
    }
    public function store(Request $request)
    {
        // Validate the request (add more validations as needed)
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file->move(("foto"), $imageName);

        if (auth()->check()) {
            $foto = Foto::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'file' => $imageName,
                'albumid' => $request->album,
                'userid' => auth()->user()->id,
            ]);
        } else {
            // Handle the case where no user is authenticated
        }

        // Redirect or return a response
        if ($foto) {
            return redirect('/')->with('success', 'Buku Berhasil Ditambahkan.');
        } else {
            // Handle error case
            return redirect('/')->with('error', 'Failed to add Buku.');
        }
    }
    public function update(Request $request)
    {
        if ($request->hasFile('cover')) {
            $request->validate([
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imageName = time() . '_' . $request->file('cover')->getClientOriginalName();
            $request->cover->move(("cover_buku"), $imageName);

            $buku = Buku::where('id', $request->id)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'cover' => $imageName,
                'halaman' => $request->halaman,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahunterbit' => $request->tahunterbit,
                'stock' => $request->stock,
            ]);

            KategoriRelasi::where('bukuid', $request->id)->delete();

            // Insert records into KategoriRelasi for each selected category
            foreach ($request->kategori as $kategoriid) {
                KategoriRelasi::create([
                    'bukuid' => $request->id,
                    'kategoriid' => $kategoriid,
                ]);
            }
        } else {
            $buku = Buku::where('id', $request->id)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'halaman' => $request->halaman,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahunterbit' => $request->tahunterbit,
                'stock' => $request->stock,
            ]);

            KategoriRelasi::where('bukuid', $request->id)->delete();

            // Insert records into KategoriRelasi for each selected category
            foreach ($request->kategori as $kategoriid) {
                KategoriRelasi::create([
                    'bukuid' => $request->id,
                    'kategoriid' => $kategoriid,
                ]);
            }
        }

        // Redirect or return a response
        if ($buku) {
            return redirect('buku')->with('success', 'Buku Berhasil Diedit.');
        } else {
            // Handle error case
            return redirect('buku')->with('error', 'Failed to edit Buku.');
        }
    }
    public function delete(Request $request)
    {
        $buku = Buku::where('id', $request->id)->delete();

        KategoriRelasi::where('bukuid', $request->id)->delete();

        // Redirect or return a response
        if ($buku) {
            return redirect('buku')->with('success', 'Buku Berhasil Dihapus.');
        } else {
            // Handle error case
            return redirect('buku')->with('error', 'Failed to delete Buku.');
        }
    }
}
