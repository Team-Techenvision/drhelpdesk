@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            @if($flag == 1)
            	@include('admin.components/admin_add_coupon')
            @elseif($flag == 2)
            	@include('admin.components/admin_view_coupon')
            @elseif($flag == 3)
            	@include('admin.components/admin_edit_coupon')
        	@elseif($flag == 4)
        		<h3>Only Admin Can Manage Copoun System </h3>
            @endif
        </div>
    </section>
@stop