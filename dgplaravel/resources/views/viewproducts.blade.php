@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <input type="text" id="input1" class="form-control">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($data)
                   
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="container">Product Name</th>
                                <th class="container">Product Description</th>
                                <th class="container">Product Price</th>
                                <th class="container">Product Vendor</th>
                                <th class="container">Delete Product</th>
                            </tr>
                        </thead> 
                        <tbody>
                        @foreach($data as $key => $product)
                        <tr>
                            <td><img src="http://localhost/dgplaravel/storage/app/{{$product->cover_image}}" style="width: 30%"></td>
                            <td onclick="makeEditable(this,'product_name','<?php echo $product->id ?>')" onblur="edit(this,'product_name','<?php echo $product->id ?>')" class="text-center center-aligned text">{{$product->product_name}}</td>
                            
                            <td onclick="makeEditable(this,'product_description','<?php echo $product->id ?>')" onblur="edit(this,'product_description','<?php echo $product->id ?>')" class="container">{{$product->product_description}}</td>

                            <td onclick="makeEditable(this,'product_price','<?php echo $product->id ?>')" onblur="edit(this,'product_price','<?php echo $product->id ?>')" class="container">{{$product->product_price}}</td>

                            <td onclick="makeEditable(this,'product_vendor','<?php echo $product->id ?>')" onblur="edit(this,'product_vendor','<?php echo $product->id ?>')" class="container">{{$product->product_vendor}}</td>
                            <td class="container"><a href="/deleteProduct/<?php echo $product->id?>">Delete</a></td>  
                           
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                   
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyCt5CBNV38V-zvuIBTNodbRVPwzCWs6tmU"></script>

<script type="text/javascript">
    function AutoComplete(){
        var input1 = document.getElementById('input1');
        new google.maps.places.Autocomplete(input1);
    }
</script>

<script type="text/javascript">
    function edit(obj,col,id){
        var val=obj.innerHTML;
        // console.log(val);
        // return;
        if(val=="") return;

        $.ajax({
            url:"/ajaxUpdate/"+id+"/"+col+"/"+val,
            data:null,
            type:"GET",
            error:function(res){
                console.log(res);
            },
            success:function(res){
                if(res==1){
                    j=0;
                    $(obj).prop('contenteditable',false);
                    $(obj).css('background','white');
                    $(obj).css('color','green');
                }else{
                    console.log("ERROR" + res);
                }
            }
        })
    }
    var j=0;
    function sure(o){
        $(o).parent().prop('contenteditable',true);
        $(o).parent().css('background','lightgreen');
        $(o).remove();
    }
    function makeEditable(obj,col,id){
        $(obj).css('background','lightgreen');
        if (j==0) {
            $(obj).append("<a onclick='sure(this)' class='btn btn-success' style='float:right'>Edit?</a>");
            j++;
        }
    }
    google.maps.event.addDomListener(window, 'load',AutoComplete);
</script>
@endsection
