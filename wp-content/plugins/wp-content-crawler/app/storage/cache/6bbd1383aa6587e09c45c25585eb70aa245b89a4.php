<div class="woocommerce-wrapper">

    
    <div class="woocommerce-header">
        <span class="title"><?php echo e(_wpcc("Product data")); ?> —</span>
        <div class="product-data-options">

            
            <label for="<?php echo e(\WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_PRODUCT_TYPE); ?>">
                <?php echo $__env->make('form-items.select', [
                    'name'      =>  \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_PRODUCT_TYPE,
                    'options'   =>  \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::getProductTypeOptionsForSelect(),
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </label>

            
            <label for="<?php echo e(\WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_VIRTUAL); ?>">
                <span><?php echo e(_wpcc("Virtual")); ?>: </span>
                <?php echo $__env->make('form-items.checkbox', [
                    'name' => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_VIRTUAL,
                    'dependants' => '["!.wc-tab-shipping"]'
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </label>

            
            <label for="<?php echo e(\WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_DOWNLOADABLE); ?>">
                <span><?php echo e(_wpcc("Downloadable")); ?>: </span>
                <?php echo $__env->make('form-items.checkbox', [
                    'name' => \WPCCrawler\PostDetail\WooCommerce\WooCommerceSettings::WC_DOWNLOADABLE,
                    'dependants' => '[".wc-download"]'
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </label>

        </div>
    </div>

    
    <div class="woocommerce-settings-wrapper">

        
        <div class="tab-wrapper">

            
            <ul>
                <?php $titleViewName = 'post-detail.woocommerce.site-settings.partial.tab-list-item'; ?>

                <?php echo $__env->make($titleViewName, ['title' => _wpcc("General"),          'href' => '#wc-tab-general',         'icon' => 'admin-tools',   'active' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make($titleViewName, ['title' => _wpcc("Inventory"),        'href' => '#wc-tab-inventory',       'icon' => 'clipboard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make($titleViewName, ['title' => _wpcc("Shipping"),         'href' => '#wc-tab-shipping',        'icon' => 'cart',          'class' => 'wc-tab-shipping'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make($titleViewName, ['title' => _wpcc("Attributes"),       'href' => '#wc-tab-attributes',      'icon' => 'feedback'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make($titleViewName, ['title' => _wpcc("Advanced"),         'href' => '#wc-tab-advanced',        'icon' => 'admin-generic'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </ul>

        </div>

        <?php
            // URL selector for all inputs that require a $urlSelector parameter.
            $urlSelector = sprintf('#%s', \WPCCrawler\Objects\Settings\Enums\SettingKey::TEST_URL_POST);
        ?>

        
        <div class="tab-content-wrapper">

            
            <div id="wc-tab-general" class="tab-content">
                <?php echo $__env->make('post-detail.woocommerce.site-settings.tab-general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            
            <div id="wc-tab-inventory" class="tab-content hidden">
                <?php echo $__env->make('post-detail.woocommerce.site-settings.tab-inventory', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            
            <div id="wc-tab-shipping" class="tab-content hidden">
                <?php echo $__env->make('post-detail.woocommerce.site-settings.tab-shipping', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            
            
                
            

            
            <div id="wc-tab-attributes" class="tab-content hidden">
                <?php echo $__env->make('post-detail.woocommerce.site-settings.tab-attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            
            <div id="wc-tab-advanced" class="tab-content hidden">
                <?php echo $__env->make('post-detail.woocommerce.site-settings.tab-advanced', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

        </div>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\huhu\wp-content\plugins\wp-content-crawler\app\views/post-detail/woocommerce/site-settings/container.blade.php ENDPATH**/ ?>