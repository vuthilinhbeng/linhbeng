

<li class="
        <?php if(isset($active) && $active): ?> active <?php endif; ?>
        <?php if(isset($class) && $class): ?> <?php echo e($class); ?> <?php endif; ?>
    ">
    <a role="button" data-tab="<?php echo e($href); ?>">
        <?php if(isset($icon) && $icon): ?><span class="icon dashicons dashicons-<?php echo e($icon); ?>"></span><?php endif; ?>
        <span><?php echo e($title); ?></span>
    </a>
</li><?php /**PATH C:\xampp\htdocs\huhu\wp-content\plugins\wp-content-crawler\app\views/post-detail/woocommerce/site-settings/partial/tab-list-item.blade.php ENDPATH**/ ?>