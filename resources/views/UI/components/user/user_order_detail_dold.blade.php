<div class="block-header block-header--has-breadcrumb block-header--has-title">
    <div class="container">
        <div class="block-header__body">
            <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                    <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Order Details </span>
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
                            <h5>Order Details</h5>
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
                                            <th>Dewallet&nbsp;Coin</th>
                                            <th>Product&nbsp;Details</th>                                    
                                            <th>Total&nbsp;Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            @$count = 1; 
                                        ?>
                                        @foreach($order as $r)
                                            <?php  
                                                if($r->type == 1 ||$r->type == 2){
                                                  $status = DB::table('order_status')->where('status_value',$r->order_status)->where('type',1)->first(); 

                                                  $image = DB::table('product_images')->where('type',2)->where('products_id' , $r->prod_id)->pluck('product_image')->first();
                                                  $product_category = DB::table('products')->where('products_id',$r->prod_id)->first();   
                                                }elseif($r->type == 3){
                                                  $status = DB::table('order_status')->where('status_value',$r->order_status)->where('type',1)->first(); 
                                                  $image= DB::table('packages')->where('id',$r->prod_id)->pluck('image')->first();  
                                                }
                                            ?>
                                            <tr>
                                                <td>{{$count++}}</td>
                                                <td>
                                                    @if($r->type == 1 ||$r->type == 2)
                                                    <a href="{{url('/product-detail/'.$r->prod_id)}}"> <img src="{{ asset($image) }}" style="width:80px;"></a>
                                                    @elseif($r->type == 3)
                                                    <img src="{{ asset($image) }}" style="width:80px;"> 
                                                    @endif
                                                </td>
                                                <td>{{$r->order_id}} </td> 
                                                <td>{{$r->sub_order_id}} </td>  
                                                <td>@if($r->earn_dewallet_coin != null){{$r->earn_dewallet_coin}} Coin @else 0 Coin @endif</td>  
                                                <td><b>Product Name</b> : <a href="{{url('/product-detail/'.$r->prod_id)}}"> {{$r->prod_name}}</a> <br> 
                                                    <b>Quantity</b> :{{$r->quantity}}<br> 
                                                    <b>Amount</b> :{{$r->sub_total}} 
                                                </td>  
                                                <td> 
                                                <?php	$pquantity=$r->quantity;
                                                	$ptotal=$r->sub_total;
                                                	$total=$pquantity*$ptotal;
                                                	echo $total;
                                                ?>
                                                    
                                                </td>  
                                                <td>
                                                    {{ucfirst($status->status_name)}}  
                                                </td>   
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-divider"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block-space block-space--layout--before-footer"></div>