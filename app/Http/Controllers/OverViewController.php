<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class OverViewController extends Controller
{
    public function index()
    {
        $products = Product::all(); 
        foreach ($products as $product) {
            $product->lowStock = $product->isNearlyOutOfStock();
        }
        $productCount = Product::count(); 
        $categoryCount = Category::count();
        $coupons = Coupon::count();
        $product_discount = Product::count();

        $nearlyOutOfStockCount = Product::where('stock', '<', 3)->count();
        $pendingApprovalCount = Product::where('status', 'pending')->count();
        $orderCount = Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();

        $pendingOrders = Order::where('status', 'pending')->count();
        $approvedOrders = Order::where('status', 'approved')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $productOrders = DB::table('order_product')
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->select('products.name', DB::raw('SUM(order_product.quantity) as total_quantity'))
        ->groupBy('products.name')
        ->get();

        return view('/dashboard/overView/index', compact(
            'products',
            'productCount',
            'coupons',
            'product_discount',
            'categoryCount',
            'nearlyOutOfStockCount',
            'pendingApprovalCount',
            'orderCount',
            'productOrders',
            'approvedOrders',
            'cancelledOrders',
            'shippedOrders',
            'deliveredOrders'
        ));
    }


   
}