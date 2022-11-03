<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 17/11/2019
 * Time: 07:28
 *
 * @since 1.9.0
 */

namespace WPCCrawler\Objects\Html;

use Symfony\Component\DomCrawler\Crawler;
use WPCCrawler\Objects\Crawling\Bot\DummyBot;

/**
 * Removes script elements and attributes
 *
 * @package WPCCrawler\Objects\Html
 * @since   1.8.1
 */
class ScriptRemover {

    /** @var Crawler Crawler storing the HTML code whose scripts will be removed */
    private $crawler;
    
    /** @var DummyBot */
    private $dummyBot;

    /**
     * @var string[] Names of attributes that are used to store and run JavaScript
     */
    private static $EVENT_ATTR_NAMES = [
        'onafterprint',
        'onbeforeprint',
        'onbeforeunload',
        'onerror',
        'onhashchange',
        'onload',
        'onmessage',
        'onoffline',
        'ononline',
        'onpagehide',
        'onpageshow',
        'onpopstate',
        'onresize',
        'onstorage',
        'onunload',
        'onblur',
        'onchange',
        'oncontextmenu',
        'onfocus',
        'oninput',
        'oninvalid',
        'onreset',
        'onsearch',
        'onselect',
        'onsubmit',
        'onkeydown',
        'onkeypress',
        'onkeyup',
        'onclick',
        'ondblclick',
        'onmousedown',
        'onmousemove',
        'onmouseout',
        'onmouseover',
        'onmouseup',
        'onmousewheel',
        'onwheel',
        'ondrag',
        'ondragend',
        'ondragenter',
        'ondragleave',
        'ondragover',
        'ondragstart',
        'ondrop',
        'onscroll',
        'oncopy',
        'oncut',
        'onpaste',
        'onabort',
        'oncanplay',
        'oncanplaythrough',
        'oncuechange',
        'ondurationchange',
        'onemptied',
        'onended',
        'onerror',
        'onloadeddata',
        'onloadedmetadata',
        'onloadstart',
        'onpause',
        'onplay',
        'onplaying',
        'onprogress',
        'onratechange',
        'onseeked',
        'onseeking',
        'onstalled',
        'onsuspend',
        'ontimeupdate',
        'onvolumechange',
        'onwaiting',
        'ontoggle',
    ];

    /** @var bool */
    private $isCrawler;

    /**
     * ScriptRemover constructor.
     *
     * @param string|Crawler $html See {@link crawler}
     * @since 1.9.0
     */
    public function __construct($html) {
        $this->dummyBot = new DummyBot([]);

        $this->isCrawler = is_a($html, Crawler::class);
        $this->crawler = $this->isCrawler
            ? $html
            : $this->dummyBot->createDummyCrawler($html);
    }

    /**
     * @return string|Crawler If a string is provided in {@link __construct}, then the HTML code will be returned.
     *                        Otherwise, the crawler will be returned.
     * @since 1.9.0
     */
    public function removeScripts() {
        // Remove script elements
        $this->dummyBot->removeElementsFromCrawler($this->crawler, "script");

        // Remove element attributes that can be used to run JavaScript
        foreach(static::getEventAttrNames() as $attr) {
            $this->dummyBot->removeElementAttributes($this->crawler, "[{$attr}]", $attr);
        }

        // Remove href attributes starting with "javascript"
        $this->dummyBot->removeElementAttributes($this->crawler, '[href^="javascript"]', 'href');
        return $this->isCrawler
            ? $this->crawler
            : $this->dummyBot->getContentFromDummyCrawler($this->crawler);
    }

    /*
     * STATIC METHODS
     */

    /**
     * @return string[] See {@link eventAttrNames}
     * @since 1.9.0
     */
    public static function getEventAttrNames(): array {
        return static::$EVENT_ATTR_NAMES;
    }
}