<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $productos = Productos::orderBy('id', 'asc')->get();
        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sku' => ['unique:productos']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        } else {
            $producto = new Productos();
            $producto->categoria_id = $request->input('categoria_id');
            $producto->nombre = $request->input('nombre');
            $producto->precio = $request->input('precio');
            $producto->sku = $request->input('sku');
            $producto->save();
            return response()->json($producto);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $producto = Productos::findOrFail($id);
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $producto = Productos::findOrFail($id);
        $producto->categoria_id = $request->input('categoria_id', $producto->categoria_id);
        $producto->nombre = $request->input('nombre', $producto->nombre);
        $producto->precio = $request->input('precio', $producto->precio);
        $producto->sku = $request->input('sku', $producto->sku);
        $producto->save();
        return response()->json($producto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->delete();
        return response()->json($producto);
    }
}
