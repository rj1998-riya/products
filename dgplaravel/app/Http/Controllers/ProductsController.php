<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#to call the model inside the controller
use App\Products;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('products');
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
       
        
    }
    public function savethis(Request $request)
{
    return var_dump($_FILES);
     //return var_dump($request->Cname)
        $file_name_to_store = '';
        if ($request->hasFile('cover_image')) {
                   $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                   //get just filename
                   $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                   $ext = $request->file('cover_image')->getClientOriginalExtension();
                   //filename to store
                   //if($extenstion!=".jpg"){}
                   $filenameToStore = $filename.'_'.time().'.'.$ext;
                   //upload the image
                   $path = $request->file('cover_image')->storeAs('public/productimage', $filenameToStore);
               }else{
                return "no file exist";
               }
               $err = 0;
               foreach($_POST as $key => $value){
                if(empty($value)) {
                    $err = 1;
                }
               }
               if($err==1){
                return redirect('products')->with('error','All fields are mandatory');
               }
                    

                
     $save = new Products;
        $save->product_name = $request->product_name;
        $save->product_description = $request->product_description;
        $save->product_price = $request->product_price;
        $save->product_vendor = $request->product_vendor;
        $save->cover_image = $path;
        $save->save();
        return redirect('products')->with('status','product added successfully');
                var_dump("Request to my cutome function" .$request->product_name);
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,$col,$val)
    {
        //
        
        $upd = Products::find($id);
        $upd->$col = $val;
        $upd->save();
        return 1;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ret=Products::where('id',$id)->delete();
        return redirect('viewproducts')->with('success','delete success');
    }
    public function view(){
        $data = Products::all();
        return view('viewproducts')->with('data',$data);
    }
}
