<?php  
$banner = DB::table('banners')->where('page_name','homepage')->where('location','top middle section')->where('status',0)->get(); //dd($banner);
?> 
<div class="container"> 
 
  <div class="row">
    @foreach($banner as $banners) 
    <div class="col-md-6">
      <a href="{{$banners->banner_link}}"><img src="{{asset($banners->image)}}" alt="" class="img-fluid"></a>
    </div>
    @endforeach 
  </div> 
</div>