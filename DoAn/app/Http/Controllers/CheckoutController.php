<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $productIds = json_decode($request->input('products'), true);
        $quantities = json_decode($request->input('quantities'), true);

        session(['checkout_products' => $productIds, 'quantities' => $quantities]);

        return redirect()->route('checkout.detail');
    }

    public function showCheckoutPage()
    {
        $productIds = session('checkout_products', []);
        $quantities = session('quantities', []);

        if (is_null($productIds) || empty($productIds)) {

            return view('products.checkout', ['checkoutProducts' => []]);
        } else {
            $checkoutProducts = Product::whereIn('product_id', $productIds)->get();
            return view('products.checkout', ['checkoutProducts' => $checkoutProducts, 'quantities' => $quantities]);
        }
    }

    public function processCheckout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:255',
            'extra_message' => 'nullable|string|max:255',
        ]);

        if (!$request->has('payment-method-cod') && !$request->has('payment-method-card')) {
            $validator->errors()->add('payment_method', 'The payment method field is required.');
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Lay user id
        $user_id = Auth::id();

        $order = new Order();
        $order->total_price = $request->input('total_price');
        $order->total_quantity = $request->input('total_quantity');
        $order->order_description = $request->input('extra_message');
        $order->address = $request->input('address');
        $order->order_date = Carbon::now();
        $order->delivery_date = Carbon::now()->addDays(3);
        $order->user_id = $user_id;
        $order->save();


        $productIds = json_decode($request->input('product_ids_json'), true);
        $orderItems = [];
        $quantities = $request->input('quantities');

        // kiem tra neu khong co san pham nao thi khong mua quay ve gio hang
        if (empty($productIds) || empty($quantities)) {
            return redirect()->route('products.cart')->with('error', 'Không có sản phẩm nào trong giỏ hàng.');
        }

        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            // kiem tra so luong san pham neu nho hon 0 hay nho hon so luong hang dang co thi tra ve cart
            if (!$product || $product->quantity <= 0 || $quantities[$productId] <= 0 || $quantities[$productId] > $product->quantity) {
                return redirect()->route('products.cart')->with('error', 'Sản phẩm đã hết hàng.');
            }
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->order_id;
            $orderItem->product_id = $productId;
            $orderItem->quantity_order = $request->input('quantities')[$productId];
            $orderItem->payment_method = $request->input('payment-method');
            $orderItem->status_order = 'pending';
            $orderItem->save();


            // Tru di so luong san pham da mua va cap nhat lai 
            $product->quantity -= $quantities[$productId];
            $product->save();

            $orderItems[] = $orderItem;
        }

        $cart = Cart::where('user_id', $user_id)->first();
        if ($cart) {
            $cartItems = $cart->items()->whereIn('product_id', $productIds)->get();
            if ($cartItems->isNotEmpty()) {
                $cartItems->each->delete();
            }
        }

        $user = User::find($user_id);
        try {
            // Gui mail cho nguoi dat hang
            Mail::to($user->email)->send(new OrderConfirmation($order, $orderItems));
        } catch (\Exception $e) {
            // Ghi lai loi neu co
            Log::error('Lỗi ghi gửi xác nhận mail: ' . $e->getMessage());
            // Chuyen huong ve trang order success voi thong bao
            return redirect()->route('orders.success')->with('warning', 'Đặt hàng thành công, nhưng không thể gửi email xác nhận.');
        }


        return redirect()->route('orders.success');
    }

    public function showOrderSuccess()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        return view('orders.order_success', compact('orders'));
    }
    public function showOrderHistory()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        return view('orders.order_history', compact('orders'));
    }
}
