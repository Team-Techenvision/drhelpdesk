<table>
  <thead>
  <tr>
      <th>Order Id</th>
      <th>User Id</th>
      <th>Address</th>
      <th>City</th>
      <th>Pincode</th>
      <th>Amount</th>
      <th>Order Status</th>
  </tr>
  </thead>
  <tbody>
  @foreach($orderData as $order)
      <tr>
          <td>{{ $order->order_id }}</td>
          <td>{{ $order->name }}</td>
          <td>{{ $order->user_address }}</td>          
          <td>{{ $order->user_city }}</td>
          <td>{{ $order->pin_code }}</td>
          <td>{{ $order->amount }}</td>
          <td>{{ $order->order_status }}</td>
      </tr>
  @endforeach
  </tbody>
</table>