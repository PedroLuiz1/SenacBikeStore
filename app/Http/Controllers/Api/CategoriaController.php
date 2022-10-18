<?php

namespace App\Http\Controllers\Api;

use App\http\Requests\StoreCategoriaRequest;
use App\http\Controllers\Controller;
use App\http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias = Categoria::all();

        //Captura a coluna para ordenação
        $sortParameter = $request->input('ordenacao', 'nome_da_categoria');
        $sortDirection = Str::startswith($sortParameter, '-') ? 'desc' : 'asc';
        $sortColumn = ltrim($sortParameter, '-');

        //Determina se faz a query ordenada ou aplica a default
        if($sortColumn == 'nome_da_categoria') {
            $categorias = Categoria::orderBy('nomedacategoria', $sortDirection)->get();
        }
        else {
            $categorias = Categoria::all();
        }

        return response() -> json([
            'status' => 200,
            'mensagem' => __("categoria.listreturn"),
            'categorias' => CategoriaResource::collection($categorias)
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeCategoriaRequest $request)
    {
        $categoria = new Categoria();

        $categoria->nomedacategoria = $request->nome_da_categoria;

        $categoria->save();

        return response() -> json([
            'status' => 200,
            'mensagem' => __("categoria.created"),
            'categoria' => new CategoriaResource ($categoria)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        $categoria = Categoria::find($categoria->pkcategoria);

        return response() -> json ([
            'status' => 200,
            'mensagem' => __("categoria.returned"),
            'categoria' => new CategoriaResource ($categoria)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoriaRequest $request, Categoria $categoria)
    {
        $categoria = Categoria::find($categoria->pkcategoria);
        $categoria->nomedacategoria = $request->nome_da_categoria;
        $categoria->update();

        return response() -> json ([
            'status' => 200,
            'mensagem' => __("categoria.updated")
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response() -> json([
            'status' => 200,
            'mensagem' => __("categoria.deleted")
        ], 200);
    }
}
