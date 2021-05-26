<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Vendor</h3>
			<a href="{{url('view-vendors')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Vendor</a> 
		</div> 
		<form action="{{url('vendors-submit')}}" method="post"  enctype="multipart/form-data" onsubmit="return myFun()">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label>Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="vendor_name" value="{{old('vendor_name')}}" placeholder="Vendor Name" required> 
					@error('vendor_name')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="cloneRow" id="cloneRow_0">
				<div class="form-group">
					<label>Brand</label>
					<select name="main_category[0]" id="brand_0" class="form-control "   required>
					<!-- <select name="main_category" class="form-control" required> -->
						<option value="">Select Brand</option>
						@foreach($test as $r)  
							<option value="{{$r->id}}">{{$r->brand_name}}</option> 
						@endforeach
					</select>  
				</div>
            	<div class="form-group">
					<label>Assign Priority</label>
					<select class="form-control" id="assign_priority_0" name="assign_priority[0]">
						<option value="">Select Assign Priority</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>  
                <input class="btn btn-default btn-danger removeFinCov" id="removeFinCov_0" data-limit="10"
        			data-clone="cloneRow" data-placement="top" style="display: none; width:75px" data-action="remove" value="Remove">
               </div>
            <input type="button" id="btnAdd" class="btn btn-sm btn-success addFinCov" style="width:75px"  data-clone="cloneRow" data-action="add" id="cloneRow_0" value="Add">
				<!-- <div class="form-group">
					<label for="exampleInputEmail1">Category</label> 
					<select class="form-control" name="main_category" required>
						<option>select</option>
						@foreach($category as $r) 
							<option value="{{$r->categories_id}}">{{$r->category_name}}</option> 
						@endforeach
					</select> 
				</div>     -->
				<div class="form-group">
					<label>Logo</label>
					<input type="file" class="form-control" name="logo">  
					@error('logo')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="Enter Address"> 
					@error('address')
                     <p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>City</label>
					<input type="text" class="form-control" name="city" value="{{old('city')}}" placeholder="Enter City">  
					@error('city')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Pin Code</label>
					<input type="text" class="form-control" name="pin_code" value="{{old('pin_code')}}" placeholder="Enter Pincode">  
					@error('pin_code')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>State</label>
					<input type="text" class="form-control" name="state" value="{{old('state')}}" placeholder="Enter State"> 
					@error('state')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter Email"> 
					@error('email')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Mobile</label>
					<input type="text" class="form-control" name="phone" value="{{old('mobile')}}" placeholder="Enter Mobile"> 
					<span id="message" style="color: red;"></span>  
					@error('phone')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>
				<div class="form-group">
					<label>Landline Number</label>
					<input type="text" class="form-control" name="landline" value="{{old('landline')}}" placeholder="Enter Landline Number">  
				</div>  
				<div class="form-group"> 
					<label>Website Url</label>
					<input type="url" class="form-control" name="website_url" value="{{old('website_url')}}" placeholder="Enter Website URL"> 
				</div> 
				<div class="form-group">
					<label>Description <span class="text-danger">*</span></label> 
					<textarea rows="4" cols="15" style="resize: vertical;"  class="form-control"  name="description" placeholder="Enter Description" required></textarea>  
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
});
 $(document).ready(function(){
    	$('.addFinCov').on('click', function () {
        var obj = $(this).EverClone({
            limit: 100,
            inCrementedId: 'cloneRow',
            removeClass: 'removeFinCov',
            noRemoveClass: 'no_remove_value',
            isRemove: true,
        });
	});
    $('.removeFinCov').on('click', function () {

        var that = $(this).data('clone');
        var obj = $(this).EverClone({
            limit: 100,
            inCrementedId: 'cloneRow',
            addClass: 'addFinCov'
        });

        var cloneClass = $(this).attr('data-clone');
        var lastRepeatingGroup = $('.' + cloneClass).last();
        var len = $('.' + cloneClass).length;
        if (len == 1) {
            $('.removeFinCov').hide();
        }
    });

    });
</script>