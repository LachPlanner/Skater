<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Hent hele kurven (index)
    public function index()
    {
        // Hent kurv fra session
        $cart = session()->get('cart', []);
        return response()->json(['cart' => $cart]);
    }

    // Tilføj et produkt til kurven (store)
    public function store(Request $request)
    {
        // Validér indkommende data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Hent produktet fra databasen
        $product = Product::findOrFail($validated['product_id']);

        // Tilføj til session (kurv)
        $cart = session()->get('cart', []);

        // Hvis produktet allerede er i kurven, opdater mængden
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $validated['quantity'];
        } else {
            // Ellers tilføj produkt til kurven
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->variant->variant_name,
                'price' => $product->price,
                'quantity' => $validated['quantity'],
            ];
        }

        // Gem kurven i session
        session(['cart' => $cart]);

        return response()->json(['message' => 'Product added to cart', 'cart' => $cart]);
    }

    // Fjern et produkt fra kurven (destroy)
    public function destroy(Request $request)
    {
        // Validér indkommende data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Hent kurv fra session
        $cart = session()->get('cart', []);

        // Fjern produktet fra kurven
        if (isset($cart[$validated['product_id']])) {
            unset($cart[$validated['product_id']]);
            session(['cart' => $cart]);
        }

        return response()->json(['message' => 'Product removed from cart', 'cart' => $cart]);
    }

    // Ryd hele kurven
    public function clear()
    {
        // Ryd hele kurven
        session()->forget('cart');
        return response()->json(['message' => 'Cart cleared']);
    }
}

