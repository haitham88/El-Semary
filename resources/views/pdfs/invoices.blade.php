<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        #content{
            color: darkblue
        }
    </style>
</head>
<body style="border: 2px solid black; width: fit-content; height: fit-content">
<div>
    <div class="text-center">
        <h1>El Semary Furniture</h1>
        <p>since 1928</p>
    </div>

    <div class="container" >
        <br>
        <h4>Serial number: <span id="content">{{$invoice->serial_number}}</span></h4>
        <h4>Name: <span id="content" >{{$invoice->customer_name}}</span></h4>
        <h4>Date: <span id="content" >{{$invoice->date}}</span></h4>
        <h4>Amount: <span id="content" >{{$invoice->amount}}</span></h4>
        <h4>Payment Method: <span id="content" >{{$invoice->payment_method}}</span></h4>
        <h4>Currency: <span id="content" >{{$invoice->currency}}</span></h4>
        <h4>Branch: <span id="content" >{{$invoice->branch->name}}</span></h4>
        <h4>Order Serial Number: <span id="content" >{{$invoice->order->serial_number}}</span></h4>
        <h4>Remaining: <span id="content" >{{$invoice->remaining}}</span></h4>

    </div>

</div>

</body>
</html>
