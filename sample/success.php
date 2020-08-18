<?php
require "./bootstrap.php";

use ThanhVo\Worldpay\WPG\Service\Hosted as Hosted;
use ThanhVo\Worldpay\WPG\Client as WorldpayClient;

$mode = WorldpayClient::MODE_LIVE;
if (SANDBOX_MODE) {
    $mode = WorldpayClient::MODE_TEST;
}

$hosted = new Hosted(XML_USERNAME, XML_PASSWORD, $mode);

$sig = $hosted->genMacSHA(
    MAC_SECRET,
    $_GET['orderKey'],
    $_GET['paymentAmount'],
    0,
    $_GET['paymentCurrency'],
    'AUTHORISED'
);

$mac = $_GET['mac2'];

?>

<head>
    <title>Payment Success</title>
    <script src='https://payments.worldpay.com/resources/hpp/integrations/embedded/js/hpp-embedded-integration-library.js'></script>
</head>

<body>
    <div class="row">
        <div class="col-75">
            <div class="container">
                <form action="sample/index.php" method="post">
                    <?php if ($mac === $sig): ?>
                        <h3>Payment Success</h3>
                    <?php else: ?>
                        <h3>Payment Failed</h3>
                    <?php endif;?>
                </form>
            </div>
        </div>
    </div>
</body>
