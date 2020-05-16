<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Cart;
use DB;


class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $allProducts = Product::paginate(10);
        $carts=DB::table('carts')->whereNotNull('code')->get();
        $usuarios=DB::table('users')->get();
        return view('admin.pedidos.pedidospage')->with(compact('allProducts','carts','usuarios')); 
         // Listado de productos
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       $carts2=DB::table('carts')->where('code',$id)->get();
       $detalles=DB::table('cart_details')->where('cart_id',$carts2[0]->id)->get();
       $usuario=DB::table('users')->where('id',$carts2[0]->user_id)->get();
       $products=DB::table('products')->get();
       return view('admin.pedidos.show')->with(compact('carts2','usuario','detalles','products')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
