<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_items;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'note' => 'nullable|string',
            'order_type' => 'required|in:dine-in,takeaway,delivery',
            'table_number' => 'nullable|integer',
            'status' => 'required|in:pending,preparing,completed,cancelled',
            'employee_id' => 'required|exists:employees,id',
            'total_price' => 'required|numeric|min:0'
        ]);
        
        $order = Order::create($validatedData);
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'note' => 'sometimes|nullable|string',
            'order_type' => 'sometimes|required|in:dine-in,takeaway,delivery',
            'table_number' => 'sometimes|nullable|integer',
            'status' => 'sometimes|required|in:pending,preparing,completed,cancelled',
            'employee_id' => 'sometimes|required|exists:employees,id',
            'total_price' => 'sometimes|required|numeric|min:0'
        ]);

        $order = Order::findOrFail($id);
        $order->update($validatedData);

        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['Orden elinimada correctamente', 200]);
    }
}
