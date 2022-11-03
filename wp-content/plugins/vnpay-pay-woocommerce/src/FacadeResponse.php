<?php

/**
 * 
 * @author thangnh
 * @since  1.0.2
 */

namespace vnpay\Facades;

interface FacadeResponse {

    public function getResponseDescription($responseCode);

    public function checkResponse($txnResponseCode);

    public function ipn_url_vnpay($txnResponfseCode);

    public function getOrder($orderId);
}
