<style>
	p {
		color:red;
		font-size:14px;
		font-family:verdana;
	}
</style>
<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Products Attributes</h3>			
			<a href="{{url('product-attribute-list/'.$product->products_id)}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Attribute</a> 
		</div> 
		<form action="{{url('products-attribute-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
            <input type="hidden" name="products_id" value="{{$product->products_id}}">
			<div class="box-body">
				<div class="form-group">
					<label>Product Name</label>
					<input type="text" class="form-control" name="product_name" value="{{$product->product_name}}" readonly> 
					@error('product_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				<div class="form-group">
					<label>Product Have Multiple Attributes <span class="text-danger">*</span></label> 
					<select class="form-control" name="multiple_attribute" required>
						<option value="">Select</option>						 
							<option value="0">Yes</option>	
							<option value="1">No</option>					
					</select> 
				</div> 

                <div class="form-group">
					<label>Product Size</label> 
					<select class="form-control" name="product_size" id="product_size" >
						<!-- <option value="">select</option> -->
						@foreach($size as $r) 
							<option value="{{$r->id}}">{{$r->size_name}}</option>
							@error('parent_id')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>

				<div class="form-group" id="stript_quantity">
					<label>Enter number of tablets in strip</label>
					<input type="number" class="form-control" name="per_stript_qty" min="1" value="1">  
				</div> 
				
				<div class="form-check form-check-inline">
					<input class="form-check-input hide-color" type="radio" name="color" id="inlineRadio1" value="0" checked="checked">
					<label class="form-check-label" for="inlineRadio1">No Color</label>
					</div>
					<div class="form-check form-check-inline">
					<input class="form-check-input show-color" type="radio" name="color" id="inlineRadio2" value="1">
					<label class="form-check-label" for="inlineRadio2">Show Color</label>
					</div>
					
                <div class="form-group show-color-div">
					<label>Product color</label>
					<input type="color" class="form-control" name="product_color" value="" placeholder="Choose Color">  
				</div> 

				<div class="form-group">
					<label>Product Barcode</label>
					<input type="text" class="form-control" name="barcode" placeholder="Product Barcode"> 
					@error('barcode')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>

				<div class="form-group">
					<label>DHD BUYING PRICE <span class="text-danger">*</span> </label>
					<input type="text" class="form-control" name="manufacturer_price"  id="price-from" placeholder="DHD BUYING PRICE" required> 
				</div> 

				
				<div class="form-group">
					<label>MRP <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="price" min="1" placeholder="MRP" required> 
					@error('price')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>WEBSITE PRICE</label>
					<input type="text" class="form-control" placeholder="CUSTOMER PRICE" name="special_price"> 
				</div>

				<div class="form-group">
					<label>SHOP PRICE</label>
					<input type="text" class="form-control" placeholder="SHOP PRICE" name="shop_price"> 
				</div>

				<div class="form-group">
					<label>Extra Discount</label>
					<input type="text" class="form-control" name="extra_discount" placeholder="Extra Discount"  value="{{ old('extra_discount') }}">  
				</div>

				<div class="form-group">
					<label>Product Quantity <span class="text-danger">*</span></label>
					<input type="number" class="form-control" name="quantity" min="1" placeholder="Enter Product Quantity" value="1" required>  
				</div> 

				<div class="form-group">
					<label>Product Status</label> 
					<select class="form-control" name="status" required>
						<option value="">select</option>						 
							<option value="1">Active</option>	
							<option value="0">Inactive</option>					
					</select> 
				</div> 

				<div class="form-group">
					<label>Product Stock</label> 
					<select class="form-control" name="in_stock" required>
						<option value="">select</option>						 
							<option value="1">InStock</option>	
							<option value="0">Out Of Stock</option>					
					</select> 
				</div> 

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div> 

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>
<script>
	var validate = function() {
		var from = document.getElementById("price-from").value;
		var to = document.getElementById("price-to").value;
		if (from < to)
			return true;
		alert("special price is more than to price");
		return false;
	}
</script>
<script>
$( document ).ready(function() {
    $(".show-color-div").hide();
});
$(".show-color").click(function(){
	// alert();
  $(".show-color-div").show();
});
$(".hide-color").click(function(){
	// alert();
  $(".show-color-div").hide();
});
</script>

<script>
$(document).ready(function(){
	$("#stript_quantity").hide();
    $('#product_size').on('change', function() {
      if ( this.value == '4')
      {
		// alert();
        $("#stript_quantity").show();
      }
      else
      {
        $("#stript_quantity").hide();
      }
    });
});
</script>
