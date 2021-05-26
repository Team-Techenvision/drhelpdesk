<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Send Offers</h3>
			
		</div> 
		<form action="{{url('send-offers')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label>Offer Title</label>
					<input type="text" class="form-control" name="offer_title"> 
					@error('offer_title')
                     	<p style="color:red">* {{ $message }}</p>
                	@enderror
				</div>  
				 
				<div class="form-group">
					<label>Offer Description</label> 
					<textarea rows="4" cols="15"  class="form-control"  name="offer_description" required></textarea>  
                	@error('offer_description')
                     	<p style="color:red">* {{ $message }}</p>
                	@enderror
				</div>   
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>