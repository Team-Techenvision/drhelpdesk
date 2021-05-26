@extends('main_chat_master') 
	@section('main_content')    
	@if($flag == 1)
  		@include('UI.components/user/chat_app') 
	@elseif($flag == 2)
  		@include('UI.components/user/chat_app_mobile')  
  	@endif 
@stop 
