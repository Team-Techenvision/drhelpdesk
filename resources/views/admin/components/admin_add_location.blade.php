<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Location</h3>
			<a href="{{url('view-location')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Location</a> 
		</div> 
		<?php
            $cities = DB::table('cities')->orderBy('city_name')->get();
        ?>
		<form action="{{url('location-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Location Name</label>
					<select id="deliveryLocaion"  name="location_name" class="form-control form-control-select2">
					<option>Select a Location...</option>
						@foreach($cities as $r) 
							<option value="{{$r->city_name}}">{{$r->city_name}}</option>  
						@endforeach 
					</select>
					<!-- <input type="text" class="form-control" name="location_name">  -->
					@error('location_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				
				<div class="form-group">
					<label for="exampleInputEmail1">Location Code</label>
					<input type="text" class="form-control" name="location_code"> 
					@error('location_code')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>