<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    // Hent den nuværende brugers kurv
    public function index()
    {
        $user = Auth::user();

        if(!$user) {
            return redirect('login');
        }

        // Hent eller opret brugerens kurv
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Hent alle kurv-items med produkter
        $cartItems = $cart->items()->with('product.variant')->get();

        // Beregn totalpris
        $totalPrice = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->price * $item->quantity);
        }, 0);

        return Inertia::render('Checkout/Cart', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    // Tilføj et produkt til kurven
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validér data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Hent eller opret brugerens kurv
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Find produktet
        $product = Product::findOrFail($validated['product_id']);

        // Kontrollér om produktet allerede er i kurven
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Opdater mængden, hvis produktet allerede er i kurven
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            // Tilføj produktet som nyt item
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'price' => $product->price, // Gem prisen fra produktet
            ]);
        }

        // Returner den opdaterede kurv
        $cartItems = $cart->items()->with('product')->get();
    }

    // Fjern et produkt fra kurven
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Validér data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Hent brugerens kurv
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        // Fjern item fra kurven
        $cartItem = $cart->items()->where('product_id', $validated['product_id'])->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        // Returner den opdaterede kurv
        $cartItems = $cart->items()->with('product')->get();
        return response()->json(['message' => 'Product removed from cart', 'cart' => $cartItems]);
    }

    // Ryd hele kurven
    public function clear()
    {
        $user = Auth::user();

        // Hent brugerens kurv
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        // Slet alle items i kurven
        $cart->items()->delete();

        return response()->json(['message' => 'Cart cleared']);
    }
}


