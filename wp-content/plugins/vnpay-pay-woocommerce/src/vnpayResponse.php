<?php

/**
 * 
 * 
 * @author thangnh
 * @since  1.0.2
 */

namespace vnpay\Responses;

use vnpay\Gateways\vnpayGateway;
use vnpay\Facades\FacadeResponse;

abstract class vnpayResponse implements FacadeResponse {
    protected $hashCode;
    public function __construct() {
        $this->action();
    }

    public function action() {
        add_action('wp_ajax_payment_response', array($this, 'checkResponse'));
        add_action('wp_ajax_nopriv_payment_response', array($this, 'checkResponse'));
        add_action('wp_ajax_payment_response_vnpay', array($this, 'ipn_url_vnpay'));
        add_action('wp_ajax_nopriv_payment_response_vnpay', array($this, 'ipn_url_vnpay'));
    }

    public function checkResponse($txnResponseCode) {
        global $woocommerce;
        $woocommerce->cart->get_checkout_url();
        $order = $this->getOrder($_GET["vnp_TxnRef"]);
            $url = wc_get_checkout_url() . 'order-received/' . $order->id . '/?key=' . $order->order_key;
            wp_redirect($url);
        WC()->cart->empty_cart();
        exit();
    }

    public function ipn_url_vnpay($txnResponseCode) {
        global $woocommerce;
        $transStatus = '';
        $checkoutUrl = $woocommerce->cart->get_checkout_url();

        $order = $this->getOrder($_GET["vnp_TxnRef"]);
        $gateway = new vnpayGateway;
        $hashSecret = $gateway->get_option('secretkey');

        //  ($hashSecret);
        $params = array();
        $returnData = array();
        $data = $_GET;

        foreach ($data as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $params[$key] = $value;
            }
        }
        $vnp_SecureHash = $params['vnp_SecureHash'];
        unset($params['vnp_SecureHashType']);
        unset($params['action']);
        unset($params['type']);
        unset($params['vnp_SecureHash']);
        ksort($params);
        $i = 0;
        $hashData = "";
        foreach ($params as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key). "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $hashSecret);
//Check Orderid 
        if ($order->post_status != \NULL && $order->post_status != '') {
            //Check chữ ký
            if ($secureHash == $vnp_SecureHash) {
                //Check Status của đơn hàng
                if ($order->post_status != \NULL && $order->post_status == 'wc-on-hold'){
                    if ($params['vnp_ResponseCode'] == '00') {
                        $returnData['RspCode'] = '00';
                        $returnData['Message'] = 'Confirm Success';
                        $returnData['Signature'] = $secureHash;
                        $transStatus = $this->getResponseDescription($txnResponseCode);
                        $order->update_status('processing');
                        $order->add_order_note(__($transStatus, 'woocommerce'));
                        WC()->cart->empty_cart();
                    }
                    elseif ($params['vnp_ResponseCode'] == '24') {
                     $returnData['RspCode'] = '00';
                     $returnData['Message'] = 'Confirm Success';
                     $returnData['Signature'] = $secureHash;
                     $order->update_status('cancelled');
                     $order->add_order_note(__('Khách hàng hủy giao dịch', 'woocommerce'));
                     WC()->cart->empty_cart();
                    }
                    else
                    {
                    $returnData['RspCode'] = '00';
                    $returnData['Message'] = 'Confirm Success';
                    $returnData['Signature'] = $secureHash;
                    $transStatus = $this->getResponseDescription($txnResponseCode);
                    $order->add_order_note(__($transStatus, 'woocommerce'));
                    $order->update_status('failed');
                    WC()->cart->empty_cart();
                    }
                } else {
                    $returnData['RspCode'] = '02';
                    $returnData['Message'] = 'Order already confirmed';
                   WC()->cart->empty_cart();
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Chu ky khong hop le';
                $returnData['Signature'] = $secureHash;
                WC()->cart->empty_cart();
            }
        } else {
            $returnData['RspCode'] = '01';
            $returnData['Message'] = 'Order not found';
            WC()->cart->empty_cart();
        }
        echo json_encode($returnData);
        exit();
    }

    abstract public function thankyou();

    abstract public function getResponseDescription($responseCode);

    public function getOrder($orderId) {
        preg_match_all('!\d+!', $orderId, $matches);
        $order = new \WC_Order($matches[0][0]);
        return $order;
    }

}
