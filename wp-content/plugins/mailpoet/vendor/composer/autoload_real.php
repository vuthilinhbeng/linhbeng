<?php
if (!defined('ABSPATH')) exit;
// autoload_real.php @generated by Composer
class ComposerAutoloaderInit7154c0f5b1249ad627f98ad41d1eb05d
{
 private static $loader;
 public static function loadClassLoader($class)
 {
 if ('Composer\Autoload\ClassLoader' === $class) {
 require __DIR__ . '/ClassLoader.php';
 }
 }
 public static function getLoader()
 {
 if (null !== self::$loader) {
 return self::$loader;
 }
 require __DIR__ . '/platform_check.php';
 spl_autoload_register(array('ComposerAutoloaderInit7154c0f5b1249ad627f98ad41d1eb05d', 'loadClassLoader'), true, true);
 self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
 spl_autoload_unregister(array('ComposerAutoloaderInit7154c0f5b1249ad627f98ad41d1eb05d', 'loadClassLoader'));
 require __DIR__ . '/autoload_static.php';
 call_user_func(\Composer\Autoload\ComposerStaticInit7154c0f5b1249ad627f98ad41d1eb05d::getInitializer($loader));
 $loader->register(true);
 $includeFiles = \Composer\Autoload\ComposerStaticInit7154c0f5b1249ad627f98ad41d1eb05d::$files;
 foreach ($includeFiles as $fileIdentifier => $file) {
 composerRequire7154c0f5b1249ad627f98ad41d1eb05d($fileIdentifier, $file);
 }
 return $loader;
 }
}
function composerRequire7154c0f5b1249ad627f98ad41d1eb05d($fileIdentifier, $file)
{
 if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
 $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
 require $file;
 }
}