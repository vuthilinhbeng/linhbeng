<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 25/10/2018
 * Time: 15:55
 */

namespace WPCCrawler\Test\Data;


use Illuminate\Support\Str;
use WPCCrawler\Objects\OptionsBox\Boxes\Base\BaseOptionsBoxApplier;
use WPCCrawler\Objects\OptionsBox\Boxes\Base\BaseOptionsBoxData;
use WPCCrawler\Objects\OptionsBox\OptionsBoxService;
use WPCCrawler\Objects\Settings\Enums\SettingKey;
use WPCCrawler\Utils;

class TestData {

    /** @var array|null Raw data given in the constructor. */
    private $data;

    private $testType = null;

    private $formItemValues = null;

    /**
     * @var null Find-and-replaces that will be applied to raw response content for every test that sends a request to
     * remote server. General post and category tests are excluded. They use the settings retrieved from site settings
     * directly. For the structure of this array, see {@link FindAndReplaceTrait::findAndReplace}.
     */
    private $rawHtmlFindReplaces = null;

    /**
     * @var array HTML manipulation options in the test data. E.g. ["_post_exchange_element_attributes" => [...]]
     */
    private $manipulationOptions = [];

    /**
     * @var bool|null See {@link AbstractBot::__construct}
     */
    private $useUtf8 = null;

    /**
     * @var bool|null See {@link AbstractBot::__construct}
     */
    private $convertEncodingToUtf8 = null;

    /** @var null|BaseOptionsBoxApplier */
    private $optionsBoxApplier = null;

    /** @var null|array */
    private $testData = null;

    /** @var bool True if the test data is retrieved from a test conducted in the options box */
    private $fromOptionsBox = false;

    /** @var array */
    private $cookies = [];

    /** @var bool */
    private $cacheTestUrlResponses = false;

    /** @var array|null */
    private $customGeneralSettings;

    /**
     * @param array $data
     * @param bool $unslash True if the data should be unslashed.
     */
    public function __construct($data, $unslash = true) {
        $this->data = $unslash ? wp_unslash($data) : $data;
        $this->prepare();
    }

    /*
     * GETTERS
     */

    /**
     * @return array|null
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @return null
     */
    public function getTestType() {
        return $this->testType;
    }

    /**
     * @return null
     */
    public function getFormItemValues() {
        return $this->formItemValues;
    }

    /**
     * @return BaseOptionsBoxData|null
     */
    public function getOptionsBoxData() {
        return $this->optionsBoxApplier ? $this->optionsBoxApplier->getData() : null;
    }

    /**
     * @return null See {@link rawHtmlFindReplaces}
     */
    public function getRawHtmlFindReplaces() {
        return $this->rawHtmlFindReplaces;
    }

    /**
     * @return array See {@link manipulationOptions}
     */
    public function getManipulationOptions() {
        return $this->manipulationOptions;
    }

    /**
     * @return bool|null See {@link useUtf8}
     */
    public function getUseUtf8() {
        return $this->useUtf8;
    }

    /**
     * @return bool|null See {@link convertEncodingToUtf8}
     */
    public function getConvertEncodingToUtf8() {
        return $this->convertEncodingToUtf8;
    }

    /**
     * @return array|null
     */
    public function getTestData() {
        return $this->testData;
    }

    /**
     * @param array|null $testData
     */
    public function setTestData($testData) {
        $this->testData = $testData;
    }

    /**
     * @return string|null
     */
    public function getFormItemName() {
        return $this->get('formItemName');
    }

    /**
     * @return bool See {@link fromOptionsBox}
     */
    public function isFromOptionsBox() {
        return $this->fromOptionsBox;
    }

    /**
     * @return array
     */
    public function getCookies() {
        return $this->cookies;
    }

    /**
     * @return bool
     */
    public function isCacheTestUrlResponses() {
        return $this->cacheTestUrlResponses;
    }

    /**
     * @return array|null
     */
    public function getCustomGeneralSettings() {
        return $this->customGeneralSettings;
    }

    /**
     * Get a value from {@link data} array.
     *
     * @param string $key           Item key
     * @param null|mixed $default   Default value
     * @return mixed                Item value
     */
    public function get($key, $default = null) {
        return Utils::array_get($this->getData(), $key, $default);
    }

    /**
     * Applies options box settings to the test data using the provided applier.
     *
     * @param callable $callbackModifyApplier A callable that can be used to modify the options box. It takes a single
     *                                        parameter, which is the options box applier to be modified, i.e.
     *                                        func($optionsBoxApplier) {}
     * @return BaseOptionsBoxApplier|null
     */
    public function applyOptionsBoxSettingsToTestData($callbackModifyApplier) {
        if (!$this->optionsBoxApplier) return null;

        if ($callbackModifyApplier && is_callable($callbackModifyApplier)) {
            call_user_func($callbackModifyApplier, $this->optionsBoxApplier);
        }

        $this->testData = array_map(function($v) {
            return $this->optionsBoxApplier->apply($v);
        }, $this->testData);

        return $this->optionsBoxApplier;
    }

    /**
     * Get the data as post settings. This can be used, e.g., when initializing an AbstractBot with settings.
     *
     * @return array Key-value pair where keys are post meta keys and values are the setting values.
     */
    public function getPostSettings() {
        $settings = [];

        // Set cookies
        if ($cookies = $this->getCookies()) {
            $settings[SettingKey::COOKIES] = $cookies;
        }

        // Set custom general settings
        if ($this->customGeneralSettings) {
            $settings[SettingKey::DO_NOT_USE_GENERAL_SETTINGS] = "on";
            $settings += $this->customGeneralSettings;
        }

        return $settings;
    }

    /*
     * PRIVATE METHODS
     */

