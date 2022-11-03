<?php


$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'vnpay\\Traits\\' => array($baseDir . '/src/traits'),
    'vnpay\\Shortcodes\\' => array($baseDir . '/src/shortcodes'),
    'vnpay\\Gateways\\' => array($baseDir . '/src/gateways'),
    'vnpay\\' => array($baseDir . '/src'),
);
