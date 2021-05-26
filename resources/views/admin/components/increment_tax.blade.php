@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            <div class="col-md-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                            <h3 class="box-title">{{$page_title}}</h3>
                        <div class="any_message">      	
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <style>
                        .ui-datepicker-calendar 
                        {
                            display: none;
                        }
                        </style>
                        <!-- ==================================================== -->
                        <!-- @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif -->
                        <!-- ==================================================== -->
                        <div style="width:100%;">
                         <form style="text-align:center;" action="{{url('month-increment_tax')}}" method="post">
                         @csrf
                         <!-- <input type="month" id="start" name="start" style="padding: 1px;font-size: 16px;"> -->
                         
                        <!-- <input type="text" class="form-control " name="datepicker" id="datepicker" style="padding: 1px;font-size: 16px;" />                          -->
                         {{-- <input name="datepicker" id="startDate" class="date-picker" style="padding: 2px;font-size: 16px;" readonly /> --}}
                         {{-- <input type="submit" name="submit" value="Search" class="btn btn-info"> --}}
                          
                         </form>
                         </div>
                        <table id="table_id" class="display">
                            <thead>
                                <tr class="text-center">
                                    <th>Product with Number of Pieces</th>
                                    <th>OUT Ward GST  Manufacturer Paid</th>
                                    <th>Inward GST Collected from Customer</th>
                                    <th>IT</th>
                                    <th>TAX %</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $m_gst_price = 0; $s_gst_price=0; $d_gst_price=0; ?>
                           {{-- < ?php dd($increment_tax); ?> --}}
                            @foreach($increment_tax as $row)
                            <?php $m_gst = 0;$store_gst=0; ?>
                                <tr>
                                    <td>{{$row->product_name }} {{$row->size_name}} @if($row->Sell_QTY)({{$row->Sell_QTY}})@else(00)@endif</td>
                                    <?php $m_gst = ($row->M_price - ($row->M_price / ((100 + $row->GST)/100))) * $row->Sell_QTY;
                                        $m_gst_price = $m_gst_price + round($m_gst,2);
                                    ?>
                                    <td><?php echo round($m_gst,2);?> ({{$row->M_price}})</td>
                                    <?php $store_gst = ($row->Sell_Price - ($row->Sell_Price/((100 + $row->GST)/100))) * $row->Sell_QTY ;
                                         $s_gst_price = $s_gst_price + round($store_gst,2);
                                        

                                    ?>
                                    <td><?php echo round($store_gst,2); ?> ({{$row->Sell_Price}})</td>
                                    <?php $d_gst_price = $d_gst_price + round($store_gst - $m_gst,2);?>
                                    <td><?php echo round($store_gst - $m_gst,2);?></td>
                                    <td>{{$row->GST}}</td>
                                   {{-- < ?php dd($row->GST);?> --}}
                                </tr>
                                
                            @endforeach                             
                               
                            </tbody>
                        </table>

                        <table class="table table-striped">
                        <tr class="w-100">
                            <th class="col-sm-3"></td>
                            <th class="col-sm-3">GST  Manufacturer Paid</th>
                            <th class="col-sm-3">GST Collected from Customer</th>
                            <th class="col-sm-3">IT</th>
                            
                            </tr>
                        <tr class="w-100">
                            <td class="col-sm-3">Total</td>
                            <td class="col-sm-3"><?php echo $m_gst_price;  ?></td>
                            <td class="col-sm-3"><?php echo $s_gst_price; ?></td>
                            <td class="col-sm-3"><?php echo $d_gst_price; ?></td>                         
                            </tr>
                        </table>
                                                  	
                        </div> 
                    </div>    
                </div>             
            </div>
        </div>
    </section>
@stop
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
    $('#table_id').DataTable();    
    // $('.date-picker').datepicker({
    //     changeMonth: true,
    //     changeYear: true,
    //     showButtonPanel: true,
    //     dateFormat: 'MM yy',
    //     onClose: function(dateText, inst) { 
    //         $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    //     }
    // });
    $("#startDate").datepicker( {
   format: "mm-yyyy",
   startView: "months",
   minViewMode: "months",
   maxDate: "maxDate"
});

} );
</script>