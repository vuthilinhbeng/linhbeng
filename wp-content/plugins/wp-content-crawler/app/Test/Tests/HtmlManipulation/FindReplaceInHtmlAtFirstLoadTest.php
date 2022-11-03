<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 07/05/2019
 * Time: 22:44
 *
 * @since 1.9.0
 */

namespace WPCCrawler\Test\Tests\HtmlManipulation;


use Symfony\Component\DomCrawler\Crawler;
use WPCCrawler\Objects\Crawling\Bot\AbstractBot;
use WPCCrawler\Objects\Settings\Enums\SettingInnerKey;
use WPCCrawler\Test\Base\AbstractHtmlManipulationTest;
use WPCCrawler\Test\Base\AbstractTest;
use WPCCrawler\Test\Data\TestData;
use WPCCrawler\Utils;

class FindReplaceInHtmlAtFirstLoadTest extends AbstractHtmlManipulationTest {

    private $url;
    private $content;
    private $find;
    private $replace;
    private $regex;

    /**
     * Get the last HTML manipulation step. See {@link applyHtmlManipulationOptions}
     *
     * @return null|int
     */
    protected function getLastHtmlManipulationStep() {
        return AbstractTest::MANIPULATION_STEP_NONE;
    }

    /**
     * Define instance variables.
     *
     * @return void
     */
    protected function defineVariables() {
        $formItemValues = $this->getData()->getFormItemValues();

        $this->url      = $this->getData()->get("url");
        $this->content  = $this->getData()->get("subject");
        $this->find     = Utils::array_get($formItemValues, SettingInnerKey::FIND);
        $this->replace  = Utils::array_get($formItemValues, SettingInnerKey::REPLACE);
        $this->regex    = isset($formItemValues[SettingInnerKey::REGEX]);
    }

    /**
     * @return string
     */
    protected function getMessageLastPart() {
        return sprintf('%1$s %2$s %3$s',
            $this->find       ? "<span class='highlight find'>" . htmlspecialchars($this->find) . "</span>"         : '',
            $this->replace    ? "<span class='highlight replace'>" . htmlspecialchars($this->replace) . "</span>"   : '',
            $this->regex      ? _wpcc("(as regex)") : ''
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
        // Use the bot's own implementation to manipulate the crawler by applying find-replace options that are under
        // test.
        return $bot->makeInitialReplacements(
            $crawler,
            [$bot->createFindReplaceConfig($this->find, $this->replace, $this->regex)],
            $this->isManipulationOptionsForPost()
        );
    }

    protected function addResults($crawler, &$results, &$selector, &$attr) {
        // Add the HTML of the crawler as the result. We override this method, because we want a different behavior here.
        // We do not want to use a selector to find the result. Using "html" as selector produces a result that does not
        // contain the html tag, it shows the children of the html element. However, we want to show the html tag as
        // well, since it might provide valuable information in some cases.
        $results[] = Utils::getNodeHTML($crawler);
    }

    /**
     * Conduct the test and return an array of results.
     *
     * @param TestData $data Information required for the test
     * @return array|string|mixed
     */
    protected function createResults($data) {
        if (parent::createResults($data) === null) return null;

        // Providing any selector would do the job. We provide a selector, because we want the method to work properly
        // The method does not work if there is no selector. Hence, we just provide a selector. Although the selector
        // has no effect, providing "html" as selector is logical because we want the HTML to be output as result.
        return $this->createHtmlManipulationResults($this->url, $this->content, "html", $this->getMessageLastPart());
    }

    protected function createView() {
        // Add a result renderer to the test result view. The renderer shows the results in a textarea element
        return parent::createView()
            ->with('singleResultView', 'partials.test-result-single-textarea');
    }
}