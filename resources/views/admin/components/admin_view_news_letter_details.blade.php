
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View News Letters Details</h3> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th> 
          <th>Email</th>   
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($news_letter as $r) 
        <tr>
          <td>{{$count++}}</td>  
          <td>{{$r->newslatter_email}} </td>   
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th> 
          <th>Email</th>     
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 