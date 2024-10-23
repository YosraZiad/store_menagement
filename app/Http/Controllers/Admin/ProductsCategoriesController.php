<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsCategoriesRequest;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\QueryException;

class ProductsCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $roots=ProductCategory::where(['parent'=>0])->get();
        foreach($roots as $root){
          $root->children=ProductCategory::where(['parent'=>$root->id])->get();
        }
        $vars=[
          'categories'=>$roots
        ];
        return view('CP.categories.all' ,$vars);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      ProductCategory::create([
        'name'             => $request->name, 
        'brief'            => $request->description, 
        'parent'           => $request->parent, 
        'created_by'       => auth()->user()->id
    ]);
    return redirect()->back()->with('success', 'category has been saved successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
      $category = ProductCategory::find($id);
      $category->creator = User::find($category->created_by);
      $category->editor = User::find($category->updated_by);
      return view ('CP.categories.ajax.view', ['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
      $category = ProductCategory::find($id);
      $roots = ProductCategory::where('parent', 0)->get();
  
      foreach ($roots as $root) {
          $root->children = ProductCategory::where('parent', $root->id)->get();
      }
      $category->creator = User::find($category->created_by);
      $category->editor = User::find($category->updated_by);
  
      $vars = [
          'roots' => $roots,
          'category' => $category
      ];
  
      return view('CP.categories.ajax.edit', $vars);
  }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
          $category = ProductCategory::find($request->id);
          if (null == $category) {
              return redirect()->back()->with('error', 'Category doesn\'t exists.');

          }
        
          $category->name          = $request->name;
          $category->brief         = $request->brief;
          $category->parent        = $request->parent;
          $category->updated_by    = auth()->user()->id;
          try {
              $category->update();
              return redirect()->back()->with('success', 'Category has been updated successfuly.');
          } catch (QueryException $err) {
              return redirect()->back()->with('error', 'Category update failed because of: '.$err);

          }
        }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      ProductCategory::find($id)->delete();
      return redirect() ->back()->with(['Success'=>'Category Removed Successfully']);
    }

  }