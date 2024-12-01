<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products = Product::get();

        $data = [
            'product' => $products,
        ];

        return response()->json($data, 200);
    }

    public function userList(){
        $users = User::get();

        $data = [
            'user' => $users
        ];
        return response()->json($data,200);
    }

    public function orderList(){
        $orders = Order::get();

        $data = [
            'order' => $orders
        ];
        return response()->json($data,200);
    }


    //get all category list
    public function categoryList(){
        $category = Category::get();
        return response()->json($category, 200);
    }

    //create category
    public function categoryCreate(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
    return response()->json($response, 200);
    }

    //create contact
    public function contactCreate(Request $request){
        $data = $this->getContactData($request);
        Contact::create($data);
        $contact = Contact::get();
        return response()->json($contact, 200);

    }

        //delete category
        public function deleteCategory(Request $request){
            $data = Category::where('id',$request->category_id)->first();

            if(isset($data)){
                Category::where('id',$request->category_id)->delete();
                return response()->json(['status' => true,'message'=>'delete success','deleteData'=>$data], 200);
            }

             return response()->json(['status'=> false,'message'=>'There is no category'], 200);
        }

        //details category
        public function detailsCategory($id){
            $data = Category::where('id',$id)->first();

            if(isset($data)){
                return response()->json(['status' => true,'category'=>$data], 200);
            }

             return response()->json(['status'=> false,'category'=>'There is no category'], 500);
        }

        //category update
        public function CategoryUpdate(Request $request){
            $categoryId = $request->category_id;
           $dbSource = Category::where('id',$categoryId)->first();

            if(isset($dbSource)){
                $data = $this ->getCategoryData($request);
                Category::where('id',$categoryId)->update($data);
                $response = Category::where('id',$categoryId)->first();
                return response()->json(['status' => true, 'message'=>'category update success...','category'=>$response], 200);
            }

            return response()->json(['status'=> false,'message'=>'There is no category for update '], 500);

        }

    private function getContactData($request){
        return [
            'name' => $request->name,
            'email'=>$request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    //get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }




}
