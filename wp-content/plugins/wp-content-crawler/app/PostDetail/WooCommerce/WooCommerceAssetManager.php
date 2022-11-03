<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 02/12/2018
 * Time: 12:57
 *
 * @since 1.8.0
 */

namespace WPCCrawler\PostDetail\WooCommerce;


use WPCCrawler\Objects\AssetManager\BaseAssetManager;

/**
 * Class WooCommerceAssetManager
 *
 * @package WPCCrawler\objects\crawling\postDetail\customPost\wooCommerce
 * @since   1.8.0
 */
class WooCommerceAssetManager extends BaseAssetManager {

    private $styleSiteTester = 'wpcc_wc_site_tester_css';

    /**
     * Add site tester assets.
     * @since 1.8.0
     */
    public function addTester() {
        $this->addStyle($this->styleSiteTester, $this->stylePath('post-detail/woocommerce/wc-site-tester.css'), false);
    }
}