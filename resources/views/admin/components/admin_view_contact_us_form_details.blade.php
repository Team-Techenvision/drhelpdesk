<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Contact US Form Details</h3> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Email</th>  
          <th>Phone Number</th>   
          <th>Message</th>    
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($contact as $r)
        <tr>
          <td>{{$count++}}</td>
          <td>{{$r->name}} </td>   
          <td>{{$r->email}} </td>  
          <td>{{$r->phone_number}} </td>  
          <td>{!!$r->message!!} </td>  
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Email</th>  
          <th>Phone Number</th>   
          <th>Message</th>   
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 