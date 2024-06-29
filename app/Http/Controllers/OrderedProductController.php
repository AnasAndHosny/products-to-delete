<?php

namespace App\Http\Controllers;

use App\Models\OrderedProduct;
use App\Http\Requests\StoreOrderedProductRequest;
use App\Http\Requests\UpdateOrderedProductRequest;

class OrderedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderedProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderedProduct $orderedProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderedProduct $orderedProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderedProductRequest $request, OrderedProduct $orderedProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderedProduct $orderedProduct)
    {
        //
    }
}
