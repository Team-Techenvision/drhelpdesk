
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Product</h3>
    <a href="{{url('add-product')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Product</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Category</th>   
          <th>Name</th>  
          <!-- <th>In Stock</th>    -->
          <!-- <th>Price</th>    -->
          <!-- <th>Special Price</th>    -->
          <th>Top Selling Product</th>   
          <th>Featured Product</th> 
          <th>Add Attribute</th> 
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; 
        ?>
        @foreach($product as $r)
          @php
            $category = DB::table('categories')->where('categories_id',$r->categories)->pluck('category_name')->first();
          @endphp
        <tr>
          <td>{{$count++}}</td>
          @if($category != null)
          <td>{{$category}} </td> 
          @else
          <td>category Not Found</td> 
          @endif
          <td>{{$r->product_name}} </td> 
        <!-- <td><a class="btn btn-xs" title="In-Stock" onclick="updateProduct({{$r->products_id }})"><i id="stock-{{$r->products_id}}" class="fa {{ $r->in_stock ? 'fa-toggle-on' : 'fa-toggle-off'}} ?>"></i></a></td> -->
          <!-- <td>{{$r->price }} </td>   -->
          <!-- <td>{{$r->special_price }} </td>   -->
          <td>{{$r->top_selling_product}} </td>  
          <td>{{$r->featured_product}} </td>   
          <td> <a href="{{url('product-attribute-list/'.$r->products_id)}}">Add Attribute</a> </td>
          <td>
              
            <a href="{{url('edit-product/'.$r->products_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-product/'.$r->products_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
             @if($r->status == 1)
              <a href="{{ url('toggle-product-status/0/'.$r->products_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
              <a href="{{ url('toggle-product-status/1/'.$r->products_id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif 
          </td>
        </tr>
        @endforeach
         </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
        <th>Category</th>
          <th>Name</th>   
          <!-- <th>In Stock</th>  -->
          <!-- <th>Price</th>    -->
          <!-- <th>Special Price</th>    -->
          <th>Top Selling Product</th>   
          <th>Featured Product</th> 
          <th>Add Attribute</th> 
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
   
  </div> 
</div> 
<!-- <style>
  .dataTables_paginate.paging_simple_numbers{
    display: none;
  }
</style> -->
<script type="text/javascript">
function updateProduct(id){
  if(confirm('Do you really want to update stock status?')){
    $.get( "product/in-stock/"+id)
    .done(function( data ) {
      if(data.flag){
        ele = '#stock-'+id;
        $(ele).attr('class', 'fa fa-toggle-on');
      }else{
        ele = '#stock-'+id;
        $(ele).attr('class', 'fa fa-toggle-off');
      }
    });
  }
}
</script>