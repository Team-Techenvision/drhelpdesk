<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Brand</h3>
			<a href="{{url('view-brand')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Brand</a>
		</div>
		<form action="{{url('brand-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" class="form-control" name="id" value="{{$result->id}}">
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Brand Name</label>
					<input type="text" class="form-control" name="brand_name" value="{{$result->brand_name}}" required>
					@error('brand_name')
					<p>* {{ $message }}</p>
					@enderror
				</div>
				<div class="form-group">
					<label>Image</label><br>
					<img style="height: 150px; width: 130px;" src="{{asset($result->image)}}"><br>
					<input type="hidden" name="image" value="{{$result->image}}"><br>
					<input type="file" class="form-control" name="image">
					<!-- <p style="color:red;">*Please Upload only Image size is px </p> -->
				</div>
            	<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" name="title" value="{{$result->title}}">  
				</div>  
            	<div class="form-group">
					<label>Background Color</label>
					<input type="color" class="form-control" name="back_color" value="{{$result->back_color}}">  
				</div> 
				<?php
					$category2 = DB::table('brand_categories')->where('brand_id',$result->id)->select('category_id')->get();  
				?>
				 
				@if($category2->count() > 0)
				<div class="form-group">
					<label>Category</label>
					<select name="parent_id[]" multiple class="chosen-select form-control"  required> 
						 
							@foreach($category as $r)   
								<?php
									$category2 = DB::table('brand_categories')->where('brand_id',$result->id)->where('category_id', $r->categories_id)->pluck('category_id')->first();  
								?>
								<option value="{{$r->categories_id}}" @if($r->categories_id == $category2)Selected @endif>{{$r->category_name}}</option> 
							 
						@endforeach 
					</select>  
				</div>
				@else
				<div class="form-group">
					<label>Category</label> 
					<select name="parent_id[]" multiple class="chosen-select form-control"  required>
					 
						@foreach($category as $r) 
							<option value="{{$r->categories_id}}" @if(in_array($r->categories_id,explode(',',$result->parent_id)))Selected @endif>{{$r->category_name}}</option> 
						@endforeach
					</select>  
				</div> 
				@endif  
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
<script>
  $(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})
</script>












<!-- <div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Brand</h3>
			<a href="{{url('view-brand')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Brand</a>
		</div>
		<form action="{{url('brand-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" class="form-control" name="id" value="{{$result->id}}">
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Brand Name</label>
					<input type="text" class="form-control" name="brand_name" value="{{$result->brand_name}}" required>
					@error('brand_name')
					<p>* {{ $message }}</p>
					@enderror
				</div>
				<div class="form-group">
					<label>Image</label><br>
					<img style="height: 150px; width: 130px;" src="{{asset($result->image)}}"><br>
					<input type="hidden" name="image" value="{{$result->image}}"><br>
					<input type="file" class="form-control" name="image">
					<p style="color:red;">*Please Upload only Image size is px </p>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Category</label>
					<select class="form-control" name="parent_id" required>
						<option value="">select</option>
						@foreach($category as $r)
						<option value="{{$r->categories_id}}" @if($result->parent_id == $r->categories_id)Selected @endif>{{$r->category_name}}</option>
						@error('parent_id')
						<p>* {{ $message }}</p>
						@enderror
						@endforeach
					</select>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div> -->