<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function home()
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Vui lòng đăng nhập.');
        }
        $products = Product::orderBy('created_at', 'desc')->take(8)->get();
        // return response()->json($products);
        return view('home', ['products' => $products]);
    }

    public function getProducts()
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Vui lòng đăng nhập.');
        }

        $products = Product::paginate(8);
        return view('products.products', compact('products'));
    }

    public function getProductDetail($productId)
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Vui lòng đăng nhập.');
        }

        $product = Product::findOrFail($productId);
        return view('products.productdetail', ['product' => $product]);
    }

    public function search(Request $request)
    {
        $key = $request->get('key');
        $products = Product::search()->paginate(8);
        return view('products.products', compact('products'));
    }

    public function cartDetail()
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Vui lòng đăng nhập.');
        }

        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->first();

        if ($cart) {
            $cartItems = $cart->items()->with('product')->paginate(4);

            // Lam moi cache cua moi quan he items
            $cart->load('items');

            $totalQuantity = $cart->items->sum('quantity');
            $totalPrice = 0;

            foreach ($cart->items as $item) {
                $totalPrice += $item->quantity * $item->product->price;
            }
        } else {
            $cartItems = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 4);
            $totalQuantity = 0;
            $totalPrice = 0;
        }

        return view('products.carts', [
            'cartItems' => $cartItems,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice
        ]);
    }

    public function addToCart(Request $request)
    {
        $user_id = Auth::id();
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $cart = Cart::where('user_id', $user_id)->first();

        // Kiem tra neu gio hang chua co trong user thi tao gio hang
        if (!$cart) {
            $cart = Cart::create(['user_id' => $user_id]);
        }

        $cartItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {
            // Neu nhu da ton tai san pham trong cart thi cap nhat so luong san pham
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }
        // Lay url cua trang truoc do
        $previousUrl = session()->get('previous_url');

        if ($previousUrl) {
            return redirect()->to($previousUrl);
        } else {
            return redirect()->route('home');
        }
    }

    public function deleteCart(Request $request)
    {
        $user_id = Auth::id();

        $product_id = $request->input('product_id');


        $cart = Cart::where('user_id', $user_id)->first();

        if ($cart) {
            $cartItem = $cart->items->where('product_id', $product_id)->first();

            if ($cartItem) {
                $cartItem->delete();

                // Lam moi cache cua moi quan he items
                $cart->load('items');

                // tinh lai tong so luong va gia de tra ve ajax
                $totalQuantity = $cart->items->sum('quantity');
                $totalPrice = 0;

                foreach ($cart->items as $item) {
                    $totalPrice += $item->quantity * $item->product->price;
                }

                return response()->json([
                    'success' => true,
                    'totalQuantity' => $totalQuantity,
                    'totalPrice' => number_format($totalPrice, 0, ',', '.')
                ]);
            }
        }

        return response()->json(['success' => false]);
    }

    public function updateCart(Request $request)
    {
        $user_id = Auth::id();

        $product_id = $request->productId;
        $quantity = $request->quantity;

        $cart = Cart::where('user_id', $user_id)->first();

        if ($cart) {
            $cartItem = $cart->items->where('product_id', $product_id)->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();

                // Lam moi cache cua moi quan he items
                $cart->load('items');

                // tinh lai tong so luong va gia de tra ve ajax
                $totalQuantity = $cart->items->sum('quantity');
                $totalPrice = 0;
                $pricePerProduct = $cartItem->product->price * $cartItem->quantity;

                foreach ($cart->items as $item) {
                    $totalPrice += $item->quantity * $item->product->price;
                }

                return response()->json([
                    'success' => true,
                    'totalQuantity' => $totalQuantity,
                    'totalPrice' => number_format($totalPrice, 0, ',', '.'),
                    'pricePerProduct' =>  number_format($pricePerProduct, 0, ',', '.'),
                ]);
            }
        }

        return response()->json(['success' => false]);
    }
}
