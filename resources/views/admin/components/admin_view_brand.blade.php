
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Brand</h3>
    <a href="{{url('add-brand')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Brand</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Brand Name</th>   
          <th>Category</th>   
          <th>Image</th>   
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($brand as $r)
        @php
          $brand = DB::table('brand_categories')->where('brand_id',$r->id)->get(); 
        @endphp
        <tr>
          <td>{{$count++}}</td>
          <td>{{$r->brand_name}} </td> 
          <td>
            @if($brand != null)
              @foreach($brand as $brands)
                @php
                  $brand1 = DB::table('categories')->where('categories_id',$brands->category_id)->first(); 
                @endphp
                @if($brand1 != null)
                <b>{{$brand1->category_name}},</b><br>
                @endif
              @endforeach
            @endif
          </td>
          <td><img src="{{ url($r->image) }}" style="width: 80px;"></td>  
          <td>
            <a href="{{url('edit-brand/'.$r->id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-brand/'.$r->id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
            <a href="{{ url('toggle-brand-status/0/'.$r->id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
            <a href="{{ url('toggle-brand-status/1/'.$r->id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif 
            @if($r->parent_id != 15)
            @if($r->show_brand == 1)
              <a href="{{ url('show-brand-home-page/0/'.$r->id) }}" class="btn btn-primary btn-xs">Not Show Home Page</a> 
            @else
              <a href="{{ url('show-brand-home-page/1/'.$r->id) }}" class="btn btn-warning btn-xs">Show Home Page</a> 
            @endif 
            @endif 
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Brand Name</th>   
          <th>Category</th>    
          <th>Image</th>   
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div>  