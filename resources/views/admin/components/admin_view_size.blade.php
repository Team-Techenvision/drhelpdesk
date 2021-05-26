
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Size</h3>
    <a href="{{url('add-size')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Sizes</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
        <th>Sr. No.</th>
        <th>Size Name </th> 
        <th>Status </th>                  
        <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; 
        ?>
        @foreach($size as $r)         
        <tr>
          <td>{{$count++}}</td>        
          <td>{{$r->size_name}} </td>  
          <td>

          <?php if($r->status == '1'){
            echo "Active";
          }else{
            echo "Inctive";            
          }?>
          
          
           </td>        
          <td>              
            <a href="{{url('edit-size/'.$r->id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-size/'.$r->id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
          </td>
        </tr>
        @endforeach
         </tbody> 
      <tfoot>
        <tr>
        <th>Sr. No.</th>
        <th>Size Name </th> 
        <th>Status </th>                 
        <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
   
  </div> 
</div> 
