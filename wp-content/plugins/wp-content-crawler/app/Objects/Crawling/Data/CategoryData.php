<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 25/08/16
 * Time: 15:04
 */

namespace WPCCrawler\Objects\Crawling\Data;


use WPCCrawler\Objects\Crawling\Data\Url\PostUrlList;
use WPCCrawler\Objects\Enums\ValueType;
use WPCCrawler\Objects\Events\Enums\EventGroupKey;
use WPCCrawler\Objects\Filtering\Objects\FieldConfig;
use WPCCrawler\Objects\Transformation\Interfaces\Transformable;
use WPCCrawler\Objects\Transformation\Objects\TransformableField;
use WPCCrawler\Objects\Transformation\Objects\TransformableFieldList;

class CategoryData implements Transformable {

    const FIELD_POST_URL            = 'postUrlList.items.url';
    const FIELD_POST_THUMBNAIL_URL  = 'postUrlList.items.thumbnailUrl';

    /** @var PostUrlList */
    private $postUrlList;

    /** @var array */
    private $thumbnails;

    /** @var string */
    private $nextPageUrl;

    /*
     *
     */

    /** @var TransformableFieldList */
    private $transformableFields = null;

    /** @var TransformableFieldList */
    private $interactableFields = null;

    /*
     * GETTERS AND SETTERS
     */

    /**
     * @return PostUrlList
     */
    public function getPostUrlList(): PostUrlList {
        if ($this->postUrlList === null) {
            $this->postUrlList = new PostUrlList();
        }

        return $this->postUrlList;
    }

    /**
     * @param PostUrlList $postUrlList
     */
    public function setPostUrlList(?PostUrlList $postUrlList) {
        $this->postUrlList = $postUrlList ?: new PostUrlList();
    }

    /**
     * Reverse the order of {@link postUrlList}
     *
     * @since 1.11.0
     */
    public function reversePostUrls() {
        $this->getPostUrlList()->reverse();
    }

    /**
     * @return array
     */
    public function getThumbnails() {
        return $this->thumbnails ?: [];
    }

    /**
     * @param array $thumbnails
     */
    public function setThumbnails($thumbnails) {
        $this->thumbnails = $thumbnails;
    }

    /**
     * @return string
     */
    public function getNextPageUrl() {
        return $this->nextPageUrl;
    }

    /**
     * @param string $nextPageUrl
     */
    public function setNextPageUrl($nextPageUrl) {
        $this->nextPageUrl = $nextPageUrl;
    }

    /*
     *
     */

    public function getTransformableFields(): TransformableFieldList {
        if ($this->transformableFields === null) {
            $this->transformableFields = new TransformableFieldList();
        }

        return $this->transformableFields;
    }

    public function getInteractableFields(): TransformableFieldList {
        if ($this->interactableFields === null) {
            $this->interactableFields = (new TransformableFieldList(null, new FieldConfig(EventGroupKey::CATEGORY_DATA)))
                ->add(new TransformableField(static::FIELD_POST_URL,           _wpcc('Post URL'),           [ValueType::T_STRING, ValueType::T_COUNTABLE]))
                ->add(new TransformableField(static::FIELD_POST_THUMBNAIL_URL, _wpcc('Post Thumbnail URL'), [ValueType::T_STRING, ValueType::T_COUNTABLE]));
        }

        return $this->interactableFields;
    }

    public function getConditionCommandFields(): ?TransformableFieldList {
        return null;
    }

    public function getActionCommandFields(): ?TransformableFieldList {
        return null;
    }

}