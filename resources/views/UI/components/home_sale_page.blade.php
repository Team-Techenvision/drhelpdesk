<div class="block block-sale " data-layout="grid-5">
  <div class="block-sale__content">
    <div class="block-sale__header">
      <div class="block-sale__title">Save More!!! Care More!!!</div>
      <div class="block-sale__controls">
        <div class="arrow block-sale__arrow block-sale__arrow--prev arrow--prev"><button class="arrow__button" type="button">
          <i class="fas fa-angle-left"></i>
        </button>
      </div>
      <div class="arrow block-sale__arrow block-sale__arrow--next arrow--next"><button class="arrow__button" type="button">
        <i class="fas fa-angle-right"></i>
      </button>
    </div>
  </div>
</div>
<?php 
  $brand = DB::table('brands')->where('status',0)->where('show_brand',1)->get(); 
?>  

<div class="block-sale__body">            
  <div class="container">
    <div class="block-sale__carousel">
      <div class="owl-carousel">
        @foreach($brand as $r)
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="{{url('product-by-brand/'.$r->id)}}"><img src="{{asset($r->image)}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="{{url('product-by-brand/'.$r->id)}}">{{$r->brand_name}}</a>
              </div> 
            </div> 
          </div>
        </div>  
        @endforeach 
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>