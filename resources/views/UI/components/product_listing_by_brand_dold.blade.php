@extends('main_master') 
	@section('main_content') 
	<div class="block-header block-header--has-breadcrumb block-header--has-title">  
		<div class="container">  
			<div class="block-header__body"> 
				<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb"> 
					<ol class="breadcrumb__list"> 
						<li class="breadcrumb__spaceship-safe-area" role="presentation"></li> 
						<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a> 
						</li> 
						<li class="breadcrumb__item breadcrumb__item--parent"><a href="#" class="breadcrumb__item-link">Product</a> 
						</li> 
						<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Product By Brand<span> 
						</li> 
						<li class="breadcrumb__title-safe-area" role="presentation"></li> 
					</ol> 
				</nav> 
			</div> 
		</div> 
	</div>  
	<form action="{{route('filtersubbrand.show',[$data['parameter'][0]] )}}" method="post">
		@csrf  
		<div class="block-split block-split--has-sidebar"> 
			<div class="container"> 
            <!--<div class="block-split__row row no-gutters"> -->
				<div class="row"> 
                <!--<div class="block-split__item block-split__item-sidebar col-auto"> -->
					<div class="col-12 col-md-3"> 
                   <!-- <div class="sidebar sidebar--offcanvas--mobile"> -->
						<div class="sidebar"> 
							<div class="sidebar__backdrop"></div> 
							<div class="sidebar__body">  
								<div class="sidebar__content"> 
									<div class="widget widget-filters widget-filters--offcanvas--mobile" data-collapse data-collapse-opened-class="filter--opened"> 
										<div class="widget-filters__list">  
											<div class="widget-filters__item">

												<div class="filter filter--openedd" data-collapse-item>

													<button type="button" class="filter__title collapse-init" data-collapse-trigger>Price <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

													</button>

													<div class="filter__body" data-collapse-content>

														<div class="filter__container">

															<div class="filter-price" data-min="0" data-max="{{$data['maxValue']}}" data-from="{{$minpr}}" data-to="@if($maxpr != null) {{$maxpr}} @else {{$data['maxValue']}} @endif">

																<div class="filter-price__slider"></div>

																<div class="filter-price__title-button">

																	<div class="filter-price__title"> <i class="fas fa-rupee-sign"></i><span class="filter-price__min-value"></span> ??? <i class="fas fa-rupee-sign"></i><span class="filter-price__max-value"></span>

																	</div> 

																	<input type="hidden" name="minpr" id="minpr" />

																	<input type="hidden" name="maxpr" id="maxpr" />



																</div>

															</div>

														</div>

													</div>

												</div> 
											</div> 
											 
											<div class="widget-filters__item">

												<div class="filter filter--openedd" data-collapse-item>

													<button type="button" class="filter__title collapse-init" data-collapse-trigger>Tags <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

													</button>

													<div class="filter__body" data-collapse-content>

														<div class="filter__container">

															<div class="filter-list">

																<div class="filter-list__list">  

																	@foreach($data['mainTags'] as $p) 

																		<label class="filter-list__item"><span class="filter-list__input input-radio"><span class="input-radio__body"><input class="input-radio__input" name="tags" type="radio" value="{{$p}}" @if($p == $tags) checked @endif> <span class="input-radio__circle"></span> </span> 
																			</span><span class="filter-list__title">{{ucfirst($p)}} </span><span class="filter-list__counter"></span> 
																		</label> 

																	@endforeach 

																</div>

															</div>

														</div>

													</div>

												</div> 
											</div>

											<div class="widget-filters__item"> 
 
												<div class="filter filter--openedd" data-collapse-item>

													<button type="button" class="filter__title collapse-init" data-collapse-trigger>Rating <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

													</button>

													 

													<div class="filter__body" data-collapse-content>

														<div class="filter__container">

															<div class="filter-rating">

																<ul class="filter-rating__list">

																	<li class="filter-rating__item">

																		<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" {{in_array(5,$rating)?'checked':''}} value="5"  name="rating[]"> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																			</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div></div></div></span><span class="filter-rating__item-title sr-only">5 stars </span> 
																		</label>

																	</li>

																	<li class="filter-rating__item">

																		<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" value="4"  name="rating[]" {{in_array(4,$rating)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																			</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star"></div></div></div></span><span class="filter-rating__item-title sr-only">4 stars </span> 

																		</label>

																	</li>

																	<li class="filter-rating__item">

																		<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" value="3"  name="rating[]" {{in_array(3,$rating)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																			</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star"></div><div class="rating__star"></div></div></div></span><span class="filter-rating__item-title sr-only">3 stars </span> 
																		</label>

																	</li>

																	<li class="filter-rating__item">

																		<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" value="2"  name="rating[]" {{in_array(2,$rating)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																			</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star"></div><div class="rating__star"></div><div class="rating__star"></div></div></div></span><span class="filter-rating__item-title sr-only">2 stars </span> 

																		</label>

																	</li>

																	<li class="filter-rating__item">

																		<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" value="1"  name="rating[]" {{in_array(1,$rating)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																			</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star"></div><div class="rating__star"></div><div class="rating__star"></div><div class="rating__star"></div></div></div></span><span class="filter-rating__item-title sr-only">1 star </span> 
																		</label>

																	</li>

																</ul>

															</div>

														</div>

													</div>

												</div> 
											</div>  
										</div> 
										<div class="widget-filters__actions d-flex"> 
											<button type="submit" class="btn btn-primary btn-sm">Filter</button> 
											<button type="reset" class="btn btn-secondary btn-sm">Reset</button> 
										</div> 
									</div>  
								</div> 
							</div> 
						</div> 
					</div> 
					<!--<div class="block-split__item block-split__item-content col-auto"> -->
                <div class="col-12 col-md-9">
						<div class="block"> 
							<div class="products-view"> 
								<div class="products-view__options view-options view-options--offcanvas--mobile"> 
									<div class="view-options__body">  
										@php 
		                                	$count = DB::table('products')->count(); 
		                            	@endphp 
 										<div class="view-options__spring"></div> 
										<div class="view-options__select">  
											<label for="view-option-sort">Sort:</label>  
											<select id="view-option-sort" class="form-control form-control-sm price_sorting" name="price_sort"> 
												<option value="">Select</option> 
												<option value="0" {{$sortP == 'asc'? 'selected':''}}>Low Price</option> 
												<option value="1" {{$sortP == 'desc'? 'selected':''}}>High Price</option> 
											</select> 
										</div> 
									</div>  
								</div> 
								<div class="products-view__list products-list products-list--grid--4" data-layout="grid" data-with-features="false">  
									@php   
										$brand_name = DB::table('brands')->where('id',$form_search)->pluck('brand_name')->first();  
									@endphp 

									<p style="color:grey; font-size:22px;">Product Brand Is {{ucfirst($brand_name)}}</p>
									<div class="products-list__content"> 
										@if($data['product']->count() > 0)
										@foreach($data['product'] as $r)

											@php  
												$category = DB::table('product_images')->where('type',2)->where('products_id' , $r->products_id)->pluck('product_image')->first();  
												$category_name = DB::table('categories')->where('categories_id',$r->categories)->pluck('category_name')->first();  
												$percent = (($r->price - $r->special_price)*100) /$r->price ; 
											@endphp 

											<div class="products-list__item">  
												<div class="product-card"> 
													<div class="product-card__image">

														<span class="custom-badge"> 
				                                            @if($r->special_price != null)
															@if($percent == null) 
															@else
															<span class="custom-label custom-label-large custom-label-success arrowed-in">  
																{{ round($percent)}}% off 
															</span>
															@endif
															@endif 
									                  	</span> 
														<a href="{{url('/product-detail/'.$r->products_id)}}">

															@if(file_exists(public_path($category)))
			                                                  <img src="{{asset($category)}}" alt="">
			                                                @elseif($category == null)
			                                                  <img src="{{asset('UI/images/product_default1.png')}}" alt="">
			                                                @else
			                                                  <img src="{{asset('UI/images/product_default1.png')}}" alt="">
			                                                @endif
														</a> 
													</div> 
													<div class="product-card__info">

