<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductsExport;
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
        $user = $request->user();
        $query = Product::orderBy('created_at', 'desc');

        if ($user->isAdmin()) {
            $data = $query->get();
            return view('admin.item.index', compact('data'));
        }

        // user is not admin
        $data = $query->where('is_active', true)->get();
        return view('user.item.index', compact('data'));
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
            'prices' => 'required',
            'image' => 'required|image',
            'sizes' => 'required',
        ]);

        $image = upload_file('app/public/images/products', $request->file('image'));

        $data = [
            'name' => $request->name,
            'prices' => json_encode($request->prices),
            'sizes' => json_encode($request->sizes),
            'desc' => $request->desc,
            'image' => $image,
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
            'prices' => 'required',
            'sizes' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'prices' => json_encode($request->prices),
            'sizes' => json_encode($request->sizes),
            'desc' => $request->desc,
            'image' => $request->hasFile('image') ? upload_file('app/public/images/products', $request->file('image')) : $product->image,
            'is_active' => $request->is_active ? 1 : 0
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
        ];

        return $data;
    }
}
