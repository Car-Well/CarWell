<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Carro;
use App\Models\CarroFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdmCarroController extends Controller
{
    public function index(Request $request)
    {
        $query = Carro::orderBy('id', 'desc');

        if ($request->filled('q')) {
            $q = trim((string) $request->get('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('marca', 'like', '%' . $q . '%')
                    ->orWhere('modelo', 'like', '%' . $q . '%')
                    ->orWhere('ano', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('status') && $request->get('status') !== 'all') {
            $query->where('status', $request->get('status'));
        }

        $carros = $query->with(['capa'])->get();

        $kpis = [
            'total' => (int) Carro::count(),
            'disponivel' => (int) Carro::where('status', 'disponivel')->count(),
            'reservado' => (int) Carro::where('status', 'reservado')->count(),
            'vendido' => (int) Carro::where('status', 'vendido')->count(),
        ];

        return view('adm.admGerCar', compact('carros', 'kpis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'marca' => ['required', 'string', 'max:255'],
            'modelo' => ['required', 'string', 'max:255'],
            'ano' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'cor' => ['nullable', 'string', 'max:255'],
            'km' => ['nullable', 'integer', 'min:0'],
            'preco' => ['required', 'numeric', 'min:0'],
            'combustivel' => ['nullable', 'in:flex,gasolina,diesel,eletrico,hibrido'],
            'cambio' => ['nullable', 'in:manual,automatico,cvt'],
            'status' => ['required', 'in:disponivel,reservado,vendido'],
            'descricao' => ['nullable', 'string'],
            'capa' => ['nullable', 'image', 'max:4096'],
            'fotos' => ['nullable', 'array'],
            'fotos.*' => ['image', 'max:4096'],
        ]);

        $carro = Carro::create($data);

        $dir = storage_path('app/public/carros');
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }

        if ($request->hasFile('capa')) {
            $path = $request->file('capa')->store('carros', 'public');
            CarroFoto::create([
                'carro_id' => $carro->id,
                'path' => $path,
                'is_capa' => true,
                'ordem' => 0,
            ]);
            $carro->foto = $path;
            $carro->save();
        }

        if ($request->hasFile('fotos')) {
            $ordem = 1;
            foreach ((array) $request->file('fotos') as $file) {
                if (!$file) {
                    continue;
                }
                $path = $file->store('carros', 'public');
                CarroFoto::create([
                    'carro_id' => $carro->id,
                    'path' => $path,
                    'is_capa' => false,
                    'ordem' => $ordem++,
                ]);
            }
        }

        return redirect()->route('adm.carros.index')->with('success', 'Carro criado com sucesso.');
    }

    public function update(Request $request, Carro $carro)
    {
        $data = $request->validate([
            'marca' => ['required', 'string', 'max:255'],
            'modelo' => ['required', 'string', 'max:255'],
            'ano' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'cor' => ['nullable', 'string', 'max:255'],
            'km' => ['nullable', 'integer', 'min:0'],
            'preco' => ['required', 'numeric', 'min:0'],
            'combustivel' => ['nullable', 'in:flex,gasolina,diesel,eletrico,hibrido'],
            'cambio' => ['nullable', 'in:manual,automatico,cvt'],
            'status' => ['required', 'in:disponivel,reservado,vendido'],
            'descricao' => ['nullable', 'string'],
            'capa' => ['nullable', 'image', 'max:4096'],
            'fotos' => ['nullable', 'array'],
            'fotos.*' => ['image', 'max:4096'],
        ]);

        $carro->update($data);

        $dir = storage_path('app/public/carros');
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }

        if ($request->hasFile('capa')) {
            $path = $request->file('capa')->store('carros', 'public');

            $capaAtual = $carro->capa()->first();
            if ($capaAtual) {
                Storage::disk('public')->delete($capaAtual->path);
                $capaAtual->update(['path' => $path]);
            } else {
                CarroFoto::create([
                    'carro_id' => $carro->id,
                    'path' => $path,
                    'is_capa' => true,
                    'ordem' => 0,
                ]);
            }

            if ($carro->foto && $carro->foto !== $path) {
                Storage::disk('public')->delete($carro->foto);
            }
            $carro->foto = $path;
            $carro->save();
        }

        if ($request->hasFile('fotos')) {
            $ordem = (int) ($carro->fotos()->max('ordem') ?? 0);
            foreach ((array) $request->file('fotos') as $file) {
                if (!$file) {
                    continue;
                }
                $path = $file->store('carros', 'public');
                CarroFoto::create([
                    'carro_id' => $carro->id,
                    'path' => $path,
                    'is_capa' => false,
                    'ordem' => ++$ordem,
                ]);
            }
        }

        return redirect()->route('adm.carros.index')->with('success', 'Carro atualizado com sucesso.');
    }

    public function destroy(Carro $carro)
    {
        foreach ($carro->fotos()->get() as $foto) {
            Storage::disk('public')->delete($foto->path);
        }

        $carro->delete();

        return redirect()->route('adm.carros.index')->with('success', 'Carro excluído com sucesso.');
    }
    public function __construct(){
        $this->middleware('admin.autenticado');
    }
}