<!-- 														<div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> {{$r->product_code}}</div> -->

														<div class="product-card__name">

															<div>

																<div class="product-card__badges">
																	<div class="tag-badge tag-badge--hot">{{$category_name}}</div> 
											                        @if($r->featured_product != null)

											                        <div class="tag-badge tag-badge--new">hot</div>
																     @endif
											                        @if($r->top_selling_product != null)

											                        <div class="tag-badge tag-badge--hot">sale</div>
											                       @endif 
											                    </div>

											                    <a href="{{url('/product-detail/'.$r->products_id)}}">{{$r->product_name}}</a> 
															</div> 
														</div>

														<div class="product-card__rating">

<!-- 															<div class="rating product-card__rating-stars">

																<div class="rating__body"> -->

<!-- 																	{!! str_repeat('<i class="fa fa-star" aria-hidden="true" style="color:#ea8330;"></i>', $r->rating) !!}

			                										{!! str_repeat('<i class="fa fa-star-o" aria-hidden="true" style="color:red;"></i>', 5 - $r->rating) !!}  -->

<!-- 																</div> 
															</div> -->
															<?php
			                                                  	$rev = DB::table('reviews')->where('status',0)->where('product_id' , $r->products_id)->get(); 
			           											$revCount = $rev->count();
													           	if($revCount > 0){
													               $ee = 0;
													               foreach($rev as $re){
													                   $ee = $ee+$re->rating;
													               }
													               $avg = round($ee/$revCount,2);
													           	}
													        ?>
			           