    /**
     * Processes the data array and prepare instance variables
     */
    private function prepare() {
        $this->testType = Utils::array_get($this->data, "testType");

        $this->prepareFormItemValues();
        $this->prepareHtmlManipulationOptions();
        $this->prepareUseUtf8();
        $this->prepareConvertEncodingToUtf8();
        $this->prepareOptionsBoxApplier();
        $this->prepareCookies();
        $this->prepareCacheTestUrlResponses();
        $this->prepareCustomGeneralSettings();
        $this->prepareTestData();

        // Set if the test data comes from an options box or not
        $this->fromOptionsBox = Utils::array_get($this->data, "fromOptionsBox", null) === "1";
    }

    /**
     * @return void
     */
    private function prepareUseUtf8() {
        $useUtf8Val = Utils::array_get($this->data, "useUtf8");
        $this->useUtf8 = $useUtf8Val == -1 ? null : $useUtf8Val == 1;
    }

    /**
     * @return void
     */
    private function prepareConvertEncodingToUtf8() {
        $convertEncodingVal = Utils::array_get($this->data, "convertEncodingToUtf8");
        $this->convertEncodingToUtf8 = $convertEncodingVal == -1 ? null : $convertEncodingVal == 1;
    }

    /**
     * @return void
     */
    private function prepareFormItemValues() {
        $serializedValues = Utils::array_get($this->data, "serializedValues");

        // If it exists, get the name of the form item. Some tests do not require a form item.
        $formItemName = $serializedValues ? Utils::array_get($this->data, "formItemName") : null;

        // If it exists, get the form item values unserialized.
        $formItemValues = null;
        if($formItemName && $serializedValues) {
            // Parse the serialized string to get the values as an array.
            parse_str($serializedValues, $formItemValues);

            // When the serialized string is parsed, the values will be under the name of the form item. So, since we
            // need the values directly, let's extract them.
            $formItemValues = Utils::array_get($formItemValues, $formItemName);

            $dotKey = Utils::array_get($this->data, "formItemDotKey");
            if ($dotKey) $formItemValues = Utils::array_get($formItemValues, $dotKey);

            // If the form item values has only 1 item inside, get it directly. Because, the values are inside the first
            // item.
            if($formItemValues && is_array($formItemValues) && sizeof($formItemValues) == 1) {
                $formItemValues = array_values($formItemValues)[0];
            }
        }

        $this->formItemValues = $formItemValues;
    }

    /**
     * @return void
     */
    private function prepareHtmlManipulationOptions() {
        $manipulationOptions = Utils::array_get($this->data, "manipulation_options");
        if (!$manipulationOptions) return;

        $values = null;
        foreach($manipulationOptions as $optionName => $serializedValues) {
            // Filter settings are provided as arrays, not as a URL-encoded string
            if (is_array($serializedValues)) {
                // Filter settings are assumed to be stored as JSON-encoded strings. So, JSON-encode them so that
                // methods using this setting can work as intended.
                $this->manipulationOptions[$optionName] = json_encode($serializedValues);
                continue;
            }

            // Unserialize the values and store them in $values
            parse_str($serializedValues, $values);

            // When unserialized, the created array has a single item whose key is the option's name. So, let's get only
            // the values of the option name.
            $values = $values[$optionName];

            // Store the options in the instance variable
            $this->manipulationOptions[$optionName] = $values;

            // If this option name is for "raw HTML find and replaces", store the value in the related instance variable
            if (!$this->rawHtmlFindReplaces && Str::endsWith($optionName, 'find_replace_raw_html')) {
                $this->rawHtmlFindReplaces = $values;
            }
        }

    }

    /**
     * @return void
     */
    private function prepareOptionsBoxApplier() {
        // If the options box data comes in the form item values array
        $formItemValues = $this->getFormItemValues();
        if ($formItemValues && is_array($formItemValues) && isset($formItemValues['options_box'])) {
            $json = $formItemValues['options_box'];
            $this->optionsBoxApplier = OptionsBoxService::getInstance()->createApplierFromRawData($json, false);

        // If it comes in the data directly
        } else if($rawOptionsBoxData = Utils::array_get($this->data, "optionsBox")) {
            $this->optionsBoxApplier = OptionsBoxService::getInstance()->createApplierFromRawData($rawOptionsBoxData, false);
        }

        // If there is an applier, make it run for testing purposes.
        if ($this->optionsBoxApplier) {
            $this->optionsBoxApplier->setForTest(true);
        }
    }

    /**
     * @return void
     */
    private function prepareCookies() {
        $serializedCookies = Utils::array_get($this->data, 'cookies');
        if (!$serializedCookies) return;

        parse_str($serializedCookies, $cookieData);
        if (!$cookieData || !isset($cookieData[SettingKey::COOKIES])) return;

        $this->cookies = $cookieData[SettingKey::COOKIES];
    }

    /**
     * Prepare {@link $cacheTestUrlResponses} value.
     * @since 1.8.0
     */
    private function prepareCacheTestUrlResponses() {
        $shouldCache = Utils::array_get($this->data, 'cacheTestUrlResponses');
        $this->cacheTestUrlResponses = $shouldCache ? true : false;
    }

    /**
     * @return void
     */
    private function prepareCustomGeneralSettings() {
        $serialized = Utils::array_get($this->data, "customGeneralSettings");
        if (!$serialized) return;

        parse_str($serialized, $settings);
        if (!$settings) return;

        $this->customGeneralSettings = $settings;
    }

    /**
     * @return void
     */
    private function prepareTestData() {
        // Prepare extra information
        if (isset($this->data['extra'])) {
            $extra = $this->data['extra'];

            // Get the test data if exists. Make sure the strings are stripped from slashes.
            $this->testData = Utils::array_get($extra, 'test');
        }
    }

}
