<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {

        try {
            $data = $request->validate([
            'name'=>'required',
            'description'=>'required'
            ]);

            // Create a new instance of the model for the data we want to save
            Product::Create(['name'=>$data['name'] , 'description'=>$data['description']]);
            
            return response()->json(['message' => "Product successfully created."], 200);
        }catch (\Exception $e) {
            // Return Json Response     
            return response()->json(['message' => "'Something went really wrong!'+$e"], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id): JsonResponse
    {
        try{
            $product = Product::find($id);
                if (!$product) {
                    return response()->json(['message' => 'Product Not Found.'], 404);
                }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->save();
            return response()->json(['message' => "Product successfully updated."], 200);
        } catch (\Exception $e) {
            // Return Json Response       
            return response()->json(['message' => "Something went really wrong! $e"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $product = Product::find($id);
        if($product){
            $product -> delete();
            return response()->json(['message' => "Product successfully deleted."], 200);
        }
        else{
            
            return response()->json(['message' => "Product not found."], 200);
        }
        
        
    }
}
