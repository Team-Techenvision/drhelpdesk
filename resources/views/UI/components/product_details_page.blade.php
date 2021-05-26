<!-- breadcrumb start -->
<section class="breadcrumb-section section-b-space" style="padding-bottom:0px !important">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
               <ol class="bread breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                  <!-- <li class="breadcrumb-item " ><a href="category.php">Cosmetic</a></li>
				  <li class="breadcrumb-item"><a href="sub-category.php">Makeup</a></li>
                  <li class="breadcrumb-item " ><a href="sub-sub-category.php">lips</a></li>
				  <li class="breadcrumb-item " ><a href="#">lipstick</a></li>
				  <li class="breadcrumb-item " ><a href="#">Colorbar</a></li>
				   <li class="breadcrumb-item " ><a href="#">Colorbar Ultimate 8Hrs Stay Lipstick</a></li> -->
            </nav>
         </div>
      </div>
   </div>
</section>
<!-- breadcrumb End -->
<?php 
    $products_id = Session::get('product_id1');
    $product_m_img = DB::table('product_images')->where('products_id',$products_id)->where('type',2)->first();
    $product_s_img = DB::table('product_images')->where('products_id',$products_id)->get();
//    dd($product_m_img);

?>
<!-- section start -->
<section>
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-sm-2 col-xs-12">
                    <div class="row">
                        <div class="col-12 p-0">
                            <div class="slider-right-nav">
                                @foreach($product_s_img as $row)                                
                                <div><img src="{{url($row->product_image)}}" alt="" class="img-fluid "></div>
                                @endforeach                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-sm-10 col-xs-12 order-up">
                    <div class="product-right-slick">
                    <?php $i=0; ?>
                    @foreach($product_s_img as $row)
                    <div><img src="{{url($row->product_image)}}" alt="" class="img-fluid  image_zoom_cls-<?php echo $i; ?> sub-panel"></div>  
                    <?php $i++; ?>                     
                    @endforeach 
                    </div>
                </div>
				
                <div class="col-lg-6 rtl-text">
                    <div class="product-right">                      
                           
                        <h2 style="color: #1d99b5;">{{$product->product_name}}</h2>						<h5>
                        <span>4.3*</span>
                        <p class="p-txt">(43)reviews</p>
                        </h5>
                        <?php if($product->special_price != null){ ?>
                        <h4><del><i class="fa fa-inr" aria-hidden="true"></i>{{$product->price}}</del><span>55% off</span></h4>
                        <h3><i class="fa fa-inr" aria-hidden="true"></i>{{$product->special_price}}</h3>
                        <?php } else { ?>

                            <h3 ><i class="fa fa-inr" aria-hidden="true" ></i><span id="product_price_attribute"> {{$product->price}} </span></h3>

                          <?php } ?>  
                        <ul class="color-variant">
                        @foreach($attributes as $color) 
                            <!-- <li class="bg-light0 active"></li> -->
                            <li class="" style="background-color:{{$color->product_color}}"></li>
                            <!-- <li class="bg-light2"></li> -->
                        @endforeach
                        </ul>
                        <div class="product-description border-product">
                            <!-- <h6 class="product-title size-text">select size <span><a href="#" data-toggle="modal" data-target="#sizemodal">size chart</a></span></h6>
                            <div class="modal fade" id="sizemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sheer Straight Kurta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body"><img src="../assets/images/size-chart.jpg" alt="" class="img-fluid "></div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="size-box">
                                <ul>
                                    <!-- <li class="active"><a href="javascript:void(0)">s</a></li> -->
                                    @foreach($attributes as $size)                                                                       
                                 <li><a href="javascript:void(0)" id="{{$size->id}}" onclick="fetch_attributes('{{$size->id}}')">{{$size->size_name}}</a></li>
                                 @endforeach
                                     <!--   <li><a href="javascript:void(0)">l</a></li>
                                    <li><a href="javascript:void(0)">xl</a></li> -->
                                </ul>
                            </div>
							 <div class="border-product">
                            <h6 class="product-title">share more -save more</h6>
                            <div class="product-icon">
                                <ul class="product-social">
                                @if(Auth::check())
                                    <li><a href="javascript:void(0)" class="shair" onclick="copyUrl('facebook')"><i class="fa fa-facebook"></i></a></li>
                                    <!-- <li><a href="#"  class="shair" onclick="copyUrl()" ><i class="fa fa-google "></i></a></li>
                                    <li><a href="#"  class="shair" onclick="copyUrl()"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"  class="shair" onclick="copyUrl()"><i class="fa fa-instagram"></i></a></li> -->
                                    <li><a href="javascript:void(0)"  class="shair" onclick="copyUrl('whatsup')"><i class="fa fa-whatsapp" ></i></a></li>
                                @endif
                                </ul>
                                <?php $attribute_id_wishlist = $product->id; ?>    
                            <!-- <span id="attribute_id_wishlist">{{$attribute_id_wishlist}}</span> -->
                                @if(Auth::check())
                                <div class="d-inline-block">
									@php 
										$result1=DB::table('wishlists')->where('product_id',$product->products_id)->where('user_id',Auth::user()->id)->count();
										$user_id =Auth::user()->id; 
										if($result1 == 0){
									@endphp                                
                                   <a href="{{url('add-wishlist/'.$product->products_id.'/'.$attribute_id_wishlist.'/'.$user_id)}}"> <button class="wishlist-btn"><i class="fa fa-heart"></i><span class="title-font">Add To WishList</span></button> </a>
       
                                @php } else{ @endphp
                                    <a href="{{url('add-wishlist/'.$product->products_id.'/'.$attribute_id_wishlist.'/'.$user_id)}}"> <button class="wishlist-btn"><i class="fa fa-heart"></i><span class="title-font">Add To WishList</span></button> </a>
                                    @php 
										}
									 @endphp
									
                                </div>
                                @endif
                            </div>
                        </div>
                        <form action="{{url('/cart')}}" method="get">
							@csrf
                            <h6 class="product-title">quantity</h6>
                            <div class="qty-box">
                                <div class="input-group"><span class="input-group-prepend"><button type="button" class="btn quantity-left-minus" data-type="minus" data-field=""><i class="ti-angle-left"></i></button> </span>
                                    <input type="text" name="quantity" class="form-control input-number" value="1"> <span class="input-group-prepend"><button type="button" class="btn quantity-right-plus" data-type="plus" data-field=""><i class="ti-angle-right"></i></button></span></div>
                            </div>
                        </div>
                        <div class="product-buttons">                          
                            <input type="hidden" name="products_id" id="product_id_detail_page" value="{{$product->products_id}}">  
                            <input type="hidden" name="attribute_id" id="attribute_id_detail_page" value="{{$product->id}}">
                            <button type="submit" name="add_to_card" class="btn btn-solid">Add To Cart</button>                       
                         <!-- <a href="#" data-toggle="modal" data-target="#addtocart" class="btn btn-solid">add to cart</a> <a href="#" class="btn btn-solid">buy now</a> -->
                        </div>  
                        </form>                     
                        <!-- <div class="border-product">
                            <h6 class="product-title">Time Reminder</h6>
                            <div class="timer">
                                <p id="demo"><span>25 <span class="padding-l">:</span> <span class="timer-cal">Days</span> </span><span>22 <span class="padding-l">:</span> <span class="timer-cal">Hrs</span> </span><span>13 <span class="padding-l">:</span> <span class="timer-cal">Min</span> </span><span>57 <span class="timer-cal">Sec</span></span>
                                </p>
                            </div>
                        </div>                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->

