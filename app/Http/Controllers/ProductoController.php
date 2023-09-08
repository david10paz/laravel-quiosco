<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoCollection;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductoCollection(Producto::where('disponible', 1)->orderBy('id', 'DESC')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->disponible = 0;
        $producto->save();
        
        return[
            'message' => $producto->nombre . ' -> Ya no disponible'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }


    //Sacamos los productos agotados
    public function productos_agotados(){
        return new ProductoCollection(Producto::where('disponible', 0)->orderBy('id', 'DESC')->get());
    }


    //Recuperamos el producto agotado
    public function recuperar_producto_agotado(Request $request, Producto $producto)
    {
        $producto->disponible = 1;
        $producto->save();
        
        return[
            'message' => $producto->nombre . ' -> Disponible de nuevo'
        ];
    }
}
