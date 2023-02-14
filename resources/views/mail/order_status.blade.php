<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
    <style> 
        table td, table th {
            padding: 8px;
            text-align: center;
        }
        table th{
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <p>Hi {{$user_name}} </p>
    <p> Your order has been {{ $status }} </p>
    <p> Order code: {{ $order->order_code }}</p>
    <p> Your shipping detials {{ $status }} </p>
    <p>  {{ $order->shipping->name }} </p>
    <p>  {{ $order->shipping->address }} </p>
    <p>  {{ $order->shipping->phone }} </p>
    <p>  {{ $order->shipping->email }} </p>
    <p>  {{ $order->shipping->district }} </p>


    <table style="width: 600px; text-align:right">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_details as $item)
                <tr>
                    <td><img src="{{asset($item->product->image_url)}}" width="100" /></td>
                    <td>{{$item->product->product_title}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->single_price * $item->quantity}} TK</td>
                </tr>
            @endforeach
            @if($order->discunt)
            <tr>
                <td colspan="3" style="border-top:1px solid #ccc;paddding:5px 10px"></td>
                <td style="font-size:15px;font-weight:bold;border-top:1px solid #ccc; paddding:5px 10px">Discount : {{ $order->discount }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="3" style="border-top:1px solid #ccc; paddding:5px 10px"></td>
                <td style="font-size:15px;font-weight:bold;border-top:1px solid #ccc; text-transfrom:capitalize; paddding:5px 10px"> Delivery cost  : {{ $order->delivery_cost }} TK</td>
            </tr>
            <tr>
                <td colspan="3" style="border-top:1px solid #ccc; paddding:5px 10px"></td>
                <td style="font-size:15px;font-weight:bold;border-top:1px solid #ccc; paddding:5px 10px">Subtotal : {{ $order->subtotal }} TK </td>
            </tr>    
        </tbody>
    </table>    
</body>
</html>