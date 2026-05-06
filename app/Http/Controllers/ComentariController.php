<?php

namespace App\Http\Controllers;

use App\Models\Comentari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentariController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cotxe_id' => 'required|exists:cotxes,id',
            'descripcio' => 'required',
        ]);

        Comentari::create([
            'cotxe_id' => $request->cotxe_id,
            'descripcio' => $request->descripcio,
            'user_id' => Auth::id(),
        ]);

        return back();
    }

    public function update(Request $request, Comentari $comentari)
    {
        $this->authorizeOwner($comentari);

        $comentari->update($request->only([
            'descripcio'
        ]));
        return back();
    }

    public function destroy(Comentari $comentari)
    {
        $this->authorizeOwner($comentari);

        $comentari->delete();

        return back();
    }

    private function authorizeOwner(Comentari $comentari)
    {
        if (Auth::id() !== $comentari->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
    }
}