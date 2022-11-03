<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 26/10/2018
 * Time: 07:29
 */

namespace WPCCrawler\Test\Tests\HtmlManipulation;


use Symfony\Component\DomCrawler\Crawler;
use WPCCrawler\Objects\Crawling\Bot\AbstractBot;
use WPCCrawler\Objects\Settings\Enums\SettingInnerKey;
use WPCCrawler\Test\Base\AbstractHtmlManipulationTest;
use WPCCrawler\Test\Base\AbstractTest;
use WPCCrawler\Test\Data\TestData;
use WPCCrawler\Utils;

class RemoveElementAttributesTest extends AbstractHtmlManipulationTest {

    private $url;
    private $content;
    private $selector;
    private $attributes;

    /**
     * Get the last HTML manipulation step. See {@link applyHtmlManipulationOptions}
     *
     * @return null|int
     */
    protected function getLastHtmlManipulationStep() {
        return AbstractTest::MANIPULATION_STEP_EXCHANGE_ELEMENT_ATTRIBUTES;
    }

    /**
     * Define instance variables.
     * @return void
     */
    protected function defineVariables() {
        $this->url          = $this->getData()->get("url");
        $this->content      = $this->getData()->get("subject");
        $this->selector     = Utils::array_get($this->getData()->getFormItemValues(), SettingInnerKey::SELECTOR);
        $this->attributes   = Utils::array_get($this->getData()->getFormItemValues(), SettingInnerKey::ATTRIBUTE);
    }

    /**
     * @return string
     */
    protected function getMessageLastPart() {
        return sprintf('%1$s %2$s',
            $this->selector   ? "<span class='highlight selector'>" . $this->selector . "</span>"       : '',
            $this->attributes ? "<span class='highlight attribute'>" . $this->attributes . "</span>"    : ''
        );
    }

    /**
     * Returns a manipulated {@link Crawler}. {@link AbstractBot} is the bot that is used to get the data from the
     * target URL and it can be used to manipulate the content.
     *
     * @param Crawler $crawler
     * @param AbstractBot $bot
     * @return Crawler
     */
    protected function manipulate($crawler, $bot) {
        $bot->removeElementAttributes($crawler, [$this->selector], $this->attributes);
        return $crawler;
    }

    /**
     * Conduct the test and return an array of results.
     *
     * @param TestData $data Information required for the test
     * @return array|string|mixed
     */
    protected function createResults($data) {
        if (parent::createResults($data) === null) return null;

        return $this->createHtmlManipulationResults($this->url, $this->content, $this->selector, $this->getMessageLastPart());
    }
}