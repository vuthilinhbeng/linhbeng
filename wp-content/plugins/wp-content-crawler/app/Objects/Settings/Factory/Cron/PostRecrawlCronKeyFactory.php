<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 24/10/19
 * Time: 20:00
 */

namespace WPCCrawler\Objects\Settings\Factory\Cron;


use WPCCrawler\Objects\Settings\Enums\SettingKey;

class PostRecrawlCronKeyFactory extends AbstractCronKeyFactory {

    /**
     * @return string The setting key storing last crawled URL ID
     */
    public function getLastCrawledUrlIdKey() {
        return SettingKey::CRON_RECRAWL_LAST_CRAWLED_URL_ID;
    }

    /**
     * @return string The setting key storing next page URL of the post
     */
    public function getPostNextPageUrlKey() {
        return SettingKey::CRON_RECRAWL_POST_NEXT_PAGE_URL;
    }

    /**
     * @return string The setting key storing the next page URLs of the post
     */
    public function getPostNextPageUrlsKey() {
        return SettingKey::CRON_RECRAWL_POST_NEXT_PAGE_URLS;
    }

    /**
     * @return string The setting key storing the draft post ID
     */
    public function getPostDraftIdKey() {
        return SettingKey::CRON_RECRAWL_POST_DRAFT_ID;
    }

    /**
     * @return string The setting key storing the last time at which the post was crawled
     */
    public function getLastCrawledAtKey() {
        return SettingKey::CRON_RECRAWL_LAST_CRAWLED_AT;
    }
}