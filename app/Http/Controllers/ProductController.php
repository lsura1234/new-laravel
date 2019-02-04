<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Input, Config,Validator;
use App\Category;
class ProductController extends Controller
{
    var $rp = 10;

    public function index(){
        $products = Product::paginate($this->rp);
        return view('product/index', compact('products'));
    }

    public function search(){
        $query = Input::get('q');
        if($query){
            $products = Product::where('code','like','%'.$query.'%')->orWhere('name','like','%'.$query.'%')->paginate();
        }
        else{
            $products = Product::paginate($this->rp);
        }
        return view('product/index',compact('products'));
    }

    public function __construct(){
        $this->rp = Config::get('app.result_per_page');
    }
    public function edit($id =null){
        $categories = Category::pluck('name','id')->prepend('เลือกรายการ','');
       $product = Product::find($id);
        return view('product/edit')
        ->with('product',$product)
        ->with('categories',$categories);
    }
    public function update(){
        $rules = array(
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'strock_qty' => 'numeric',
        );
        $messages = array(
            'required' => 'กรุณากรอก้อมูล:attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล:attribute ให้เป็นตัวเลข',

        );
        $id = Input::get('id');
        $validator = Validator::make(Input::all(),$rules,$messages);
        if($validator->fails()){
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $product = Product::find($id);
        $product->code = Input::get('code');
        $product->name = Input::get('name');
        $product->category_id = Input::get('category_id');
        $product->price = Input::get('price');
        $product->stock_qty = Input::get('stock_qty');
        $product->save();

       return redirect('product')->with('ok',true)->with('msg','บันทึกข้อมูลเรียบร้อย');
    
    }
    

}
