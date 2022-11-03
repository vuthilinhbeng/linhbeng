

<tr <?php if(isset($id)): ?> id="<?php echo e($id); ?>" <?php endif; ?>
<?php if(isset($class)): ?> class="<?php echo e($class); ?>" <?php endif; ?>
>
    <td>
        <?php echo $__env->make('form-items/label', [
            'for'   =>  $name,
            'title' =>  $title,
            'info'  =>  $info
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </td>
    <td>
        <?php echo $__env->make('form-items/multiple', [
            'include'       => 'post-detail.woocommerce.form-items.custom-product-attribute',
            'name'          => $name,
            'addKeys'       => true,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials/test-result-container', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </td>
</tr><?php /**PATH C:\xampp\htdocs\huhu\wp-content\plugins\wp-content-crawler\app\views/post-detail/woocommerce/form-items/combined/multiple-custom-product-attribute.blade.php ENDPATH**/ ?>