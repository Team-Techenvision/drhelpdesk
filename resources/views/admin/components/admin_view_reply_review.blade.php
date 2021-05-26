@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Reply Reviews</h3>
			
		</div> 
		<form action="{{url('save-reply-review')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<div class="box-body"> 
             		<input type="hidden" class="form-control" id="review_id"  name="review_id" value="{{$review->id}}"  required>
				 
				<div class="form-group">
					<label for="review-author">User Name</label>
					<input type="text" class="form-control" id="review-author" placeholder="Your Name" name="user_name" value="{{$review->user_name}}"  disabled>
                	
				</div> 
             
<!--             <div class="form-group">
					<label for="review-author">Product Name</label>
					<input type="text" class="form-control" id="review-author"  name="product_name" value="<?php// echo $product_name; ?>"  disabled>
                	
				</div> -->
            	 <div class="form-group">
					<label for="review-text">User Review</label>
				    <textarea class="form-control" id="user-review" rows="6" name="user_review"  disabled>{{$review->comment}}</textarea>
				</div> 
            <div class="form-group">
					<label for="review-text">Reply  Review</label>
				    <textarea class="form-control" id="review-reply" rows="6" name="reply" required></textarea>
				</div> 
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>
        
         </div>
    </section>
@stop
