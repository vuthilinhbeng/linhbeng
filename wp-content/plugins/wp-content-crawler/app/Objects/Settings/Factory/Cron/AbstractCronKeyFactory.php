<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 24/10/19
 * Time: 20:00
 */

namespace WPCCrawler\Objects\Settings\Factory\Cron;


abstract class AbstractCronKeyFactory {

    protected static $instances = [];

    /**
     * Get the instance of the factory
     *
     * @return mixed|AbstractCronKeyFactory
     */
    public static function getInstance() {
        $calledClass = get_called_class();

        if (!isset(static::$instances[$calledClass])) {
            static::$instances[$calledClass] = new $calledClass();
        }

        return static::$instances[$calledClass];
    }

    /**
     * This is a singleton
     */
    private function __construct() { }

    /**
     * @return string The setting key storing last crawled URL ID
     */
    abstract public function getLastCrawledUrlIdKey();

    /**
     * @return string The setting key storing next page URL of the post
     */
    abstract public function getPostNextPageUrlKey();

    /**
     * @return string The setting key storing the next page URLs of the post
     */
    abstract public function getPostNextPageUrlsKey();

    /**
     * @return string The setting key storing the draft post ID
     */
    abstract public function getPostDraftIdKey();

    /**
     * @return string The setting key storing the last time at which the post was crawled
     */
    abstract public function getLastCrawledAtKey();


}