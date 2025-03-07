<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brick;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:bricks,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $productId = $data['product_id'];
        $quantity = $data['quantity'];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Brick::find($productId);
            $cart[$productId] = [
                'id'       => $product->id,
                'name'     => $product['name_' . app()->getLocale()],
                'price'    => $product->price,
                'quantity' => $quantity,
                'image'    => $product->images->first() ? $product->images->first()->image : null,
            ];
        }
        session()->put('cart', $cart);
        $totalCount = array_sum(array_column($cart, 'quantity'));
        $cartHtml = view('partials.cart', ['cart' => $cart])->render();

        return response()->json([
            'message'    => 'Product added to cart successfully!',
            'cart_html'  => $cartHtml,
            'total_count' => $totalCount,
        ]);
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required'
        ]);

        $cart = session()->get('cart', []);
        $productId = $data['product_id'];
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        session()->put('cart', $cart);
        $totalCount = collect($cart)->sum('quantity');
        $cartHtml = view('partials.cart', ['cart' => $cart])->render();

        return response()->json([
            'message'    => 'Item removed successfully!',
            'cart_html'  => $cartHtml,
            'total_count' => $totalCount,
        ]);
    }

    public function update(Request $request)
    {
        $quantities = $request->input('quantities', []);
        $cart = session()->get('cart', []);
        foreach ($quantities as $productId => $quantity) {
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
            }
        }
        session()->put('cart', $cart);
        $totalCount = collect($cart)->sum('quantity');
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        return response()->json([
            'message'     => 'Cart updated successfully!',
            'total_count' => $totalCount,
            'subtotal'    => number_format($subtotal, 2),
            'order_total' => number_format($subtotal, 2)
        ]);
    }

    public function viewCart(Request $request)
    {
        $cart = session('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    public function updateSingle(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity'   => 'required|integer|min:0',
        ]);
        $productId = $request->product_id;
        $quantity  = $request->quantity;
        $cart      = session()->get('cart', []);
        if (isset($cart[$productId])) {
            if ($quantity < 1) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
        }
        session()->put('cart', $cart);
        $totalCount = collect($cart)->sum('quantity');
        $subtotal   = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $cartHtml = view('partials.cart', ['cart' => $cart])->render();
        return response()->json([
            'message'     => 'Cart updated successfully!',
            'cart_html'   => $cartHtml,
            'total_count' => $totalCount,
            'subtotal'    => number_format($subtotal, 2),
            'order_total' => number_format($subtotal, 2), 
        ]);
    }
}
