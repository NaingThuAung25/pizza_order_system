<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products = Product::get();
        return response()->json($products, 200);
    }
    public function categoryList(){
        $categories = Category::orderBy('id','desc')->get();
        return response()->json($categories, 200);
    }

     //create category
     public function categoryCreate(Request $request){
         $data = [
             'name' => $request->name ,
             'created_at' => Carbon::now() ,
             'updated_at' => Carbon::now()
         ];

         $response = Category::create($data);
         return response()->json($response, 200);
     }

     //create contact
     public function createContact(Request $request){
         $data = $this->getContactData($request);
         Contact::create($data);
         $contact = Contact::orderBy('created_at','desc')->get();
         return response()->json($contact, 200);
     }

     //delete category
     public function deleteCategory($id){
         $data = Category::where('id',$id)->first();

         if(isset($data)){
             Category::where('id',$id)->delete();
             return response()->json(['status'=> true ,'message'=>"delete success", 'deleteData' => $data],200);
         }
         return response()->json(['status'=> false ,'message'=>"There is no category."],500);

     }

     //category details
     public function categoryDetails($id){
         $data = Category::where('id',$id)->first();

         if(isset($data)){
             return response()->json(['status'=> true ,'category' => $data ],200);
         }
         return response()->json(['status'=> false ,'category'=>"There is no category."],500);

     }

     //update category
     public function categoryUpdate(Request $request){
         $categoryId = $request->category_id;

         $dbSource = Category::where('id',$categoryId)->first();

         if(isset($dbSource)){
             $data = $this->getCategoryData($request);
             Category::where('id',$categoryId)->update($data);
             $response = Category::where('id',$categoryId)->update($data);

             return response()->json(['status'=> true , 'message'=>"category update success", 'category'=>$data],200);
         }

         return response()->json(['status'=> false , 'message'=>"There is no category for update"],500);

     }

     //get Contant Data
     private function getContactData($request){
         return [
             'name' => $request->name ,
             'email' => $request->email ,
             'message' => $request->description ,
             'created_at' => Carbon::now() ,
             'update_at' => Carbon::now()
         ];
     }

     //get category Data
     private function getCategoryData($request){
         return [
             'name' => $request->category_name ,
             'updated_at' => Carbon::now()
         ];
     }
}
