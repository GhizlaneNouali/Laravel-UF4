<?php

namespace App\Http\Controllers;

use App\Models\Mod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cotxe_id' => 'required|exists:cotxes,id',
            'nom' => 'required',
        ]);

        Mod::create([
            'nom' => $request->nom,
            'descripcio' => $request->descripcio,
            'tipus' => $request->tipus,
            'imatge' => $request->imatge,
            'cotxe_id' => $request->cotxe_id,
        ]);
        return back();
    }

    public function update(Request $request, Mod $mod)
    {
        $this->authorizeOwner($mod);

        $mod->update($request->all());

        return back();
    }

    public function destroy(Mod $mod)
    {
        $this->authorizeOwner($mod);

        $mod->delete();

        return back();
    }

    private function authorizeOwner(Mod $mod)
    {
        if (Auth::id() !== $mod->cotxe->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
    }
}