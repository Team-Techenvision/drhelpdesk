
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Product attribute</h3>
    <a href="{{url('add-product-attributes/'.$products_id)}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Product Attribute</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Category</th>   
          <th>Name</th>  
          <th>Size</th>   
          <th>Color</th>
          <!-- <th>In Stock</th>    -->
          <th>Price</th>   
          <th>Website Price</th>   
          <th>Shop Price</th>   
          <th>In Stock</th>      
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; 
        ?>
        @foreach($product as $r)
          @php
            $category = DB::table('categories')->where('categories_id',$r->categories)->pluck('category_name')->first();
            $product_size = DB::table('sizes')->where('id',$r->product_size)->pluck('size_name')->first();
          @endphp
        <tr>
          <td>{{$count++}}</td>
          @if($category != null)
          <td>{{$category}} </td> 
          @else
          <td>category Not Found</td> 
          @endif
          <td>{{$r->product_name}} </td> 
          <td>{{$product_size}} </td>  
          <td> <span style="background-color:{{$r->product_color}}; height:20px; width:20px; color:{{$r->product_color}};">color </span>  </td>
        <!-- <td><a class="btn btn-xs" title="In-Stock" onclick="updateProduct({{$r->products_id }})"><i id="stock-{{$r->products_id}}" class="fa {{ $r->in_stock ? 'fa-toggle-on' : 'fa-toggle-off'}} ?>"></i></a></td> -->
         
              
         <td>{{$r->price }} </td>  
          <td>{{$r->special_price }} </td>  
          <td>{{$r->shop_price }} </td>  
          <td><a class="btn btn-xs" title="In-Stock" onclick="updateProduct({{$r->products_id }})"><i id="stock-{{$r->products_id}}" class="fa {{ $r->in_stock ? 'fa-toggle-on' : 'fa-toggle-off'}} ?>"></i></a></td>
          <td>              
            <a href="{{url('edit-product-attribute/'.$r->id.'/'.$products_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-product-attribute/'.$r->id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
             @if($r->status == 1)
              <a href="{{ url('toggle-product-attribute-status/0/'.$r->id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
              <a href="{{ url('toggle-product-attribute-status/1/'.$r->id) }}" class="btn btn-success btn-xs">Activate</a>
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
          <th>Price</th>   
          <th>Special Price</th>   
          <th>Top Selling Product</th>   
          <th>Featured Product</th> 
          <th>In Stock</th>            
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