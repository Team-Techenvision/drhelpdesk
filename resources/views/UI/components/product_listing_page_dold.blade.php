<div class="block-header block-header--has-breadcrumb block-header--has-title"> 
  <div class="container">
    @if(session('message1') != null)
    <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{session('message1')}}
    </div>
    @endif 
    <div class="block-header__body">
      <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb__list">
          <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
          <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a> 
          </li>
         <?php  
         
          $category_name = DB::table('categories')->where('slug',$data['r']->slug)->first();  
          if(!empty($category_name)){
          ?>
          <li class="breadcrumb__item breadcrumb__item--parent"><a href="{{url('category/'.$category_name->slug)}}" class="breadcrumb__item-link">{{$category_name->category_name}}</a>
          </li>
         
        <?php 
        
          $sub_cat = $data['parameter']['1'] ? DB::table('categories')->where('slug',$data['parameter']['1'])->first() : 0; 
          if(!empty($sub_cat)){ ?>
        
        <li class="breadcrumb__item breadcrumb__item--parent"><a href="{{url('category/'.$category_name->slug.'/'.$sub_cat->slug)}}" class="breadcrumb__item-link">{{$sub_cat->sub_category_name}}</a>
          </li>
        
        <?php 
          $sub_sub_cat = $data['parameter']['2'] ? DB::table('categories')->where('slug',$data['parameter']['2'])->first() : 0;  
          if(!empty($sub_sub_cat)){ ?>
        	<li class="breadcrumb__item breadcrumb__item--parent"><a href="{{url('category/'.$category_name->slug.'/'.$sub_cat->slug.'/'.$sub_sub_cat->slug)}}" class="breadcrumb__item-link">{{$sub_sub_cat->sub_category_name}}</a>
          </li>
        <?php 
          $sub_sub_sub_cat = $data['parameter']['3'] ? DB::table('categories')->where('slug',$data['parameter']['3'])->first() : 0;  
          if(!empty($sub_sub_sub_cat)){ ?>
        	<li class="breadcrumb__item breadcrumb__item--parent"><a href="{{url('category/'.$category_name->slug.'/'.$sub_cat->slug.'/'.$sub_sub_cat->slug.'/'.$sub_sub_sub_cat->slug)}}" class="breadcrumb__item-link">{{$sub_sub_sub_cat->sub_category_name}}</a>
          </li>
        
        <?php
          }
          }
          }
          }
        ?>
          
          <li class="breadcrumb__title-safe-area" role="presentation"></li>

        </ol>

      </nav>

    
    </div>

  </div>

</div> 

 

  <div class="block-split block-split--has-sidebar">

    <div class="container">

      <div class="block-split__row">
        <div class="row"> 
          <div class="col-12 col-md-3"> 
            <div class="sidebar">

              <div class="sidebar__backdrop"></div>

              <div class="sidebar__body"> 

                <div class="sidebar__content"> 
                <?php  
          $category_name = DB::table('categories')->where('categories_id',$data['r']->categories_id)->first(); ?>
                  @if($category_name->categories_id == 14 && Auth::check())
                 <div class="pres">
							   <h3>Can't Find Your Medicine?? </h3>
							   <form action="{{url('/upload-new-prescription')}}"  method="post"  enctype="multipart/form-data" >
								  <div class="form-group">
									<label ><br>1) Upload Your Prescription </label>
									<input type="file" name="prescription_image" class="form-control" id="prescription" >
								  </div>
								  <div class="form-group">
								  OR
								  </div>
								  <div class="form-group">
									<label>2) Simply, Write Your Medicine </label>
									<textarea class="form-control" rows="2" id="comment" name="comment"></textarea>
								  </div>
								 
								  <button type="submit" class="btn btn-primary">Submit</button><br>
								  <small>Submit & We'll Do The Rest</small>
								</form>
              </div>
              @endif

