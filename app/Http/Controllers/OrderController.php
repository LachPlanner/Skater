<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a list of the user's orders.
     */
    public function index()
    {
        $user = Auth::user();

        // Hent brugerens ordrer med deres items og produkter
        $orders = Order::with('items.product')
            ->where('user_id', $user->id)
            ->orderBy('order_date', 'desc')
            ->get();

        return inertia('Orders/OrderList', [
            'orders' => $orders,
        ]);
    }

    /**
     * Store a new order and clear the cart.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validering af input
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        // Hent eller opret brugerens cart
        $cart = $user->cart()->firstOrCreate([]);

        // Load relaterede items og produkter
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        // Beregn totalbeløbet
        $totalAmount = $cart->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        // Opret ordren
        $order = Order::create(array_merge($validatedData, [
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
            'order_date' => now(),
        ]));

        // Opret order items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Slet cart og items
        $cart->items()->delete();
        $cart->delete();

        return response()->json(['message' => 'Order completed successfully'], 200);
    }
}

