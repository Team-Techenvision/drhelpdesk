<div class="block-space block-space--layout--divider-sm"></div>
<div class="container">
   <div class="row">
	   <div class="col-md-12">
	   		<div class="block block-products-carousel" data-layout="grid-5">
				<div class="container">
					<div class="section-header">
						<div class="section-header__body">
							<h2 class="section-header__title">Our Top Brand</h2>
							<div class="section-header__spring"></div> 
						</div>
					</div>
					 
					<div class="row">
						@foreach($brands as $r) 
						<div class="col-md-3">
							<div class="product-card__image brands"> 
								@if(file_exists(public_path($r->image)))
					                <img src="{{asset($r->image)}}"> 
					            @elseif($r->image == null)
					                <img src="{{asset('UI/images/Gallery.png')}}">
					            @else 
					                <img src="{{asset('UI/images/Gallery.png')}}">
					            @endif   
							</div>
							<div class="alltest-heading" style="text-align:center;">{{ucfirst($r->brand_name)}}</a></div>
						</div>
						@endforeach  
					</div>
					<div class="products-view__pagination"> 
						<nav aria-label="Page navigation example"> 
							<ul class="pagination">  
								 {{ $brands->appends($page)->links() }} 
							</ul> 
						</nav> 
					</div> 
				</div>
			</div>
	   </div>
   </div>
    
</div>
<div class="block-space block-space--layout--divider-sm"></div> 