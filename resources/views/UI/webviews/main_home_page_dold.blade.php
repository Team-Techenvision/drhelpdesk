@extends('main_master') 
	@section('main_content')    
	  	@include('UI.components/home_slider')   
	  	@include('UI.components/home_category')  
	  	@include('UI.components/home_sale_page') 
	  	@include('UI.components/home_popular_health_packages_page')  
 		@include('UI.components/home_banner_section')  
	  	@include('UI.components/home_doctor_section')  
	  	@include('UI.components/home_top_selling_section')   
 		@include('UI.components/home_banner_section2')  
<!-- 	  	@include('UI.components/home_covid_section')   -->
	  	@include('UI.components/home_stay_healthy_section')  
	  	@include('UI.components/home_reviews_section')  
 		@include('UI.components/home_features_section')  
	 
@stop 
