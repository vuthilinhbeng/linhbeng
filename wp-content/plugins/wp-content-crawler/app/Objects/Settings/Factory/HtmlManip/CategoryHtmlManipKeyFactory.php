<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 07/11/2019
 * Time: 21:11
 *
 * @since 1.9.0
 */

namespace WPCCrawler\Objects\Settings\Factory\HtmlManip;


use WPCCrawler\Objects\Settings\Enums\SettingKey;

class CategoryHtmlManipKeyFactory extends AbstractHtmlManipKeyFactory {

    /**
     * @return string The setting key storing the test code used to test the settings
     */
    public function getTestFindReplaceKey() {
        return SettingKey::TEST_FIND_REPLACE_FIRST_LOAD_CAT;
    }

    /**
     * @return string The setting key storing raw HTML find-replace settings
     */
    public function getFindReplaceRawHtmlKey() {
        return SettingKey::CATEGORY_FIND_REPLACE_RAW_HTML;
    }

    /**
     * @return string The setting key storing find-replace settings that should be applied at first load
     */
    public function getFindReplaceFirstLoadKey() {
        return SettingKey::CATEGORY_FIND_REPLACE_FIRST_LOAD;
    }

    /**
     * @return string The setting key storing find-replace settings applied in element attribute
     */
    public function getFindReplaceElementAttributesKey() {
        return SettingKey::CATEGORY_FIND_REPLACE_ELEMENT_ATTRIBUTES;
    }

    /**
     * @return string The setting key storing values of what attributes of HTML elements should be exchanged
     */
    public function getExchangeElementAttributesKey() {
        return SettingKey::CATEGORY_EXCHANGE_ELEMENT_ATTRIBUTES;
    }

    /**
     * @return string The setting key storing what attributes to remove
     */
    public function getRemoveElementAttributesKey() {
        return SettingKey::CATEGORY_REMOVE_ELEMENT_ATTRIBUTES;
    }

    /**
     * @return string The setting key storing find-replace rules to be applied to HTML codes of elements
     */
    public function getFindReplaceElementHtmlKey() {
        return SettingKey::CATEGORY_FIND_REPLACE_ELEMENT_HTML;
    }

    /**
     * @return string The setting key storing what elements should be removed
     */
    public function getUnnecessaryElementSelectorsKey() {
        return SettingKey::CATEGORY_UNNECESSARY_ELEMENT_SELECTORS;
    }

    /**
     * @inheritDoc
     */
    public function getPageFiltersKey() {
        return SettingKey::CATEGORY_PAGE_FILTERS;
    }

    public function getRequestFiltersKey() {
        return SettingKey::CATEGORY_REQUEST_FILTERS;
    }

}