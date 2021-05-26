 @php
    $header1 = DB::table('header_contents')->where('id',1)->first();
 @endphp

@if(Session::get('location_name')!='no_location')
  @if(Session::get('location_name')!= 'notfound')
    @if(Session::get('location_name')=='Chandigarh')
  	<div id="onloadpopup" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body">
          <div class="popuponload">
            <img src="{{asset($header1->same_day_image)}}">
          </div>
        </div>
      </div>
    </div>
  </div>

    
    @else
   
   <div id="onloadpopup" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body">
          <div class="popuponload">
            <img src="{{asset($header1->same_day_image)}}">
          </div>
        </div>
      </div>
    </div>
  </div>
    
    @endif
  @else
	<div id="onloadpopup" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body">
          <div class="popuponload">
            <img src="{{asset($header1->guranteed_image)}}">
          </div>
        </div>
      </div>
    </div>
  </div> 
  @endif
@else

@endif 

<?php 
  $medicine = DB::table('categories')->where('categories_id',14)->first();
  $lab = DB::table('categories')->where('categories_id',15)->first();
  $doctor = DB::table('categories')->where('categories_id',16)->first();
  $sexual = DB::table('categories')->where('categories_id',285)->first();
  $cosmetic = DB::table('categories')->where('categories_id',1)->first();
  $ayurveda = DB::table('categories')->where('categories_id',18)->first(); 
  $mom_baby_care = DB::table('categories')->where('categories_id',24)->first(); 
  //dd($cosmetic);
?> 
<?php
  $sub_cosmetic = DB::table('categories')->where('parent_id',$cosmetic->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
  $sub_medicine = DB::table('categories')->where('parent_id',$medicine->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
  $sub_lab = DB::table('categories')->where('parent_id',$lab->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
  $sub_doctor = DB::table('categories')->where('parent_id',$doctor->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
  $sub_sexual = DB::table('categories')->where('parent_id',$sexual->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
  $sub_ayurveda = DB::table('categories')->where('parent_id',$ayurveda->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 

  $sub_cosmetic1 = DB::table('categories')->where('parent_id',$cosmetic->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
  $sub_medicine1 = DB::table('categories')->where('parent_id',$medicine->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
  $sub_lab1 = DB::table('categories')->where('parent_id',$lab->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
  $sub_doctor1 = DB::table('categories')->where('parent_id',$doctor->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
  $sub_sexual1 = DB::table('categories')->where('parent_id',$sexual->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
  $sub_ayurveda1 = DB::table('categories')->where('parent_id',$ayurveda->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get();  
?> 
<div class="block block-products-carousel" data-layout="grid-6">
  <div class="container">

    <!-- Tost Message -->
    @if(session('msgp') != null)

                <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                  {{session('msgp')}}

                </div>

              @endif

    <div class="block-products-carousel__carousel">
      <div class="owl-carousel">

<!--         <div class="block-sale__item"> 
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="{{url('filter-category/'.$medicine->categories_id)}}"><img src="{{asset($medicine->image)}}" alt=""> </a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="{{url('filter-category/'.$medicine->categories_id)}}">Order Medicine</a>
              </div>
            </div> 
          </div>
        </div>
 -->
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="{{url('lab-tests')}}"><img src="{{asset($lab->image)}}" alt=""> </a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="{{url('lab-tests')}}">Lab Test</a>
              </div>
            </div>
            
          </div>
        </div>

        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="{{url('filter-category/'.$cosmetic->categories_id)}}"><img src="{{asset($cosmetic->image)}}" alt=""> </a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="{{url('filter-category/'.$cosmetic->categories_id)}}">Cosmetics</a>
              </div>
            </div>
            
          </div>
        </div>

        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="{{url('filter-category/'.$sexual->categories_id)}}"><img src="{{asset($sexual->image)}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="{{url('filter-category/'.$sexual->categories_id)}}">Sexual Wellness</a>
              </div>
            </div> 
          </div>
        </div>

        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="{{url('filter-category/'.$ayurveda->categories_id)}}"><img src="{{asset($ayurveda->image)}}" alt=""> </a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="{{url('filter-category/'.$ayurveda->categories_id)}}">Ayurveda</a>
              </div>
            </div>
            
          </div>
        </div> 

        <!-- <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="{{url('doctor-list/'.$doctor->categories_id)}}"><img src="{{asset($doctor->image)}}" alt=""> </a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="{{url('doctor-list/'.$doctor->categories_id)}}">Ask Doctor</a>
              </div>
            </div>
            
          </div>
        </div> -->

        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="{{url('filter-category/'.$mom_baby_care->categories_id)}}"><img src="{{asset($mom_baby_care->image)}}" alt=""> </a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="{{url('filter-category/'.$mom_baby_care->categories_id)}}">Mom & Baby Care</a>
              </div>
            </div>
            
          </div>
        </div>  
      </div>
    </div>
  </div>
</div> 

<div class="block-space block-space--layout--divider-sm"></div> 