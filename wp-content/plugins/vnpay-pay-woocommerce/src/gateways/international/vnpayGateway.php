<?php
/**
 * 
 * 
 * @author thangnh
 * @since  1.0.0
 */

namespace vnpay\Gateways;

class vnpayGateway extends \WC_Payment_Gateway {

    public function __construct() {
        $this->id = 'vnpay';
        $this->icon = $this->get_option('logo');
        $this->has_fields = false;
        $this->method_title = __('vnpay', 'woocommerce');

        $this->supports = array(
            'products',
            'refunds'
        );

        // Load the settings.
        $this->init_form_fields();
        $this->init_settings();

        // Define user set variables
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->Url = $this->get_option('Url');
        $this->terminal = $this->get_option('terminal');
        $this->secretkey = $this->get_option('secretkey');
        $this->locale = $this->get_option('locale');

        if (!$this->isValidCurrency()) {
            $this->enabled = 'no';
        }

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array(&$this, 'process_admin_options'));
    }

    public function getPagesList() {
        $pagesList = array();
        $pages = get_pages();
        if (!empty($pages)) {
            foreach ($pages as $page) {
                $pagesList[$page->ID] = $page->post_title;
            }
        }
        return $pagesList;
    }

    public function init_form_fields() {

        $this->form_fields = array(
            'enabled' => array(
                'title' => __('Enable/Disable', 'woocommerce'),
                'type' => 'checkbox',
                'label' => __('Enable vnpay Paygate', 'woocommerce'),
                'default' => 'yes',
            ),
            'title' => array(
                'title' => __('Tiêu đề', 'woocommerce'),
                'type' => 'text',
                'description' => 'Tiêu đề thanh toán',
                'default' => 'Thanh toán qua VNPAY',
                'desc_tip' => true
            ),
            'description' => array(
                'title' => __('Mô tả', 'woocommerce'),
                'type' => 'textarea',
                'description' => __('Mô tả phương thức thanh toán', 'woocommerce'),
                'default' => __('Thanh toán trực tuyến qua VNPAY', 'woocommerce'),
                'desc_tip' => true
            ),
            'Url' => array(
                'title' => __('VNPAY URL', 'woocommerce'),
                'type' => 'text',
                'description' => 'Url khởi tạo giao dịch sang VNPAY(VNPAY Cung cấp)',
                'default' => '',
                'desc_tip' => true
            ),
            'terminal' => array(
                'title' => __('Terminal ID', 'woocommerce'),
                'type' => 'text',
                'description' => 'Mã terminal VNPAY cung cấp',
                'default' => '',
                'desc_tip' => true
            ),
            'secretkey' => array(
                'title' => __('Secret Key', 'woocommerce'),
                'type' => 'password',
                'description' => 'Key cấu hình VNPAY cung cấp',
                'default' => '',
                'desc_tip' => true
            ),
            'locale' => array(
                'title' => __('Locale', 'woocommerce'),
                'type' => 'select',
                'class' => 'wc-enhanced-select',
                'description' => __('Choose your locale', 'woocommerce'),
                'desc_tip' => true,
                'default' => 'vn',
                'options' => array(
                    'vn' => 'vn',
                    'en' => 'en'
                )
            ),
        );
    }

    public function process_payment($order_id) {
        $order = new \WC_Order($order_id);
        return array(
            'result' => 'success',
            'redirect' => $this->redirect($order_id)
        );
    }

    public function redirect($order_id) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order = new \WC_Order($order_id);
        $order->update_status('on-hold');
        $order->add_order_note(__('Giao dịch chờ thanh toán hoặc chưa hoàn tất', 'woocommerce'));
        
        //
        $forenamefw = $order->get_billing_first_name();
        $forename = $this->convert_vi_to_en($forenamefw);
        $surnamefw = $order->get_billing_last_name();
        $surname = $this->convert_vi_to_en($surnamefw);
        $mobile = $order->get_billing_phone();
        $emailfw = $order->get_billing_email();
        $email = $this->convert_vi_to_en($emailfw);
            
        $amount = number_format($order->order_total, 2, '.', '') * 100;
        $vnp_TxnRef = $order_id;
        $date = date('Y-m-d H:i:s');
        $vnp_Url = $this->Url;
        $vnp_Returnurl = admin_url('admin-ajax.php') . '?action=payment_response&type=international';
        $vnp_TmnCode = $this->terminal;
        $hashSecret = $this->secretkey;
        $vnp_OrderInfo = 'Ma giao dich thanh toan:'.$order_id .'-'.'Ho va ten KH:'.$surname. ' ' .$forename. '-'.'SDT:'.$mobile.'-'.'Email:'.$email;
        $vnp_OrderType = 'orther';
        $vnp_Amount = $amount;
        $vnp_Locale = $this->locale;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_Version" => "2.1.0",
        );
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($hashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $hashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    public function isValidCurrency() {
        return in_array(get_woocommerce_currency(), array('VND'));
    }
    
    function convert_vi_to_en($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);    
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    return $str;
    }
    
    public function admin_options() {
        if ($this->isValidCurrency()) {
            parent::admin_options();
        } else {
            ?>
            <div class="inline error">
                <p>
                    <strong>
            <?php _e('Gateway Disabled', 'woocommerce'); ?>
                    </strong> : 
            <?php
            _e('vnpay does not support your store currency. Currently, vnpay only supports VND currency.', 'woocommerce');
            ?>
                </p>
            </div>
                        <?php
                    }
                }

            }
            