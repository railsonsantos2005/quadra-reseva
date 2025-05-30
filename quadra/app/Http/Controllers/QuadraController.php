<?php

namespace App\Http\Controllers;

use App\Models\Quadra;
use Illuminate\Http\Request;

class QuadraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Quadra::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                   ->orWhere('tipo', 'like', "%{$search}%")
                   ->orWhere('descricao', 'like', "%{$search}%");
            });
        }

        $quadras = $query->paginate(9);
        return view('quadras.index', compact('quadras', 'search'));
    }

    public function create()
    {
        return view('quadras.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'tipo' => 'required|string|max:255',
                'disponivel' => 'required|boolean',
                'descricao' => 'nullable|string',
            ]);
            
            Quadra::create($validated);
            
            DB::commit();
            
            return redirect()->route('quadras.index')
                ->with('success', 'Quadra criada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors(['error' => 'Erro ao criar quadra: ' . $e->getMessage()]);
        }
    }

    public function edit(Quadra $quadra)
    {
        return view('quadras.edit', compact('quadra'));
    }

    public function update(Request $request, Quadra $quadra)
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'tipo' => 'required|string|max:255',
                'disponivel' => 'required|boolean',
                'descricao' => 'nullable|string',
            ]);
            
            $quadra->update($validated);
            
            DB::commit();
            
            return redirect()->route('quadras.index')
                ->with('success', 'Quadra atualizada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors(['error' => 'Erro ao atualizar quadra: ' . $e->getMessage()]);
        }
    }

    public function destroy(Quadra $quadra)
    {
        try {
            DB::beginTransaction();
            
            $quadra->delete();
            
            DB::commit();
            
            return redirect()->route('quadras.index')
                ->with('success', 'Quadra removida com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors(['error' => 'Erro ao remover quadra: ' . $e->getMessage()]);
        }
    }
}
