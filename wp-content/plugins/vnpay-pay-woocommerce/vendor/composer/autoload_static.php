<?php


namespace Composer\Autoload;

class ComposerStaticInit8f72f3bb7c6ee32c2a5028b2e2d64d68
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'vnpay\\Traits\\' => 17,
            'vnpay\\Shortcodes\\' => 21,
            'vnpay\\Gateways\\' => 19,
            'vnpay\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'vnpay\\Traits\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/traits',
        ),
        'vnpay\\Shortcodes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/shortcodes',
        ),
        'vnpay\\Gateways\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/gateways',
        ),
        'vnpay\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'vnpay\\Facades\\FacadeResponse' => __DIR__ . '/../..' . '/src/FacadeResponse.php',
        'vnpay\\Gateways\\vnpayGateway' => __DIR__ . '/../..' . '/src/gateways/international/vnpayGateway.php',
        'vnpay\\Gateways\\vnpayInternationalResponse' => __DIR__ . '/../..' . '/src/gateways/international/vnpayInternationalResponse.php',
        'vnpay\\Page' => __DIR__ . '/../..' . '/src/Page.php',
        'vnpay\\Responses\\vnpayResponse' => __DIR__ . '/../..' . '/src/vnpayResponse.php',
        'vnpay\\Shortcodes\\Thankyou' => __DIR__ . '/../..' . '/src/shortcodes/Thankyou.php',
        'vnpay\\Traits\\Pages' => __DIR__ . '/../..' . '/src/traits/Pages.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8f72f3bb7c6ee32c2a5028b2e2d64d68::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8f72f3bb7c6ee32c2a5028b2e2d64d68::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8f72f3bb7c6ee32c2a5028b2e2d64d68::$classMap;

        }, null, ClassLoader::class);
    }
}