<form action="{{route('cat',[$data['parameter'][0],$data['parameter'][1],$data['parameter'][2],$data['parameter'][3]] )}}" method="post">

  @csrf
                  <div class="widget widget-filters widget-filters--offcanvas--mobile" data-collapse data-collapse-opened-class="filter--opened"> 

                    <div class="widget-filters__list">

                      <div class="widget-filters__item">

                        <div class="filter filter--openedd" data-collapse-item>

                          <button type="button" class="filter__title collapse-init" data-collapse-trigger>Categories<span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

                          </button>

                          <div class="filter__body" data-collapse-content>

                            <div class="filter__container">

                              <div class="filter-categories">

                                <ul> 

                                  @php 

                                  $sub_category = DB::table('categories')->where('parent_id',$data['r']->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->orderBy('sub_category_name','asc')->where('status',0)->get(); 

                                  @endphp

                                  @foreach($sub_category as $r1)

                                  @php 

                                  $sub_sub_category = DB::table('categories')->where('sub_parent_id',$r1->categories_id)->where('sub_sub_parent_id',null)->where('status',0)->get(); 

                                  @endphp

                                  <li class="">

                                    <a style="cursor: pointer">
                                    {{$r1->sub_category_name}}</a>
                                    <span></span>
                                    <ul>  

                                      @foreach($sub_sub_category as $r2)

                                      @php 

                                      $sub_sub_sub_category = DB::table('categories')->where('sub_sub_parent_id',$r2->categories_id)->where('status',0)->get(); 

                                      @endphp

                                      <li class="">

                                        <a style="cursor: pointer">{{$r2->sub_category_name}}</a>
                                        <span></span>

                                        <ul> 

                                          @foreach($sub_sub_sub_category as $r3) 

                                          <li><a href="{{url('filter-category/'.$data['r']->categories_id.'/'.$r1-> categories_id.'/'.$r2-> categories_id.'/'.$r3->categories_id)}}">{{$r3->sub_category_name}}</a>

                                          </li> 

                                          @endforeach  

                                        </ul>

                                      </li>  

                                      @endforeach 

                                    </ul>

                                  </li>  

                                  @endforeach  

                                </ul>  

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>  

                      <div class="widget-filters__item">

                        <div class="filter filter--openedd" data-collapse-item>

                          <button type="button" class="filter__title collapse-init" data-collapse-trigger>Price <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

                          </button>

                          <div class="filter__body" data-collapse-content>

                            <div class="filter__container">

                              <div class="filter-price" data-min="0" data-max="{{$data['maxValue']}}" data-from="{{$minpr}}" data-to="@if($maxpr != null) {{$maxpr}} @else {{$data['maxValue']}} @endif">

                                <div class="filter-price__slider"></div>

                                <div class="filter-price__title-button">

                                  <div class="filter-price__title"> <i class="fas fa-rupee-sign"></i><span class="filter-price__min-value"></span> – <i class="fas fa-rupee-sign"></i><span class="filter-price__max-value"></span>

                                  </div> 

                                  <input type="hidden" name="minpr" id="minpr" />

                                  <input type="hidden" name="maxpr" id="maxpr" />



                                </div>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                      @php  
                      
                      $brand1 = DB::table('brand_categories') 
                      ->where('category_id',$data['r']->categories_id)          
                      ->get();  
                   
                      @endphp

                      <div class="widget-filters__item">

                        <div class="filter filter--openedd" data-collapse-item>

                          <button type="button" class="filter__title collapse-init" data-collapse-trigger>Brand <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

                          </button>

                          <div class="filter__body" data-collapse-content>

                            <div class="filter__container">

                              <div class="filter-list">

                                <div class="filter-list__list"> 

                                  @foreach($brand1 as $r1) 

                                  @php 
                                  $brand2 = DB::table('brands')                                  
                                  ->where('id',$r1->brand_id)                                 
                                  ->where('status',0)   
                                  ->orderBy('brand_name', 'asc')                                                              
                                  ->first();
                                     

                                  @endphp 
                                  @if(!empty($brand2))
                                  <label class="filter-list__item"><span class="input-check filter-list__input"><span class="input-check__body"><input class="input-check__input" type="checkbox" name="brand[]" value="{{$brand2->id}}" {{in_array($brand2->id,$brand)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

                                  </span><span class="filter-list__title">

                                    {{ucfirst($brand2->brand_name)}} 

                                  </span> 

                                </label> 
                                @endif
                                @endforeach 

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

        <button class="btn btn-secondary btn-sm">Reset</button>

      </div>

    </div> 

  </div>

</div>

</div>

</div> 
<div class="col-md-9 col-12">

  <div class="block">

    <div class="products-view">

      <div class="products-view__options view-options view-options--offcanvas--mobile">

        <div class="view-options__body">

          <button type="button" class="view-options__filters-button filters-button"><span class="filters-button__icon"><i class="fas fa-sort-amount-down"></i></span><span class="filters-button__title">Filters</span> 

          </button>



          @php

          $count = DB::table('products')->count();

          @endphp 
          <div class="view-options__legend"></div>

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

      <p style="color:grey; font-size:22px;">Showing {{($data['product']->currentpage()-1)*$data['product']->perpage()+1}} – {{$data['product']->currentpage()*$data['product']->perpage()}} of {{$data['product']->total()}}</p>
        <div class="products-list__content">
          @if($data['product']->count() > 0)
          @foreach($data['product'] as $r)

          @php 

          $category = DB::table('product_images')->where('type',2)->where('products_id' , $r->products_id)->pluck('product_image')->first();  
          if(!empty($r->special_price)){
          $percent = (($r->price - $r->special_price)*100) /$r->price ;
        }else{ $percent = null; }
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
                @else
                <img src="{{asset('UI/images/product_default1.png')}}" alt="">
                @endif
              </a>



            </div>

            <div class="product-card__info"> 

              <div class="product-card__name">

                <div>

                  <div class="product-card__badges"> 
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
                <?php
                $rev = DB::table('reviews')->where('status',0)->where('product_id' , $r->products_id)->get(); 
                $revCount = $rev->count();
                if($revCount > 0){
                $ee = 0;
                foreach($rev as $re){
                $ee = $ee+$re->rating;
              }
              $avg = round($ee/$revCount,2);
            }?> 
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

          @if($r->in_stock != 0)


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

      @else
<p class="text-danger mt-3"> Out of Stock </p>
@endif 

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
  <div class="products-view__pagination-legend"> </div>

</div>
@endif
@else
<center><p style="font-size:25px; color:#1d99b6;">No product found</p></center>
@endif
</div>

</div>

</div>

</div>

<div class="block-space block-space--layout--before-footer"></div>

</div>

</div>
</div>
</form> 

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