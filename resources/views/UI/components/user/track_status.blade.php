@extends('main_master') 
@section('main_content') 
  <div class="block-space block-space--layout--after-header"></div>
    <div class="block">  
       	<?php 
        $dt = new DateTime($pickup_date);
        $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

        $dt->setTimezone($tz);
        $start_date1 = $dt->format("d-m-Y H:i:s"); 
        ?>
      Pick Up Date : -{{$start_date1}}
      <table class="table table-bordered">
        <tr>

          <th>Date</th>
          <th>Status</th>
          <th>Activity</th>
          <th>Location</th> 
        </tr>
      	
        @foreach($shipment_track_activities as $r1)
        <?php 
        $dt = new DateTime($r1['date']);
        $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

        $dt->setTimezone($tz);
        $start_date = $dt->format("d-m-Y H:i:s"); 
        ?>
        <tr> 
          <td>{{$start_date}}</td>
          <td>{{$r1['status']}}</td>
          <td>{{$r1['activity']}}</td>
          <td>{{$r1['location']}}</td> 
        </tr>
        @endforeach 
      </table> 
      Current Status : -{{$current_status}}
    </div>
  <div class="block-space block-space--layout--before-footer"></div>
@stop 