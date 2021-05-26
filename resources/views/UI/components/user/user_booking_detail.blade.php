 
<div class="block-header block-header--has-breadcrumb block-header--has-title">
    <div class="container">
        <div class="block-header__body">
            <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                    <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Booking Details </span>
                    </li>
                    <li class="breadcrumb__title-safe-area" role="presentation"></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="block">
    <div class="container">
        @if(session('msg') != null)
            <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session('msg')}}
            </div>
        @endif
        <div class="row">
            @include('UI/components/user/user_sidebar')
           <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                <div class="user-orders">                               
                    <div class="card">
                        <div class="card-header">
                            <h5>Lab test/Health packages Details</h5>
                        </div>
                    <div class="card-divider"></div>
                    <div class="card-table">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                    <th>S.No.&nbsp;&nbsp;&nbsp;</th>
                                    <th>Product&nbsp;Image</th>
                                    <th>Order&nbsp;Id</th>
                                    <th>Sub&nbsp;Order&nbsp;Id</th> 
                                    <th>Product&nbsp;Details</th>                                    
                                    <th>Total&nbsp;Amount</th>
                                    <th>Status</th> 
                                    <th>Testing&nbsp;Report</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    @$count = 1; 
                                    ?>
                                    @foreach($order as $r)
                                      <?php 
                                         
                                        if($r->type == 2){
                                          $status = DB::table('order_status')->where('status_value',$r->order_status)->where('type',2)->first(); 
                                         
                                          $image = DB::table('product_images')->where('type',2)->where('products_id' , $r->prod_id)->pluck('product_image')->first();
                                          $product_category = DB::table('products')->where('products_id',$r->prod_id)->first();  
                                        }elseif($r->type == 3){
                                          $status = DB::table('order_status')->where('status_value',$r->order_status)->where('type',2)->first(); 
                                          $image= DB::table('packages')->where('id',$r->prod_id)->pluck('image')->first(); 
                                        }
                                      ?>
                                        <tr>
                                          <td>{{$count++}}</td>
                                          <td>
                                          @if($r->type == 2 ||$r->type == 3)
                                            <img src="{{ asset($image) }}" style="width:80px;"> 
                                          @endif
                                        </td>
                                          <td>{{$r->order_id}} </td> 
                                          <td>{{$r->sub_order_id}} </td>  
                                          <td><b>Product Name</b> : {{$r->prod_name}} <br> 
                                              <b>Quantity</b> :{{$r->quantity}}<br> 
                                              <b>Amount</b> :{{$r->sub_total}} 
                                          </td> 
                                           <!--<td>
                                           @if($r->extra_discount != null)
                                                <?php $discount = ($r->sub_total * $r->extra_discount)/100 ;  ?>
                                            {{$r->extra_discount}} <b>% Per Item </b>
                                            {{$discount}} <b> Rs Per Item</b>
                                            @else
                                            0 %
                                            @endif
                                            {{$r->extra_discount}}
                                          </td>-->
                                          <td>
                                             
                                            <!--@if($r->extra_discount != null)
                                                {{$r->quantity * $r->sub_total - $r->extra_discount}}  
                                            @else
                                                {{$r->quantity * $r->sub_total}} 
                                            @endif-->
                                            {{$r->sub_total}}
                                          </td>  
                                          <td>
                                            {{ucfirst($status->status_name)}}  
                                          </td>  
                                         <td>
                                             @if($r->lab_report != null) 
             									 @if(file_exists(public_path($r->lab_report)))
                                                    <center><a href="{{asset($r->lab_report)}}" download target="_blank"><i class="fa fa-download fa-2x"></i> </a></center>
              									@else
                									<b>No Report Uploaded</b>
              									@endif 
            								@else
            									<b>No Report Uploaded</b>
           									@endif 
                                          </td>  
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-divider"></div>
                    <!-- <div class="card-footer">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link page-link--with-arrow" href="#" aria-label="Previous"><span class="page-link__arrow page-link__arrow--left" aria-hidden="true"><i class="fas fa-angle-left"></i></span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item active" aria-current="page"><span class="page-link">2 <span class="sr-only">(current)</span></span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item page-item--dots">
                                <div class="pagination__dots"></div>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">9</a>
                            </li>
                            <li class="page-item"><a class="page-link page-link--with-arrow" href="#" aria-label="Next"><span class="page-link__arrow page-link__arrow--right" aria-hidden="true"><i class="fas fa-angle-right"></i></span></a>
                            </li>
                        </ul>
                    </div> -->
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block-space block-space--layout--before-footer"></div>