 @extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            @if($flag == 1)
            	@include('admin.components/admin_add_product')
            @elseif($flag == 2)
            	@include('admin.components/admin_view_product')
            @elseif($flag == 3)
            	@include('admin.components/admin_edit_product')
            @elseif($flag == 4)
            	@include('admin.components/admin_view_review_product')
            @elseif($flag == 5)
            	@include('admin.components/admin_view_product_attr')
            @elseif($flag == 6)
            	@include('admin.components/admin_add_product_attr')
            @elseif($flag == 7)
            	@include('admin.components/admin_edit_product_attr')
            @endif
        </div>
    </section>
@stop