<head>
    <title>Payment Request</title>
    <script src='https://payments.worldpay.com/resources/hpp/integrations/embedded/js/hpp-embedded-integration-library.js'></script>
</head>

<body>
    <div class="row">
    <div class="col-75">
        <div class="container">
            <form action="payment_request.php" method="post">
                <h3>Payment request</h3>
                <label for="order-code">Order Code</label>
                <input type="text" id="order-code" name="order_code" placeholder="Order Code">
                <label for="amount">Amount</label>
                <input type="text" id="amount" name="amount" placeholder="Amount" value="10">
                <label for="currency">Currency</label>
                <input type="text" id="currency" name="currency" placeholder="Currency" value="HKD">
                <input type="submit" value="Continue to checkout" class="btn">
            </form>
        </div>
    </div>
</div>
</body>
