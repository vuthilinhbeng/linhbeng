

<?php
$attr = isset($defaultAttr) && $defaultAttr ? $defaultAttr : 'text'
?>

<tr <?php if(isset($id)): ?> id="<?php echo e($id); ?>" <?php endif; ?>
<?php if(isset($class)): ?> class="<?php echo e($class); ?>" <?php endif; ?>
>
    <td>
        <?php echo $__env->make('form-items/label', [
            'for'   =>  $name,
            'title' =>  $title,
            'info'  =>  $info . ' ' . _wpcc_selector_attribute_info(),
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </td>
    <td>
        <?php echo $__env->make('form-items/multiple', [
            'include'       => 'post-detail.woocommerce.form-items.selector-custom-product-attribute',
            'name'          => $name,
            'addon'         =>  'dashicons dashicons-search',
            'data'          =>  [
                'urlSelector'            =>  $urlSelector,
                'testType'               =>  \WPCCrawler\Test\Test::$TEST_TYPE_SELECTOR_ATTRIBUTE,
                'attr'                   =>  $attr,
                'selectorFinderBehavior' =>  \WPCCrawler\Objects\Enums\SelectorFinderBehavior::SIMILAR,
            ],
            'test'          => true,
            'addKeys'       => true,
            'addonClasses'  => 'wcc-test-selector-attribute',
            'defaultAttr'   => $attr,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials/test-result-container', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </td>
</tr><?php /**PATH C:\xampp\htdocs\huhu\wp-content\plugins\wp-content-crawler\app\views/post-detail/woocommerce/form-items/combined/multiple-selector-custom-product-attribute.blade.php ENDPATH**/ ?>