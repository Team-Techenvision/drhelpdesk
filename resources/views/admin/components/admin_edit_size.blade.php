<div class="col-md-6">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Add Size</h3>
      <a href="{{url('get-size-list')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Sizes</a>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form enctype="multipart/form-data" method="post" action="{{url('update-size')}}">
      {{ csrf_field() }}

    <input type="hidden" name="id" value="{{$size->id}}">
      <div class="box-body"> 
        <div class="form-group">
          <label>Add Size</label>
          <input type="text" class="form-control"  name="size_name" value="{{$size->size_name}}" >
        </div> 
    
        <div class="form-group">
            <label>Product Status</label> 
            <select class="form-control" name="status" required>
                <option value="">select</option>						 
                <option value="1" @if( '1' == $size->status )selected @endif>Active</option>	
				<option value="0" @if( '0' == $size->status )selected @endif>Inactive</option>				
            </select> 
        </div> 
         
      </div><!-- /.box-body --> 
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div><!-- /.box --> 
</div><!--/.col (left) -->
