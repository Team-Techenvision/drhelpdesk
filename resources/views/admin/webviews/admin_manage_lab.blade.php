@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            @if($flag == 1)
            	@include('admin.components/admin_add_lab')
            @elseif($flag == 2)
            	@include('admin.components/admin_view_lab')
            @elseif($flag == 3)
            	@include('admin.components/admin_edit_lab')
            @endif
        </div>
    </section>
@stop