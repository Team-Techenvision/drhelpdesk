@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            @if($flag == 1) 
            	@include('admin.components/admin_view_user_data') 
        	@elseif($flag == 2) 
            	@include('admin.components/admin_view_contact_us_form_details') 
        	@elseif($flag == 3) 
            	@include('admin.components/admin_view_news_letter_details') 
            @endif
        </div>
    </section>
@stop