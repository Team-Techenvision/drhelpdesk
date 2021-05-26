<div class="col-md-6">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Set Shipping Charges</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form enctype="multipart/form-data" method="post" action="{{url('update-shipping-settings')}}">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$result->id}}">
      <div class="box-body"> 
        <div class="form-group">
          <label>Min Order Price</label>
          <input type="text" class="form-control"  name="min_order_price" value="{{$result->min_order_price}}" >
        </div> 
        <div class="form-group">
          <label>Shipping Charge Within Location</label>
          <input type="text" class="form-control"  name="charge_inside_location" value="{{$result->charge_inside_location}}" >
        </div> 
        <div class="form-group">
          <label>Shipping Charge Outside Location</label>
          <input type="text" class="form-control"  name="charge_outside_location" value="{{$result->charge_outside_location}}" >
        </div> 
      </div><!-- /.box-body --> 
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update Setting</button>
      </div>
    </form>
  </div><!-- /.box --> 
</div><!--/.col (left) -->
<script type="text/javascript">
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });
  </script> 