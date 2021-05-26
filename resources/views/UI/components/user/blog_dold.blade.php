<!-- <style>
   
/*Classes added*/
 .sp{margin: 25px 0px 7px 0px;}
 .title-wrap{
    margin-top: 0px;
}
.title-sub {
    font-size: 15px;
    line-height: 18px;
    color: #999a9b;
    letter-spacing: 1.5px;
}
.h1-style {
    font-size: 60px;
    line-height: 50px;
    font-weight: bold;
    margin-bottom: 0;
}
.title-wrap h2 + .title-decor {
    margin-top: 24px;
}
.title-wrap h2 + .title-decor2 {
    margin-top: 24px;
}
.title-decor {
    height: 3px;
    width: 54px;
    background-color: #1d99b5;
}
.title-decor2 {
    height: 3px;
    width: 54px;
    background-color: #1d99b5;
   margin: 0 auto;
}
.txtp{
   text-align:justify;
   margin-top:2%
   
}
.f-img{    border-radius: 100%;
    width: 180px;
    height: 180px;
   border:1px solid #ccc}
.txt-f{
   text-align:center;
   margin-top:2%;
}
.ph{    color: #1d99b5;
font-size:20px;
}  
.sec{margin-top: 0px;}
hr {
    margin-top: 2rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);

}
.rb{    border-right: 1px solid #ccc;}
.why{background: #b7aeae40;
    border: 1px solid #ccc;
    padding: 23px 20px;
    box-shadow: 1px 10px 10px 1px #ccc;
   }
.showmore-button {
  cursor: pointer; 
  background-color: #999; 
  color: white; 
  text-transform: uppercase; 
  text-align: center; 
  padding: 7px 5px 5px 5px; 
  margin-top: 5px;
}
</style> -->
<div class="site__body">
  <section class="b-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3 class="b-blog-txt">Blog</h3>
        </div>
      </div>
    </div>
  </section>
  <div class="sp">
    <div class="container">
      
      <div class="row">
      	@foreach($blog as $blogdata)
      	 <div class="col-md-4">
          <div class="card">
            <a href="{{url('/blog-detail/'.$blogdata->blogs_id)}}"> <div class="image"> <img src="{{asset($blogdata->blog_image)}}" class="img-fluid" alt="women" /> </div></a>
            <div class="card-body">
               <a href="{{url('/blog-detail/'.$blogdata->blogs_id)}}"><h3 class="card-title">{{$blogdata->blog_title}}</h3></a>
              <p class="card-text" style="text-align:justify;">{!! substr(strip_tags($blogdata->blog_description), 0, 200) !!}...</p><a href="{{url('/blog-detail/'.$blogdata->blogs_id)}}" class="btn btn-primary teammate__btn card-btn">{{ strlen(strip_tags($blogdata->blog_description)) > 200 ? "ReadMore" : "" }}</a> 
               
            </div>
          </div> 
        </div>
      	 @endforeach
      </div>
   		  <nav aria-label="Page navigation example"> 
            <ul class="pagination">  
               {{ $blog->appends($page)->links() }} 
            </ul> 
          </nav> 
   </div>			  
 </div>
      
      
      
      
      
 