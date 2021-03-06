<div class="box">
  <div class="box-header">
    <h3 class="box-title" style="float:left;">View User Sub Categories</h3>
    <a href="{{url('add-user-sub-categories')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add User Sub Categories</a>
  </div>
  <div class="box-body  table-responsive">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Categories</th>
          <th>Sub Categories</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 1; ?>
        @foreach($category as $r)
        @php
          $delete_check = DB::table('products')->where('sub_categories',$r->categories_id)->first();
        @endphp
        <tr>
          <td>{{$count++}}</td>
          <?php
          $category_name = DB::table('categories')->where('categories_id', $r->parent_id)->first();
          ?>
          <td>{{$category_name->category_name}} </td>
          <td>{{$r->sub_category_name}} </td>
          <td>
            <a href="{{url('edit-user-sub-categories/'.$r->categories_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            @if($delete_check == null)
            <a href="{{url('delete-user-sub-categories/'.$r->categories_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @else
            <a href="{{url('delete-user-sub-categories/'.$r->categories_id)}}" class="btn btn-danger btn-xs disabled" title="delete"><i class="fa fa-trash"></i></a>
            @endif
            @if($r->status == 1)
            <a href="{{ url('toggle-user-sub-categories-status/0/'.$r->categories_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
            <a href="{{ url('toggle-user-sub-categories-status/1/'.$r->categories_id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif

          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Categories</th>
          <th>Sub Categories</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>