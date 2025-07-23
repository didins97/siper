<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductsExport;
use App\Models\Category;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $user = $request->user();
        $query = Product::orderBy('created_at', 'desc');

        if ($user->isAdmin()) {
            $data = $query->get();
            return view('admin.item.index', compact('data', 'categories'));
        }

        // user is not admin
        $data = $query->where('is_active', true)->get();
        // return view('user.item.index', compact('data', 'categories'));

        return view('user.item.category', compact('categories', 'data'));
    }

    public function getProductsByCategory(Request $request, $id)
    {
        $query = Product::orderBy('created_at', 'desc');
        $data = $query->where('category_id', $id)->where('is_active', true)->get();

        $desc = "Kami melayani berbagai kebutuhan cetak Anda, baik untuk keperluan indoor maupun outdoor, dengan kualitas terbaik dan harga bersaing.";

        return view('user.item.index', compact('data', 'desc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            // 'prices' => 'required',
            'image' => 'required|image',
            // 'sizes' => 'required',
        ]);

        // dd($request->all());

        $image = upload_file('app/public/images/products', $request->file('image'));

        $data = [
            'name' => $request->name,
            'prices' => $request->prices ? json_encode($request->prices) : null,
            'sizes' => $request->sizes ? json_encode($request->sizes) : null,
            'desc' => $request->desc,
            'image' => $image,
            'category_id' => $request->category_id,
            'is_custom' => $request->is_custom,
            'price_per_size' => $request->price_per_size ? $request->price_per_size : null
        ];

        Product::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return view('user.item.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product = Product::where('id', $product->id)->first();
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            // 'prices' => 'required',
            // 'sizes' => 'required',
        ]);

        // dd($request->all());

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            // 'prices' => $request->prices ? json_encode($request->prices) : null,
            // 'sizes' => $request->sizes ? json_encode($request->sizes) : null,
            'sizes' => $request->is_custom ? null : json_encode($request->sizes),
            'prices' => $request->is_custom ? null : json_encode($request->prices),
            'price_per_size' => $request->price_per_size ? $request->price_per_size : null,
            'desc' => $request->desc,
            'image' => $request->hasFile('image') ? upload_file('app/public/images/products', $request->file('image')) : $product->image,
            'is_active' => $request->is_active ? 1 : 0,
            'is_featured' => $request->is_featured ? 1 : 0,
            'is_custom' => isset($request->is_custom) ? 1 : 0
        ];

        $product->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if ($product->image) {
            Storage::delete($product->image);
        }

        return response()->json([
            'message' => 'Product deleted successfully',
            'success' => true
        ]);
    }

    public function exportToPDF()
    {
        $products = Product::all();

        return exportTo($products, 'PDF', 'admin.item.pdf');
    }

    public function exportToExcel()
    {
        return exportTo(new ProductsExport, 'Excel', 'item');
    }

    public function GetSizesPrices($id)
    {
        $product = Product::where('id', $id)->first();

        $data = [
            'sizes' => json_decode($product->sizes),
            'prices' => json_decode($product->prices),
            'price_per_size' => $product->price_per_size,
            'is_custom' => $product->is_custom
        ];

        return $data;
    }

    public function chooseItemsIndex()
    {
        $query = Product::orderBy('created_at', 'desc');

        $data = $query->where('is_active', true)->get();
        return view('admin.choose-item.index', compact('data'));
    }
}
