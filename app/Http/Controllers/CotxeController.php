<?php

namespace App\Http\Controllers;

use App\Models\Cotxe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CotxeController extends Controller
{
    public function index()
    {
        $cotxes = Cotxe::with('user')->latest()->get();
        return view('cotxes.index', compact('cotxes'));
    }

    public function create()
    {
        return view('cotxes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required',
            'any' => 'required|integer',
        ]);

        Cotxe::create([
            'model' => $request->model,
            'any' => $request->any,
            'descripcio' => $request->descripcio,
            'imatge_principal' => $request->imatge_principal,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('cotxes.index');
    }

    public function show(Cotxe $cotxe)
    {
        $cotxe->load(['user', 'mods', 'comentaris.user']);
        return view('cotxes.show', compact('cotxe'));
    }
    public function edit(Cotxe $cotxe)
    {
        $this->authorizeOwner($cotxe);

        return view('cotxes.edit', compact('cotxe'));
    }

    public function update(Request $request, Cotxe $cotxe)
    {
        $this->authorizeOwner($cotxe);

        $cotxe->update($request->only([
            'model',
            'any',
            'descripcio',
            'imatge_principal'
        ]));
        return redirect()->route('cotxes.index');
    }

    public function destroy(Cotxe $cotxe)
    {
        $this->authorizeOwner($cotxe);

        $cotxe->delete();

        return redirect()->route('cotxes.index');
    }

    private function authorizeOwner(Cotxe $cotxe)
    {
        if (Auth::id() !== $cotxe->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
    }
}