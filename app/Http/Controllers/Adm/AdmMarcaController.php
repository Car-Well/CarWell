<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\MarcaCarros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdmMarcaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:100', 'unique:marca_carros,nome'],
        ]);

        MarcaCarros::create(['nome' => strtoupper(trim($request->nome))]);

        return redirect()->route('adm.carros.index')->with('success', 'Marca adicionada com sucesso.');
    }

    public function updateLogo(Request $request, MarcaCarros $marca)
    {
        $request->validate([
            'logo' => ['required', 'image', 'max:2048'],
        ]);

        if ($marca->logo) {
            Storage::disk('public')->delete($marca->logo);
        }

        $path = $request->file('logo')->store('marcas', 'public');
        $marca->update(['logo' => $path]);

        return redirect()->route('adm.carros.index')->with('success', 'Logo atualizada com sucesso.');
    }

    public function destroy(MarcaCarros $marca)
    {
        if ($marca->logo) {
            Storage::disk('public')->delete($marca->logo);
        }

        $marca->delete();

        return redirect()->route('adm.carros.index')->with('success', 'Marca removida.');
    }
}
