<?php

namespace App\Http\Controllers\Api;

use App\Models\Quadra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuadraApiController extends Controller
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

        $quadras = $query->get();
        return response()->json($quadras);
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
            
            $quadra = Quadra::create($validated);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'data' => $quadra
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => 'Erro ao criar quadra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $quadra = Quadra::findOrFail($id);
            DB::beginTransaction();
            
            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'tipo' => 'required|string|max:255',
                'disponivel' => 'required|boolean',
                'descricao' => 'nullable|string',
            ]);
            
            $quadra->update($validated);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'data' => $quadra
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => 'Erro ao atualizar quadra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $quadra = Quadra::findOrFail($id);
            DB::beginTransaction();
            
            $quadra->delete();
            
            DB::commit();
            
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => 'Erro ao remover quadra: ' . $e->getMessage()
            ], 500);
        }
    }
}
