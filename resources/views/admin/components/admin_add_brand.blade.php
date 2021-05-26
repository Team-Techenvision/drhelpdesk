<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/> 
<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Brand</h3>
			<a href="{{url('view-brand')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Brand</a>
		</div>
		<form action="{{url('brand-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Brand Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="brand_name" placeholder="Brand Name" required>
					@error('brand_name')
					<p>* {{ $message }}</p>
					@enderror
				</div>
				<div class="form-group">
					<label>Image <span class="text-danger">*</span></label>
					<input type="file" class="form-control" name="image" required>
					<!-- <p style="color:red;">*Please Upload only Image size is px </p> -->
					@error('image')
					<p>* {{ $message }}</p>
					@enderror
				</div> 
				<div class="form-group">
					<label>Category <span class="text-danger">*</span></label>
					<select name="parent_id[]" multiple class="chosen-select form-control"  required> 
						@foreach($category as $r) 
							<option value="{{$r->categories_id}}">{{$r->category_name}}</option> 
						@endforeach
						@error('parent_id')
						<p>* {{ $message }}</p>
						@enderror
					</select> 
				</div>  
            	<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" name="title" placeholder="title">  
				</div>  
            	<div class="form-group">
					<label>Category Background Color For Mobile</label>
					<input type="color" class="form-control" name="back_color">  
				</div>
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
			<h3 class="box-title">Add Brand</h3>
			<a href="{{url('view-brand')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Brand</a>
		</div>
		<form action="{{url('brand-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Brand Name</label>
					<input type="text" class="form-control" name="brand_name" required>
					@error('brand_name')
					<p>* {{ $message }}</p>
					@enderror
				</div>
				<div class="form-group">
					<label>Image</label>
					<input type="file" class="form-control" name="image" required>
					<p style="color:red;">*Please Upload only Image size is px </p>
					@error('image')
					<p>* {{ $message }}</p>
					@enderror
				</div>
				<div class="form-group">
					<label>Category</label>
					<select class="form-control" name="parent_id" required>
						<option value="">select</option>
						@foreach($category as $r)
						<option value="{{$r->categories_id}}">{{$r->category_name}}</option>
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