@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row"> 
            @if($flag == 1)
            	@include('admin.components/admin_shipping_settings')
            @elseif($flag == 2)
            	@include('admin.components/admin_view_size')
            @elseif($flag == 3)
            	@include('admin.components/admin_add_size')
            @elseif($flag == 4)
            	@include('admin.components/admin_edit_size')
            @endif
        </div>
    </section>
@stop