<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\SalesHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'name' => $request->input('product_name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
        ]);

        return redirect('/products/create')->with('success', 'Product added successfully!');
    }

    public function sell($id)
    {
        $product = Product::findOrFail($id);

        SalesHistory::create([
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        // Update the product quantity
        $product->decrement('quantity', 1);

        return redirect('/')->with('success', 'Product sold successfully!');
    }

    public function changePrice($id)
    {
        $product = Product::findOrFail($id);


        $newPrice = 19;
        $product->update(['price' => $newPrice]);

        return redirect('/')->with('success', 'Product price changed successfully!');
    }

    public function dashboard()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();

        $salesToday = $this->getSalesTotal($today);
        $salesYesterday = $this->getSalesTotal($yesterday);
        $salesThisMonth = $this->getSalesTotal($startOfMonth);
        $salesLastMonth = $this->getSalesTotal($startOfLastMonth);

        return view('dashboard', compact('salesToday', 'salesYesterday', 'salesThisMonth', 'salesLastMonth'));
    }

    public function salesHistory()
    {
        $salesHistory = SalesHistory::with('product')
            ->from('sales_history')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('sales_history', compact('salesHistory'));
    }

    private function getSalesTotal($date)
    {
        return SalesHistory::whereDate('created_at', $date)
            ->from('sales_history')
            ->sum(DB::raw('quantity * price'));
    }
}
