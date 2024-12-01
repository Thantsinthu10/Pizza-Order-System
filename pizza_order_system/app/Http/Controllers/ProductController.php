<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product List
    public function list(){

        $pizzas = Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(4);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }
    //direct pizza create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    //delete pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=> 'Product Delete Successful...']);
    }

    //edit pizza
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    //updatePage pizza
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    //create product
    public function create(Request $request){
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductInfo($request);


        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //update pizza
    public function update(Request $request){
        $this->productValidationCheck($request,'update');
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName =Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public/',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    //request product info
    private function requestProductInfo($request){
        return [
            'category_id' => $request -> pizzaCategory,
            'name' => $request ->pizzaName,
            'description' => $request->pizzaDescription,
            'price'=> $request->pizzaPrice,
            'waiting_time'=> $request->pizzaWaitingTime,
        ];
    }

    //product  validation check
    private function productValidationCheck($request,$action){
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required',
        ];
        //Important
        $validationRules['pizzaImage'] = $action == 'create' ? 'required|mimes:jpg,jpeg,png,webp|file':"mimes:jpg,jpeg,png,webp|file";
        Validator::make($request->all(),$validationRules)->validate();
    }
}
