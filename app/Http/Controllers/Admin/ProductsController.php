<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\QueryException;

class ProductsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $productCategory = ProductCategory::all();
    $units = Unit::all();
    $products = Product::all();

    foreach ($products as $product) {
      $product->unit = Unit::where('id', '=', $product->unit)->first();
    }

    $vars = [
      'products'          => $products,
      'productCategory'   => $productCategory,
      'units'             => $units

    ];
    return view('CP.products.all', $vars);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {}

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    Product::create([
      'name'                   => $request->name,
      'description'            => $request->description,
      'barcode'                => $request->barcode,
      'price'                  => $request->price,
      'unit'                    => $request->unit,
      'category'               => $request->category,
      'created_by'             => auth()->user()->id
    ]);
    return redirect()->back()->with('success', 'Product has been saved successfuly');
  }

  /**
   * Display the specified resource.
   */
  public function view(string $id)
  {
    $product = Product::find($id);
    if (!$product) {

      return view('CP.products.ajax.view', ['product' => null]);
    }
    $product->Category = ProductCategory::where('id', '=', $product->category)->first();
    $product->creator = User::where(['id' => $product->created_by])->first();
    $product->editor = User::where(['id' => $product->updated_by])->first();
    $product->unit = Unit::where('id', '=', $product->unit)->first();

    $vars = [
      'product' => $product,
    ];

    return view('CP.products.ajax.view', $vars);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $productCategory = ProductCategory::all();
    $units = Unit::all();
    $product = Product::find($id);

    if (!$product) {

      return view('CP.products.ajax.edit', ['product' => null]);
    }

  
    $product->creator = User::where(['id' => $product->created_by])->first();
    $product->editor = User::where(['id' => $product->updated_by])->first();
  

    $vars = [
      'product' => $product,
      'productCategory'   => $productCategory,
      'units'             => $units
    ];

    return view('CP.products.ajax.edit', $vars);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $product = Product::find($request->id);
    if (null == $product) {
      return redirect()->back()->with('error', 'product doesn\'t exists.');
    }

        $product->name                  = $request->name;
        $product->description           =$request->description;
        $product->barcode               = $request->barcode;
        $product->price                 =$request->price;
        $product->unit                  = $request->unit;
        $product->category              = $request->category;
        $product->updated_by            = auth()->user()->id;
        try {
          $product->update();
          return redirect()->back()->with('success', 'product has been updated successfuly.');
        } catch (QueryException $err) {
          return redirect()->back()->with('error', 'product update failed because of: ' . $err);
        }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Product::find($id)->delete();
    return redirect()->back()->with(['Success' => 'Product Removed Successfully']);
  }
}
