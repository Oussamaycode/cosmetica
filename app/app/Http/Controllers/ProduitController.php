<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Produit::all();
        return response()->json(['products'=>$products,200]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        $product=Product::create($request->all);
        return response()->json(['product'=>$product,201]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        return response()->json(['name'=>$produit->name,'description'=>$produit->description,'price'=>$produit->price],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
    {
       return $this->authorize('update');
       $produit->update[$request->all];
       return response()->json(['name'=>$produit->name,'description'=>$produit->description,'price'=>$produit->price],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        //
    }
}