<!-- product-tab starts -->
<section class="tab-product m-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-selected="true">Description</a>
                        <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-profile" role="tab" aria-selected="false">Details</a>
                        <div class="material-border"></div>
                    </li> 
                    <?php 
						$review = DB::table('reviews')->where('product_id',$product->products_id)->get(); 
									
            		?>                 
                    <li class="nav-item"><a class="nav-link" id="review-top-tab" data-toggle="tab" href="#top-review" role="tab" aria-selected="false">Write Review<span class="badge badge-primary ml-1">{{$review->count()}}</span></a>
                        <div class="material-border"></div>
                    </li>                   
                </ul>
                <div class="tab-content nav-material" id="top-tabContent">
                    <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                    <p>{{$product->short_description}}</p>
                    </div>
                    <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                        <p> {!!$product->long_description!!}</p>                        
                    </div>
                    <?php 
						$review = DB::table('reviews')->where('product_id',$product->products_id)->get(); 
					?>                   
                    <div class="tab-pane fade" id="top-review" role="tabpanel" aria-labelledby="review-top-tab">
                        <div class="reviews-view">
                            <div class="reviews-view__list">
                                <div class="reviews-list">
                                    <ol class="reviews-list__content">
                                        @foreach($review as $r)
                                        <?php 
                                           
                                            $image_user = DB::table('user_details')->where('user_id',$r->user_id)->first(); 
                                        ?>
                                        <li class="reviews-list__item">
                                            <div class="review">
                                                <div class="review__body">
                                                    <div class="review__avatar">
                                                        @if(!empty($image_user->image))
                                                        <img src="{{asset($image_user->image??$image_user->image??'')}}" alt="" height="40px" width="40px">
                                                        @endif
                                                    </div>
                                                    <div class="review__meta">
                                                        <div class="review__author">{{$r->user_name}}</div>
                                                        <!-- <div class="review__date">{{ date('M j, Y', strtotime($r->created_at)) }}</div> -->
                                                    </div>
                                                    <div class="review__rating">
                                                        <div class="rating">
                                                            <div class="rating__body">
                                                                {!! str_repeat(' <i class="fa fa-star" aria-hidden="true"></i>', $r->rating ) !!}
                                                                {!! str_repeat(' <i class="fa fa-star-o" aria-hidden="true"></i>', 5 - $r->rating ) !!} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="review__content typography more" >{{$r->comment}}</div>
                                                     @if(isset($r->reply) && $r->reply != null)
                                                    <div class="alert alert-info w-100 mt-2" role="alert">                                                                   
                                                        <div class="review__content typography text-right">{{$r->reply}}</div>
                                                        <div class="review__content typography text-right">Team Dr. Helpdesk</div>                                                                   
                                                </div>
                                                @endif
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach 
                                    </ol>                                    
                                </div>
                            </div> 
                        </div>
                        @if(Auth::check())
                        <form class="theme-form">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="media">
                                        <label>Rating</label>
                                        <div class="media-body ml-3">
                                            <div class="rating three-star"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control"  placeholder="Email" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="review">Review Title</label>
                                    <input type="text" class="form-control"  placeholder="Enter your Review Subjects" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="review">Review Title</label>
                                    <textarea class="form-control" placeholder="Wrire Your Testimonial Here" id="exampleFormControlTextarea1" rows="6"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-solid" type="submit">Submit YOur Review</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product-tab ends -->


