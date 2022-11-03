<?php


$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'vnpay\\Facades\\FacadeResponse' => $baseDir . '/src/FacadeResponse.php',
    'vnpay\\Gateways\\vnpayGateway' => $baseDir . '/src/gateways/international/vnpayGateway.php',
    'vnpay\\Gateways\\vnpayInternationalResponse' => $baseDir . '/src/gateways/international/vnpayInternationalResponse.php',
    'vnpay\\Page' => $baseDir . '/src/Page.php',
    'vnpay\\Responses\\vnpayResponse' => $baseDir . '/src/vnpayResponse.php',
    'vnpay\\Shortcodes\\Thankyou' => $baseDir . '/src/shortcodes/Thankyou.php',
    'vnpay\\Traits\\Pages' => $baseDir . '/src/traits/Pages.php',
);

