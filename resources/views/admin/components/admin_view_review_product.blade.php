<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Reviews</h3>
			
		</div> 
		<form action="{{url('save-product-review')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<div class="box-body"> 
                <div class="form-group">
					<label for="review_type">Select Type</label>
					<select id="review_type" class="form-control" name="type" required>
                    	 <option value="">Select Type</option>
	                     <option value="1">Product</option>
					     <option value="2">Package</option>
					     
				   </select> 
					
				</div>
            	<div class="form-group" id="r_product" style="display:none">
					<label for="product_id">Product</label>
					<select name="product_id" id="product_id" class="form-control">
						<option value="">select product</option>
						@foreach($product as $r) 
							<option value="{{$r->products_id}}">{{$r->product_name}}</option> 
						@endforeach
					</select>
					
				</div> 
            	<div class="form-group" id="r_package" style="display:none">
					<label for="package_id">Package</label>
					<select name="package_id" id="package_id" class="form-control">
						<option value="">select package</option>
						@foreach($package as $r) 
							<option value="{{$r->id}}">{{$r->package_name}}</option> 
						@endforeach
					</select>
					
				</div>
				<div class="form-group">
					<label for="review-stars">Review Stars</label>
					<select id="review-stars" class="form-control" name="rating" required>
	                     <option value="5">5 Stars Rating</option>
					     <option value="4">4 Stars Rating</option>
					     <option value="3">3 Stars Rating</option>
					     <option value="2">2 Stars Rating</option>
						<option value="1">1 Stars Rating</option>
				   </select> 
					
				</div>  
				 
				<div class="form-group">
					<label for="review-author">Your Name</label>
					<input type="text" class="form-control" id="review-author" placeholder="Your Name" name="user_name" value=""  required>
                	
				</div> 
            	<div class="form-group">
					<label for="review-email">Email Address</label>
					<input type="text" class="form-control" id="review-email" placeholder="Email Address" name="email" value="" required>
                	
				</div> 
            <div class="form-group">
					<label for="review-text">Your Review</label>
				    <textarea class="form-control" id="review-text" rows="6" name="comment" required></textarea>
                	
				</div> 
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>