@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">{{session('error') }}</div>
                    @endif
                    	<form method="post" action="/saveProduct" enctype="multipart/form-data">
                    		@csrf
                    		<div class="row">
                    			<div class="col-md-8">
                    				<label>Products Name</label>
                    				<input type="text" name="product_name" placeholder="enter product name" class="form-control">
                    			</div>
                    			<div class="col-md-6">
                    				<label>Products Description</label>
                    				<input type="text" name="product_description" placeholder="enter product info" class="form-control">
                    			</div>
                    			<div class="col-md-6">
                    				<label>Products Price</label>
                    				<input type="text" name="product_price" placeholder="enter product price" class="form-control">
                    			</div>
                    			<div class="col-md-6">
                    				<label>Products Discount (%)</label>
                    				<input type="text" name="product_discount" placeholder="enter product discount" class="form-control">
                    			</div>
                    			<div class="col-md-6">
                    				<label>Products Vendor</label>
                    				<input type="text" name="product_vendor" placeholder="enter product vendor" class="form-control">
                    			</div>
                    			<div class="col-md-6">
                    				<label>Products Image</label>
                    				<input type="file" name="cover_image" placeholder="enter product vendor" class="form-control">
                    			</div>
                                <div class="col-md-4">
                    			<div class="col-md-4">
                    				<input type="submit" name="btn" value="AddProducts" class="btn btn-success">
                    			</div>
                                </div>
                    		</div>
                    	</form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

