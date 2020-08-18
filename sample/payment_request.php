<?php
require "./bootstrap.php";

use ThanhVo\Worldpay\WPG\Service\Payment\Request;
use ThanhVo\Worldpay\WPG\Service\Payment\ResultUrl;
use ThanhVo\Worldpay\WPG\Service\Hosted as Hosted;
use ThanhVo\Worldpay\WPG\Client as WorldpayClient;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mode = WorldpayClient::MODE_LIVE;
    if (SANDBOX_MODE) {
        $mode = WorldpayClient::MODE_TEST;
    }

    $hosted = new Hosted(XML_USERNAME, XML_PASSWORD, $mode);
    $orderCode = $_POST['order_code'];

    $request = new Request();
    $request->setOrderCode($orderCode)
        ->setAmount($_POST['amount'], AMOUNT_EXPONENT)
        ->setCurrencyCode($_POST['currency'])
        ->setDescription('Test')
        ->setCaptureDelay('0')
        ->setPaymentMethodMaskInclude('ALL');

    if (!empty(INSTALLATION_ID)) {
        $request->setInstallationId(INSTALLATION_ID);
    }

    $resultUrl = new ResultUrl();
    $resultUrl->setSuccessURL(BASE_URL . '/sample/success.php');

    $paymentPayUrl = $hosted->requestPayment($request, $resultUrl);
}

?>

<head>
    <title>Payment Page</title>
    <script src='https://payments.worldpay.com/resources/hpp/integrations/embedded/js/hpp-embedded-integration-library.js'></script>
</head>
<body>
    <!-- html container element -->
    <div id='custom-html'></div>

    <script type="text/javascript">
        //your options
        var customOptions = {
            iframeHelperURL: 'https://example.com/helper.html',
            url: "<?= $paymentPayUrl ?>",
            type: 'iframe',
            injectType: 'onload',
            target: 'custom-html',
            accessibility: true,
            debug: false
        };

        //initialise the library and pass options
        var libraryObject = new WPCL.Library();
        libraryObject.setup(customOptions);
    </script>
</body>
