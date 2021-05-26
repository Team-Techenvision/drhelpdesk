<div class="col-md-6">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Add Size</h3>
      <a href="{{url('get-size-list')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Sizes</a>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form enctype="multipart/form-data" method="post" action="{{url('save-size')}}">
      {{ csrf_field() }}
      <div class="box-body"> 
        <div class="form-group">
          <label>Add Size</label>
          <input type="text" class="form-control"  name="size_name" >
        </div> 
    
        <div class="form-group">
            <label>Product Status</label> 
            <select class="form-control" name="status" required>
                <option value="">select</option>						 
                    <option value="1">Active</option>	
                    <option value="0">Inactive</option>					
            </select> 
        </div> 
         
      </div><!-- /.box-body --> 
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div><!-- /.box --> 
</div><!--/.col (left) -->
