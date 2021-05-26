@extends('main_master') 
    @section('main_content') 
    <div class="block-space block-space--layout--after-header"></div>
        <div class="block">
            <div class="container container--max--lg" style="text-align:center">
                @if(\Session::has('success') && ($order->payment_status === 'success'))
                    <div class="alert alert-block alert-success">
                        <i class=" fa fa-check cool-green "></i>
                        {{ nl2br(\Session::get('success')) }}
                    </div>
                @else
                <h3 style="color:red">Do not refresh the page while your payment is being processed.</h3>
                <small>If you didn't see payment window press here</small>
                <form action="/payment?order_id={{$order->order_id}}" method="POST" >
                    @csrf
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{ env('RAZOR_KEY') }}"
                            data-amount="{{ round($order->amount) }}00"
                            data-currency="INR"
                            data-buttontext="Pay Now"
                            data-name="Dr HelpDesk"
                            data-description="{{ $order->order_id }}"
                            data-image="/UI/images/DHD-Logo.png"
                            data-prefill.name="{{ $order->user_name }}"
                            data-prefill.email="{{ $order->user_email }}"
                            data-theme.color="#1d99b6">
                    </script>
                </form>
               
                @endif
            </div>
        </div>
    </div>
@stop