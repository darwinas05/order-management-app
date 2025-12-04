<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $query = Product::query();

      if ($request->has('search')) { 
        $search = $request->get('search');
        $query->where(function ($q) use ($search){
            $q->where('name', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%");
        });
      }

      //filtro segun categoria
      if($request->has('type')) {
        $query->where('type', $request->get('type'));
      }

     //filtro segun rango de precio
     if($request->has('min_price')){
        $query->where('price', '>=',$request->get('min_price'));
     }
     if($request->has('max_price')){
        $query->where('price', '<=',$request->get('max_price'));
     }

     //filtrado segun estado (disponible o no)
     if($request->has('status')){
        $query->where('status',$request->get('status'));
     }

     $perPage = $request->get('per_page',10);
     $products = $query->orderBy('created_at', 'desc')->paginate($perPage);

     return response()->json($products);

    }

    /**
     * Store a newly created resource in storage.
     * En esté metodo se de ben validar los datos recibidos 
     * y crear un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:food,drink,snack,dessert,other',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([            
            'type' => 'required|in:food,drink,snack,dessert,other',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|in:available,unavailable',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.'],201);
    }
}
