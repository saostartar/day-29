<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk dengan filter dan sorting
    public function index(Request $request)
    {
        $query = Product::query();
    
        // Filtering
        if ($request->has('name') && $request->input('name') !== null) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('price') && $request->input('price') !== null) {
            $query->where('price', $request->input('price'));
        }
        if ($request->has('stock') && $request->input('stock') !== null) {
            $query->where('stock', $request->input('stock'));
        }
    
        // Sorting
        $validSortColumns = ['name', 'price', 'stock'];
        $sortBy = $request->input('sort_by');
        $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending order
    
        if (in_array($sortBy, $validSortColumns)) {
            $query->orderBy($sortBy, $sortOrder);
        }
    
        $products = $query->get();
    
        return view('products.index', compact('products'));
    }

    // Menampilkan form untuk menambah produk baru
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Menampilkan form untuk mengedit produk
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Memperbarui produk di database
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Menghapus produk dari database
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    // Menampilkan laporan executive summary dengan chart.js
    public function report()
    {
        $totalProducts = Product::count();
        $averagePrice = Product::avg('price');
        $totalStock = Product::sum('stock');

        return view('products.report', compact('totalProducts', 'averagePrice', 'totalStock'));
    }

    // Menampilkan pivot table menggunakan pivot.js
    public function pivot()
    {
        $products = Product::all();
        return view('products.pivot', compact('products'));
    }
}