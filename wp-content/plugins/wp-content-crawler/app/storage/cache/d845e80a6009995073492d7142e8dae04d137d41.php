<table class="wcc-settings">

    
    <?php echo $__env->make('form-items.combined.multiple-selector-with-attribute', [
        'name'          => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_SKU_SELECTORS,
        'title'         => _wpcc('SKU Selectors'),
        'info'          => _wpcc('CSS selectors for SKU.') . ' ' . _wpcc_trans_multiple_selectors_first_match(),
        'optionsBox'    => true,
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->make('form-items.combined.checkbox-with-label', [
        'name'          => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_MANAGE_STOCK,
        'title'         => _wpcc('Manage stock?'),
        'info'          => _wpcc('Select if you want to manage stock or not.'),
        'id'            => 'wc-manage-stock',
        'dependants'    => '["#wc-stock-quantity-selectors", "#wc-backorders", "#wc-low-stock-amount", "!#wc-stock-status"]',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->make('form-items.combined.multiple-selector-with-attribute', [
        'name'          => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_STOCK_QUANTITY_SELECTORS,
        'title'         => _wpcc('Stock Quantity Selectors'),
        'info'          => _wpcc('CSS selectors for stock quantity.') . ' ' . _wpcc_trans_multiple_selectors_first_match(),
        'id'            => 'wc-stock-quantity-selectors',
        'optionsBox'    => true,
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->make('form-items.combined.select-with-label', [
        'name'      => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_BACKORDERS,
        'title'     => _wpcc('Allow backorders?'),
        'info'      => _wpcc('Select if backorders are allowed or not.'),
        'options'   => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::getBackorderOptionsForSelect(),
        'id'        => 'wc-backorders',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->make('form-items.combined.input-with-label', [
        'name'  => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_LOW_STOCK_AMOUNT,
        'title' => _wpcc('Low Stock Threshold'),
        'info'  => _wpcc('When product stock reaches this amount you will be notified by email by WooCommerce.'),
        'type'  => 'number',
        'id'    => 'wc-low-stock-amount',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->make('form-items.combined.select-with-label', [
        'name'      => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_STOCK_STATUS,
        'title'     => _wpcc('Stock Status'),
        'info'      => _wpcc('Select stock status.'),
        'options'   => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::getStockStatusOptionsForSelect(),
        'id'        => 'wc-stock-status',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->make('form-items.combined.checkbox-with-label', [
        'name'          => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_SOLD_INDIVIDUALLY,
        'title'         => _wpcc('Sold individually?'),
        'info'          => _wpcc('Enable this to only allow one of this item to be bought in a single order.'),
        'id'            => 'wc-sold-individually'
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</table>
<?php /**PATH C:\xampp\htdocs\huhu\wp-content\plugins\wp-content-crawler\app\views/post-detail/woocommerce/site-settings/tab-inventory.blade.php ENDPATH**/ ?>