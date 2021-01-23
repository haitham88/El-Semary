<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>El Semary Furniture</h1>
    <p>since 1928</p>
</div>

<div class="container">

            <h4>Serial number: <span style="color: darkred">{{$invoice->serial_number}}</span></h4>
            <h4>Name: <span style="color: darkblue">{{$invoice->customer_name}}</span></h4>
            <h4>Date: <span style="color: darkblue">{{$invoice->date}}</span></h4>
            @if($invoice->down_payment)
            <h4>Down Payment: <span style="color: darkblue">{{$invoice->down_payment}}</span></h4>
            @endif
            <h4>Amount: <span style="color: darkblue">{{$invoice->amount}}</span></h4>
            <h4>Payment Method: <span style="color: darkblue">{{$invoice->payment_method}}</span></h4>

</div>

</body>
</html>