<!-- 															<div class="product-card__rating-label">
				                                                @if($revCount > 0)
					                                                {{$avg}} on {{$revCount}} reviews
					                                       		@endif
			                                                </div> -->
														</div> 
													</div> 
													<div class="product-card__footer">

														<div class="product-card__prices">

															@if($r->special_price == null)

																<div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i> {{$r->price}}.00</div>

															@else

																<div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i> 

																	{{$r->special_price}}.00 

																</div>

															@endif

															@if($r->special_price != null)

			                  								<div class="product-card__price product-card__price--old"><i class="fas fa-rupee-sign"></i> {{$r->price}}.00</div>

			                  								@endif

														</div>

														@php 

										                    $session = Session::getId(); 

										                    $data1=DB::table('temp_carts')->where('product_id',$r->products_id)->where('session_id',$session)->first();

										                @endphp

										                @guest 
			                                                @if($data1==null)
			                                                    
			                                                    @if($r->categories =='15')
			                                                        @if(Session::get('location_name')!='notfound')
			                                                            <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
			                                                            
			                                                            <span class="icon-cart-plus"></span>
			                                                            
			                                                            </button>
			                                                            </a>
			                                                        @else
			                                                            <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
			                                                            
			                                                            <span class="icon-cart-plus"></span>
			                                                            
			                                                            </button></a>
			                                                        @endif
			                                                    @else
			                                                    
			                                                        <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
			                                                        
			                                                        <span class="icon-cart-plus"></span>
			                                                        
			                                                        </button>
			                                                        </a>
			                                                    @endif 
			                                                    
										                    @else
			                                                  
										                      <button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">

										                        <span class="icon-cart-plus" style="color:red;"></span>

										                      </button>  

										                    @endif 

										                @else 
										                       @if($r->categories =='15')
			                                                        @if(Session::get('location_name')!='notfound')
			                                                            <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
			                                                            
			                                                            <span class="icon-cart-plus"></span>
			                                                            
			                                                            </button></a>   
			                                                        @else
			                                                            <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
			                                                            
			                                                            <span class="icon-cart-plus"></span>
			                                                            
			                                                            </button></a>
			                                                        @endif
										                       @else
										                            <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">

										                            <span class="icon-cart-plus"></span>

										                            </button></a>   
										                       @endif
			                                                  
			                                            @endguest 
													</div> 
												</div>  
											</div>  
										@endforeach 

									</div>  
								</div>  
                            	@if($data['product']->count() >= 20)
								<div class="products-view__pagination"> 
									<nav aria-label="Page navigation example"> 
										<ul class="pagination">  
											{{ $data['product']->appends($data['page'])->links() }} 
										</ul> 
									</nav>  
								</div> 
                            	@endif
								@else
									<center><p style="font-size:25px; color:#1d99b6;">No product found of this brand</p></center>
								@endif
							</div> 
						</div> 
					</div> 
				</div> 
				<div class="block-space block-space--layout--before-footer"></div> 
			</div> 
		</div>

	</form> 
@stop 
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script>
<script>
	$(function () { 
    var active = true; 
    $('.collapse-init').click(function () {
        if (active) {
            active = false;
            $('.panel-collapse').collapse('show');
            $('.panel-title').attr('data-toggle', ''); 
        } else {
            active = true;
            $('.panel-collapse').collapse('hide');
            $('.panel-title').attr('data-toggle', 'collapse'); 
        }
    }); 
});
</script>
