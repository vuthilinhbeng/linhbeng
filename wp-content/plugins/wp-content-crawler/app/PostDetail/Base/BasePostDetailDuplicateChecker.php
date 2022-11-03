<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 05/12/2018
 * Time: 18:18
 *
 * @since 1.8.0
 */

namespace WPCCrawler\PostDetail\Base;


use WPCCrawler\Objects\Crawling\Bot\PostBot;
use WPCCrawler\Objects\Crawling\Data\PostSaverData;

abstract class BasePostDetailDuplicateChecker {

    /** @var array|null */
    private $options;

    /** @var PostBot */
    private $postBot;

    /** @var BasePostDetailData */
    private $detailData;

    /**
     * @param PostBot            $postBot
     * @param BasePostDetailData $detailData
     */
    public function __construct($postBot, $detailData) {
        $this->postBot = $postBot;
        $this->detailData = $detailData;
    }

    /**
     * @param PostBot $postBot
     */
    public function setPostBot($postBot) {
        $this->postBot = $postBot;
    }

    /**
     * @param BasePostDetailData $detailData
     */
    public function setDetailData($detailData) {
        $this->detailData = $detailData;
    }

    /**
     * Create options that will be shown in "duplicate check types" option.
     *
     * @return null|array A key-value pair. Keys are the keys of the options, values are the names that will be shown
     *                    to the user.
     * @since 1.8.0
     */
    abstract protected function createOptions();

    /**
     * Implement the logic for checking if the post is duplicate.
     *
     * @param PostSaverData $saverData Data that stores information that can be used for duplicate checking
     * @param array         $values    An array that stores the duplicate check options selected by the user.
     * @return int|false ID of the post if this is duplicate. Otherwise, false.
     * @since 1.8.0
     */
    abstract public function checkForDuplicate(PostSaverData $saverData, array $values);

    /**
     * Get duplicate check options.
     *
     * @return null|array
     * @since 1.8.0
     */
    public function getOptions() {
        if (!$this->options) $this->options = $this->createOptions();

        return is_array($this->options) ? $this->options : null;
    }

    /**
     * @return PostBot
     * @since 1.8.0
     */
    public function getPostBot() {
        return $this->postBot;
    }

    /**
     * @return BasePostDetailData
     */
    public function getDetailData() {
        return $this->detailData;
    }
}