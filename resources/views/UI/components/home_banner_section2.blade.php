<?php  
    $banner = DB::table('banners')->where('page_name','homepage')->where('location','middle section')->where('status',0)->get(); 
    $banner1 = DB::table('banners')->where('page_name','homepage')->where('location','middle')->where('status',0)->get(); 
?> 
<div class="container"> 
    <div class="row">
        @foreach($banner as $banners) 
        <div class="col-md-6">
            <a href="{{$banners->banner_link}}" target="_blank"> 
                <img src="{{asset($banners->image)}}" alt="" class="img-fluid"> 
            </a>
        </div>
        @endforeach  
    </div> 
    <div class="row" style=" margin-top: 2%;">
        @foreach($banner1 as $banners)
        <div class="col-md-6">
            <a href="{{$banners->banner_link}}" target="_blank"> 
                <img src="{{asset($banners->image)}}" alt="" class="img-fluid"> 
            </a>
        </div>
        @endforeach 
    </div>
</div>