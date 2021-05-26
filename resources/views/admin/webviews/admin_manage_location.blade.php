@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            @if($flag == 1)
            	@include('admin.components/admin_add_location')
            @elseif($flag == 2)
            	@include('admin.components/admin_view_location')
            @elseif($flag == 3)
            	@include('admin.components/admin_edit_location')
        	@elseif($flag == 4)
            	@include('admin.components/admin_view_lab_locations')
        	@elseif($flag == 5)
            	@include('admin.components/admin_add_lab_location')
        	@elseif($flag == 6)
            	@include('admin.components/admin_edit_lab_location')
            @endif
        </div>
    </section>
@stop