<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search === null) {
            $foto = Foto::orderBy('id', 'desc')->get();
        } else {
            $foto = Foto::where("judul", "like", "%" . $search . "%")->orderBy('id', 'desc')->get();
        }

        return view('main.home', compact('foto'));
    }
    public function viewfoto($id)
    {
        // Get the currently logged-in user ID
        $userId = Auth::id();
        $foto = Foto::findOrFail($id);
        $komentar = Komentar::where('fotoid', $id)->get();
        $like = Like::where('fotoid', $id)->get();

        $album = Album::where('userid', Auth::id())->get();

        // Check if the current user has liked the photo
        $isLiked = $like->where('userid', $userId)->isNotEmpty();

        // Random
        $random = Foto::whereNotIn('id', [$id])->inRandomOrder()->take(15)->get();

        return view('main.viewfoto', compact('foto', 'komentar', 'like', 'isLiked', 'album', 'random'));
    }
    public function storefoto(Request $request)
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
        }

        // Redirect or return a response
        if ($foto) {
            return redirect('/');
        } else {
            // Handle error case
            return redirect('/');
        }
    }
    public function editfoto(Request $request)
    {
        if ($request->hasFile('file')) {
            // Validate the request (add more validations as needed)
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imageName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file->move(("foto"), $imageName);

            if (auth()->check()) {
                $foto = Foto::where('id', $request->id)->update([
                    'judul' => $request->judul,
                    'deskripsi' => $request->deskripsi,
                    'file' => $imageName,
                    'albumid' => $request->album,
                    'userid' => auth()->user()->id,
                ]);
            }
        }

        if (auth()->check()) {
            $foto = Foto::where('id', $request->id)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'albumid' => $request->album,
                'userid' => auth()->user()->id,
            ]);
        }

        return redirect("/view-foto/{$request->id}");
    }
    public function deletefoto(Request $request)
    {
        if (auth()->check()) {
            $foto = Foto::where('id', $request->id)->delete();

            Komentar::where('fotoid', $request->id)->delete();
            Like::where('fotoid', $request->id)->delete();
        }

        // Redirect or return a response
        if ($foto) {
            return redirect("/");
        } else {
            // Handle error case
            return redirect('/');
        }
    }
    public function komentar(Request $request)
    {
        if (auth()->check()) {
            $komentar = Komentar::create([
                'fotoid' => $request->id,
                'userid' => auth()->user()->id,
                'isi' => $request->isi,
            ]);
        }


        return redirect("/view-foto/{$request->id}");
    }
    public function like($id)
    {
        $user = Auth::user();

        if ($user) {
            $like = Like::where('fotoid', $id)->where('userid', $user->id)->first();

            if ($like) {
                // User has already liked, so unlike
                $like->delete();
            } else {
                // User hasn't liked, so like
                Like::create(['fotoid' => $id, 'userid' => $user->id]);
            }

            return redirect("/view-foto/{$id}");
        }
    }
    public function myfoto(Request $request)
    {
        $search = $request->search;

        $query = Foto::where("userid", Auth::id());

        if ($search !== null) {
            $query->where("judul", "like", "%" . $search . "%");
        }

        $foto = $query->orderBy('created_at', 'desc')->get();

        // Group photos by month
        $groupedFoto = $foto->groupBy(function ($item) {
            return $item->created_at->format('F Y');
        });

        return view('main.myfoto', compact('groupedFoto'));
    }
    public function myalbum(Request $request)
    {
        $search = $request->search;

        $query = Album::where("userid", Auth::id());

        if ($search !== null) {
            $query->where("judul", "like", "%" . $search . "%");
        }

        $albums = $query->orderBy('created_at', 'asc')->get();

        return view('main.myalbum', compact('albums'));
    }
    public function viewalbum($id)
    {
        // Get the currently logged-in user ID
        $userId = Auth::id();
        $album = Album::findOrFail($id);

        if($album->userid !== Auth::id()){
            return redirect("/");
        }

        $foto = Foto::where("albumid", $id)->orderBy('id', 'desc')->get();

        return view('main.viewalbum', compact('album', 'foto'));
    }
    public function storealbum(Request $request)
    {
        if (auth()->check()) {
            $album = Album::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'userid' => auth()->user()->id,
            ]);
        }

        return redirect('/myalbum');
    }
    public function editalbum(Request $request)
    {
        if (auth()->check()) {
            $album = Album::where('id', $request->id)->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'userid' => auth()->user()->id,
            ]);
        }

        return redirect("/view-album/{$request->id}");
    }
    public function deletealbum(Request $request)
    {
        if (auth()->check()) {
            $album = Album::where('id', $request->id)->delete();
        }

        // Redirect or return a response
        if ($album) {
            return redirect("/myalbum");
        } else {
            // Handle error case
            return redirect("/myalbum");
        }
    }
}
