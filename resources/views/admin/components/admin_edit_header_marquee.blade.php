
@extends('admin_master') 
@section('main_content')   
@include('admin/common.admin_message_box')
<section class="content">
	<div class="row">
		<div class="col-md-6"> 
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Header Marquee Content</h3> 
				</div> 
				<form action="{{url('update-header-marquee')}}" method="post"  enctype="multipart/form-data">
					{{ csrf_field() }}  
					<input type="hidden" class="form-control" name="id" value="{{$result->id}}"> 
					<div class="box-body"> 
						<div class="form-group">
							<label>Content</label>
							<input type="text" class="form-control" name="content" value="{{$result->content}}" required>  
						</div>   
					
					<div class="form-group">
						<label>Same Day Delivery Image</label><br>
						<img style="height: 150px; width: 130px;"  src="{{asset($result->same_day_image)}}"><br>
						<input type="hidden" name="same_day_image" value="{{$result->same_day_image}}"><br>
						<input type="file" class="form-control" name="same_day_image"> 
					</div> 
					<div class="form-group">
						<label>Guranteed Delivery Image</label><br>
						<img style="height: 150px; width: 130px;"  src="{{asset($result->guranteed_image)}}"><br>
						<input type="hidden" name="guranteed_image" value="{{$result->guranteed_image}}"><br>
						<input type="file" class="form-control" name="guranteed_image">  
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