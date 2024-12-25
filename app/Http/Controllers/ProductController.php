<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index()
{
    // Hent kun varianter med model_id 1, 3 eller 5 og deres tilknyttede produkt
    $variants = Variant::with('product')
        ->whereIn('model_id', [1, 3, 5])
        ->orderBy('id')
        ->get();

    return inertia('Admin/Dashboard', [
        'variants' => $variants,
    ]);
}


    /**
     * Update the price of a product.
     */
    public function update(Request $request, $id)
    {
        // Validér data
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        // Find produktet
        $product = Product::findOrFail($id);

        // Opdater prisen
        $product->update([
            'price' => $validated['price'],
        ]);

        return redirect()->back()->with('success', 'Product price updated successfully.');
    }
}