<!-- product section start -->
<section class="section-b-space ratio_square product-related">
    <div class="container">
        <div class="row">
            <div class="col-12 product-related">
                <h2 class="title pt-0">related products</h2>
            </div>
        </div>
        <div class="slide-6"> 
            @if($product->sub_categories != null) 
            @php
			    $top_selling_product1 = DB::table('products')->where('top_selling_product' , '!=', null)->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->where('sub_categories' , $product->sub_categories)->where('products.status',0)->orderBy(DB::raw('RAND()'))->take(30)->get(); 
            @endphp 
            @foreach($top_selling_product1 as $r)
            <?php 
            $category = DB::table('product_images')->where('type',2)->where('products_id' , $r->products_id)->pluck('product_image')->first(); 

            $percent = (($r->price - $r->special_price)*100) /$r->price ;
            ?>   
            <div class="">
                <div class="product-box">
                    <div class="img-block">
					 <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share" title="Share more- Save more" ></a>
                        <a href="{{url('/product-detail/'.$r->products_id)}}"><img src="{{url($category)}}" class=" img-fluid bg-img" alt=""></a>

                        <div class="cart-details">
                            <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                            <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <span class="custom-badge">
                        @if($r->special_price != null)
                            @if($percent == null) 
                            @else
                                <span class="custom-label custom-label-large custom-label-success arrowed-in text-white pl-1 pr-1" style="background-color: #121943!important;">  
                                      {{ round($percent)}}% off 
                                </span>
                            @endif
                        @endif
                    </span>
                    <div class="product-info">
                        <a href="#"><h6>{{$r->product_name}}</h6></a>
                        @if($r->special_price)
                        <h5><i class="fa fa-inr" aria-hidden="true"></i>{{$r->special_price}}</h5>
                        @else 
                        <h5><i class="fa fa-inr" aria-hidden="true"></i>{{$r->price}}</h5>
                        @endif
                    </div>
                    <div class="addtocart_box">
                        <div class="addtocart_detail">
                            <div>
                                <div class="color">
                                    <h5>color</h5>
                                    <ul class="color-variant">
                                        <li class="light-purple active"></li>
                                        <li class="theme-blue"></li>
                                        <li class="theme-color"></li>
                                    </ul>
                                </div>
                                <div class="size">
                                    <h5>size</h5>
                                    <ul class="size-box">
                                        <li class="active">xs</li>
                                        <li>s</li>
                                        <li>m</li>
                                        <li>l</li>
                                        <li>xl</li>
                                    </ul>
                                </div>
                                <div class="addtocart_btn">
                                    <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="close-cart">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
            @endif 
        </div>
    </div>
</section>
<!-- product section end -->






