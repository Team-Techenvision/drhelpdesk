 
<div class="block block-products-carousel" data-layout="grid-4">
  <div class="container">
  	@if(session('message') != null)
      <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('message')}}
      </div>
    @endif
    <div class="section-header">
      <div class="section-header__body">
        <h2 class="section-header__title">Popular Health Packages</h2>
        <div class="section-header__spring"></div>
        
        <div class="section-header__arrows">
          <div class="arrow section-header__arrow section-header__arrow--prev arrow--prev">
            <button class="arrow__button" type="button">
              <i class="fas fa-angle-left"></i>
            </button>
          </div>
          <div class="arrow section-header__arrow section-header__arrow--next arrow--next">
            <button class="arrow__button" type="button">
              <i class="fas fa-angle-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="block-products-carousel__carousel">
      <div class="block-products-carousel__carousel-loader"></div>
      <div class="owl-carousel health-package">
        @foreach($packages as $r)
      
      
  <?php
                   // dd($r);
$per = 0;
if($r['special_price'] >0 && $r['package_cost'] > 0){
    $s = $r['package_cost'] - $r['special_price'];
    $per = round(($s*100)/$r['package_cost']);
    $per = round($per);
    
}
if( $r['offer_discount']> 0 && $r['special_price'] >0){
   $rrt = ($r['special_price'] * $r['offer_discount'])/100;
   $r['special_price']  = $r['special_price'] - round($rrt);
}   

if( $r['offer_discount']> 0 && $r['special_price'] == null){
     $discount = ($r['offer_discount'] * $r['package_cost']) / 100;
                    $discount1 = $r['package_cost'] - $discount;
                    $r['special_price'] = $discount1;
                    $per = $r['offer_discount'];

}  
?>               
        
        <div class="block-products-carousel__column">
          <div class="block-products-carousel__cell">
            <div class="product-card product-card--layout--grid">
              <div class="product-card__info">
                 @if($per >0)
                  <span class="custom-badge">
                  <span class="custom-label custom-label-large custom-label-success arrowed-in">{{round($per)}}% off</span>
                </span>
                @endif
                <div class="product-card__meta">{{$r->short_disc}}</div>
                <div class="product-card__name">
                  <div>
                    <a href="{{url('package-detail/'.$r->id)}}">{{$r->package_name}}</a>
                  </div>
                </div>
                                </div>
              <div class="product-card__footer">
                <div class="product-card__prices">
                  @php
                    $session = Session::getId();  
                    $data1=DB::table('temp_carts')->where('product_id',$r->id)->where('session_id',$session)->where('type',3)->first();  
                    $temp_carts=DB::table('temp_carts')->where('session_id',$session)->where('type',3)->get();  
                    $discount = ($r->offer_discount * $r->package_cost) / 100;
                    $discount1 = $r->package_cost - $discount;
                  @endphp
					@if($r['special_price'] == null  && $r['offer_discount'] == '0')
                    <div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i>{{$r->package_cost}}</div>
                                     @else
                					@if(!empty($r['special_price']))
				                    <div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i>{{$r['special_price']}}</div>				                    
                					@endif
				                    <div class="product-card__price product-card__price--old"><i class="fas fa-rupee-sign"></i>{{$r['package_cost']}}</div>
				                @endif
                </div>
                @guest  
                  @if($data1 == null)
                    @if(Session::get('location_name')!='notfound')
                    <a href="{{url('package-add-cart/'.$r->id)}}" class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                      <span class="icon-cart-plus"></span>
                    </a> 
                    @else
			 		    <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="product-card__addtocart-icon" type="button" aria-label="Add to cart"><span class="icon-cart-plus"></span></a>
			 		@endif
                  @else
                    <a  style="color:red;" class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                      <span class="icon-cart-plus"></span>
                    </a>
                  @endif
                @else 
                  @php
                    $cart=DB::table('carts')->where('product_id',$r->id)->where('user_id',Auth::user()->id)->where('type',3)->first();  
                    $check_cart=DB::table('carts')->where('user_id',Auth::user()->id)->where('type',3)->get();   
                  @endphp
                  @if($cart==null)
                    @if(Session::get('location_name')!='notfound')
                    <a href="{{url('package-add-cart/'.$r->id)}}" class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                      <span class="icon-cart-plus"></span>
                    </a>
                    @else
			 		    <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="product-card__addtocart-icon" type="button" aria-label="Add to cart"><span class="icon-cart-plus"></span></a>
			 		@endif
                  @else
                    <a style="color:red;" class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                      <span class="icon-cart-plus"></span>
                    </a>
                  @endif  
                @endif
                 
              </div>
            </div>
          </div>
        </div>
        @endforeach 
      </div>
    </div>
  </div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>
 