<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Carro;
use App\Models\CarroFoto;
use App\Models\MarcaCarros;
use App\Services\GcsStorage;
use Illuminate\Http\Request;

class AdmCarroController extends Controller
{
    public function __construct(){
        $this->middleware('admin.autenticado');
    }
    
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

        $carros = $query->with(['capa', 'fotos'])->get();

        $kpis = [
            'total' => (int) Carro::count(),
            'disponivel' => (int) Carro::where('status', 'disponivel')->count(),
            'reservado' => (int) Carro::where('status', 'reservado')->count(),
            'vendido' => (int) Carro::where('status', 'vendido')->count(),
        ];

        $marcas = MarcaCarros::orderBy('nome')->get();
        $q = (string) $request->get('q', '');
        $status = (string) $request->get('status', 'all');

        return view('adm.admGerCar', compact('carros', 'kpis', 'marcas', 'q', 'status'));
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
            'categoria' => ['nullable', 'string', 'max:100'],
            'destacado' => ['nullable', 'boolean'],
            'descricao' => ['nullable', 'string'],
            'capa' => ['nullable', 'image', 'max:4096'],
            'fotos' => ['nullable', 'array'],
            'fotos.*' => ['image', 'max:4096'],
        ]);

        if (!empty($data['destacado'])) {
            Carro::query()->update(['destacado' => false]);
        }

        $carro = Carro::create($data);

        if ($request->hasFile('capa')) {
            $path = GcsStorage::store($request->file('capa'), 'carros');
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
                $path = GcsStorage::store($file, 'carros');
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
            'categoria' => ['nullable', 'string', 'max:100'],
            'descricao' => ['nullable', 'string'],
            'capa' => ['nullable', 'image', 'max:4096'],
            'fotos' => ['nullable', 'array'],
            'fotos.*' => ['image', 'max:4096'],
        ]);

        $carro->update(collect($data)->except(['capa', 'fotos'])->toArray());

        if ($request->hasFile('capa')) {
            $path = GcsStorage::store($request->file('capa'), 'carros');

            $capaAtual = $carro->capa()->first();
            if ($capaAtual) {
                GcsStorage::delete($capaAtual->path);
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
                GcsStorage::delete($carro->foto);
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
                $path = GcsStorage::store($file, 'carros');
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

    public function destacar(Carro $carro)
    {
        $carro->update(['destacado' => !$carro->destacado]);

        $msg = $carro->destacado
            ? '"' . $carro->marca . ' ' . $carro->modelo . '" adicionado ao destaque da home.'
            : '"' . $carro->marca . ' ' . $carro->modelo . '" removido do destaque.';

        return redirect()->route('adm.carros.index')->with('success', $msg);
    }

    public function destroy(Carro $carro)
    {
        foreach ($carro->fotos()->get() as $foto) {
            GcsStorage::delete($foto->path);
        }

        $carro->delete();

        return redirect()->route('adm.carros.index')->with('success', 'Carro excluído com sucesso.');
    }

}

