@php $page='prescription' @endphp
<!-- section start -->
<section class="section-b-space">
   <div class="container">
      <div class="row">
      <div class="col-lg-3">
            @include('UI/components/user/userweb_sidebar')                
            </div>
         <div class="col-lg-9">
            <div class="dashboard-right">
               <div class="dashboard">
                  <div class="box-account box-info w-100">
                     <div class="box-head">
                        <div class="row">
                                 @if(Auth::check())
                             @if($result != null)
                           <div class="col-md-12">
                              <button type="button" class="btn btn-solid" data-toggle="collapse" data-target="#demo">View Status</button>
                              <div id="demo" class="collapse">
                                 <br>
                                 <div class="table-responsive">
                                    <table class="table cart-table ">
                                       <thead>
                                          <tr class="table-head">
                                             <th scope="col">Prescription</th>
                                             <th scope="col">Medicine</th>
                                             <th scope="col">status</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($result as  $r1)   
                                          <tr>
                                             <td class="prescription2">
                                                <a href="{{ asset($r1->prescription_image) }}"><img src="{{ asset($r1->prescription_image) }}" class="img-fluid" alt="Prescription"></a>
                                             </td>
                                             <td>
                                                &nbsp;{{$r1->comment}}
                                             </td>
                                             <td>
                                                <button class="btn btn-success">Approved</button>
                                             </td>
                                          </tr>
                                          @endforeach
                                       </tbody>
                                       <!-- <tbody>
                                          <tr>
                                             <td class="prescription2">
                                                <a href="#"><img src="../assets/images/prescription.jpg" class="img-fluid" alt="1"></a>
                                             </td>
                                             <td>
                                                &nbsp;
                                             </td>
                                             <td>
                                                <button class="btn btn-success">Approved</button>
                                             </td>
                                          </tr>
                                       </tbody>
                                       <tbody>
                                          <tr>
                                             <td class="prescription2">
                                                <a href="#"><img src="../assets/images/prescription.jpg" class="img-fluid" alt="1"></a>
                                             </td>
                                             <td>
                                                &nbsp;
                                             </td>
                                             <td>
                                                <button class="btn btn-success">Approved</button>
                                             </td>
                                          </tr>
                                       </tbody> -->

                                       @else 
                                       <div class="row cart-buttons">
                                                <div class="col-12"><a href="{{url('/')}}" class="btn btn-solid">continue shopping</a></div>
                                            </div>  
                                        @endif  
			                            @endif
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <h2>Existing Prescription</h2>
                     </div>
                     <div class="box">
                        <div class="row">
                        <?php $i=1; ?>
                        @foreach($result as  $r1)
                                @if($r1->prescription_image != null)                                   
                           <div class="col-sm-6 prescription">                          
                                    <address>
                                        <input type="radio" class="form-check-input" name="prescription_id" value="{{$r1->id}}">
                                        <img src="{{ asset($r1->prescription_image) }}" class="img-fluid" alt="prescription">
                                        <div><b>Prescription  <?php echo $i; ?> </b><br><b> <?php echo date('d-m-Y', strtotime($r1->created_at)); ?></b><br>
                                        <button class="btn btn-solid">Submit</button> &nbsp; <button class="btn btn-solid">Delete</button> 
                                        </div>
                                    </address>                             
                           </div>                         
                           <?php $i++; ?>
                           @endif                          
                            @endforeach
                           <!-- <div class="col-sm-6 prescription">
                              <address>
                                 <input type="radio" class="form-check-input" name="optradio">
                                 <img src="../assets/images/prescription.jpg" class="img-fluid" alt="prescription">
                                 <div><b>Prescription 2</b><br><b>5-Dec-2020</b><br>
                                    <button class="btn btn-solid">Submit</button> &nbsp; <button class="btn btn-solid">Delete</button> 
                                 </div>
                              </address>
                           </div> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- section end -->