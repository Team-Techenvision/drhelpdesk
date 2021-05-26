@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            @if($flag == 1)
            	@include('admin.components/admin_view_order')
            @elseif($flag == 2)
            	@include('admin.components/admin_view_order_detail') 
            @elseif($flag == 3)
            	@include('admin.components/admin_view_order_tester') 
            @elseif($flag == 4)
                @include('admin.components/admin_view_order_detail_tester')
            @elseif($flag == 5)
                @include('admin.components/admin_view_order_karnal')
            @elseif($flag == 6)
            	@include('admin.components/admin_view_invoice_details') 
            @endif
        </div>
    </section>
@stop