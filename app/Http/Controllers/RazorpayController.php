<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Razorpay;
use Razorpay\Api\Api;
use App\Order;
use App\DeTransaction;

class RazorpayController extends Controller
{
    public function payment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {

                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                if ($response) {
                    //Update order
                    $order = Order::where('order_id', $input['order_id'])
                        ->update([
                            'payment_status'        => 'success',
                            'payment_id'    => $input['razorpay_payment_id'],
                            'payment_mode'  => 'Online'
                        ]);

                    //Update if refer exists for any products that belongs to order
                    $product_ids = OrderItem::where('order_id', $input['order_id'])->pluck('prod_id')->toArray();
                    foreach ($product_ids as $product_id) {
                        if (Session::get('refer_code_' . $product_id)) {

                            //TODO::Check referer and add there Dcoin(2% on current amount) or next delivery 2% discount.

                            $refer = DeTransaction::where('code', Session::get('refer_code_' . $product_id))
                                ->update(['status', 'success']);
                        }
                    }
                }
            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        return redirect()->back()->with('success', 'Payment successful');
    }
    public function confirm($order_id)
    {
        $order = Order::where('order_id', $order_id)->first();
        return view('razorpay', [
            'order' => $order
        ]);
        //dd($order);
    }

    /**
     * Create Order on RazorPay serer
     * 
     * ENDPOINT = /api/order/create
     * @param String $amount Total amount for current oreder
     * @param UserId $user_id Current User ID
     * 
     * @return Response [
     *      'status' => 201 | 200 // 201 for success with order_data {razor pay order response}, 
     *                               200 for sucess with error
     *      'order_data' => razor_pay_order_object  || ref = https://razorpay.com/docs/payment-gateway/android-integration/standard/#step-3-create-an-order-in-your-server 
     * ]
     */
    public function createOrder(Request $request)
    {
        try {
            $client = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
            $order_receipt = 'order_rcptid_'. time();
            $order  = $client->order->create([
                'receipt'         => $order_receipt,
                'amount'          => $request->amount, // amount in the smallest currency unit
                'currency'        => 'INR', // <a href="/docs/payment-gateway/payments/international-payments/#supported-currencies" target="_blank">See the list of supported currencies</a>.)
            ]);
            return response()->json([
                'status' => 'success',
                'order_id' => $order->id,
                'order_receipt' => $order->receipt
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error_data' => $e
            ], 200);
        }
    }

}
