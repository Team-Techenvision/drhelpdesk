<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit User Categories</h3>
			<a href="{{url('view-user-categories')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View User Categories</a> 
		</div> 
		<form action="{{url('categories-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="categories_id" value="{{$result->categories_id}}" required>
			<input type="hidden" class="form-control" name="type" value="1"> 
			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Category Name</label>
					<input type="text" class="form-control" name="category_name" value="{{$result->category_name}}" required>
				</div>
				<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" name="title" value="{{$result->title}}">  
				</div>  
				<div class="form-group">
					<label>Image</label><br>
					<img style="height: 150px; width: 130px;"  src="{{asset($result->image)}}"><br>
		            <input type="hidden" name="image" value="{{$result->image}}"><br>
		            <input type="file" class="form-control" name="image"> 
		            
					@error('image')
                     	<p style="color:red;">* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>Background Color</label>
					<input type="color" class="form-control" name="back_color" value="{{$result->back_color}}">  
				</div>
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>