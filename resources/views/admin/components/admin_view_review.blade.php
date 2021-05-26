@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Review</h3> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bReviewed table-striped">
      <thead>
     
        <tr>
          <th>Sr. No.</th> 
          <th>User Name</th> 
          <th>Product Name</th>   
          <th>Rating</th>   
          <th>Review</th>  
          <th>Reply</th>  
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
      @php 
        $count = 1;  

        @endphp 
        @foreach($review as $r)
       <?php $product_name =  DB::table('products')->where('products_id',$r->product_id)->value('product_name');   ?>
      <tr> 
      <td> {{$count++}} </td>
      <td>{{$r->user_name}}</td>
      <td><?php echo $product_name; ?></td>
      <td>{{$r->rating}}</td>
      <td>{{$r->comment}}</td>
      <td>{{$r->reply}}</td>
      <td>
      <form action="{{url('reply-review')}}" method="post">
                {{csrf_field()}} 
                <input type="hidden" name="review_id" value="{{ $r->id }}">
                <button type="submit" class="btn btn-xs bg-primary text-white">Reply</button> 
              </form> 

              <form action="{{url('edit-review')}}" method="post">
                {{csrf_field()}} 
                <input type="hidden" name="review_id" value="{{ $r->id }}">
                <button type="submit" class="btn btn-xs bg-primary text-white"><i class="fa fa-edit"></i></button> 
              </form> 
              <a href="{{url('delete-review/'.$r->id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
      </td>
      </tr>

      @endforeach
      </tbody> 
      <tfoot>
      <tr>
          <th>Sr. No.</th> 
          <th>User Name</th> 
          <th>Product Name</th>   
          <th>Rating</th>   
          <th>Review</th>  
          <th>Reply</th>   
           <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div>   

   </div>
    </section>
@stop      