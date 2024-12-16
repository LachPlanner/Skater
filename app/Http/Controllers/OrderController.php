<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a list of the user's orders.
     */
    public function index()
    {
        $user = Auth::user();

        if(!$user) {
            return redirect('login');
        }

        // Hent brugerens ordrer med deres items og produkter
        $orders = Order::with(['items.product.variant'])->where('user_id', Auth::id())->get();

        return Inertia::render('User/OrderHistory', [
            'orders' => $orders,
        ]);
    }

    public function adminIndex()
    {
        // Kontroller om brugeren er admin
        if (Auth::guard('admin')->check()) {
            // Hent alle ordrer med deres items og produkter
            $orders = Order::with('items.product.variant')->orderBy('order_date', 'desc')->get();

            return inertia('Admin/Orders', [
                'orders' => $orders,
            ]);
        }
    }

    /**
     * Store a new order and clear the cart.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if(!$user) {
            return redirect('login');
        }

        // Validering af input
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        // Hent brugerens eksisterende cart
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();

        // Tjek, om kurven eksisterer og har items
        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['error' => 'Your cart is empty'], 400);
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

        return redirect()->route('cart.index')->with('success', 'Order completed successfully');
    }
}

