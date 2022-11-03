<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 07/11/2019
 * Time: 21:03
 *
 * @since 1.9.0
 */

namespace WPCCrawler\Objects\Settings\Factory\HtmlManip;


abstract class AbstractHtmlManipKeyFactory {

    protected static $instances = [];

    /**
     * Get the instance of the factory
     *
     * @return mixed|AbstractHtmlManipKeyFactory
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
     * @return string The setting key storing the test code used to test the settings
     */
    abstract public function getTestFindReplaceKey();

    /**
     * @return string The setting key storing raw HTML find-replace settings
     */
    abstract public function getFindReplaceRawHtmlKey();

    /**
     * @return string The setting key storing find-replace settings that should be applied at first load
     */
    abstract public function getFindReplaceFirstLoadKey();

    /**
     * @return string The setting key storing find-replace settings applied in element attribute
     */
    abstract public function getFindReplaceElementAttributesKey();

    /**
     * @return string The setting key storing values of what attributes of HTML elements should be exchanged
     */
    abstract public function getExchangeElementAttributesKey();

    /**
     * @return string The setting key storing what attributes to remove
     */
    abstract public function getRemoveElementAttributesKey();

    /**
     * @return string The setting key storing find-replace rules to be applied to HTML codes of elements
     */
    abstract public function getFindReplaceElementHtmlKey();

    /**
     * @return string The setting key storing what elements should be removed
     */
    abstract public function getUnnecessaryElementSelectorsKey();

    /**
     * @return string The setting key storing page filters
     */
    abstract public function getPageFiltersKey();

    /**
     * @return string The setting key storing request filters
     */
    abstract public function getRequestFiltersKey();

}