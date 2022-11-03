<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 25/08/16
 * Time: 11:33
 */

namespace WPCCrawler\Objects\Crawling\Data;


use DateTime;
use WPCCrawler\Environment;
use WPCCrawler\Objects\Crawling\Data\Meta\PostMeta;
use WPCCrawler\Objects\Crawling\Data\Taxonomy\TaxonomyItem;
use WPCCrawler\Objects\Enums\ValueType;
use WPCCrawler\Objects\Events\Enums\EventGroupKey;
use WPCCrawler\Objects\File\MediaFile;
use WPCCrawler\Objects\Filtering\Objects\FieldConfig;
use WPCCrawler\Objects\Transformation\Interfaces\Transformable;
use WPCCrawler\Objects\Transformation\Objects\Special\DateTimeTransformableField;
use WPCCrawler\Objects\Transformation\Objects\Special\SpecialTransformableField;
use WPCCrawler\Objects\Transformation\Objects\TransformableField;
use WPCCrawler\Objects\Transformation\Objects\TransformableFieldList;
use WPCCrawler\Objects\Value\ValueExtractorOptions;
use WPCCrawler\Utils;

class PostData implements Transformable {

    const FIELD_TITLE                   = 'title';
    const FIELD_EXCERPT                 = 'excerpt.data';
    const FIELD_CATEGORY_NAMES          = 'categoryNames';
    const FIELD_NEXT_PAGE_URL           = 'nextPageUrl';
    const FIELD_ALL_PAGE_URLS           = 'allPageUrls.data';
    const FIELD_SLUG                    = 'slug';
    const FIELD_TEMPLATE                = 'template';
    const FIELD_SHORT_CODE_DATA         = 'shortCodeData.data';
    const FIELD_PREPARED_TAGS           = 'preparedTags';
    const FIELD_META_KEYWORDS           = 'metaKeywords';
    const FIELD_META_DESCRIPTION        = 'metaDescription';
    const FIELD_CUSTOM_META             = 'customMeta.data';
    const FIELD_ATTACHMENT              = 'attachmentData';
    const FIELD_ATTACHMENT_TITLE        = 'attachmentData.mediaTitle';
    const FIELD_ATTACHMENT_DESCRIPTION  = 'attachmentData.mediaDescription';
    const FIELD_ATTACHMENT_CAPTION      = 'attachmentData.mediaCaption';
    const FIELD_ATTACHMENT_ALT          = 'attachmentData.mediaAlt';
    const FIELD_THUMBNAIL               = 'thumbnailData';
    const FIELD_THUMBNAIL_TITLE         = 'thumbnailData.mediaTitle';
    const FIELD_THUMBNAIL_DESCRIPTION   = 'thumbnailData.mediaDescription';
    const FIELD_THUMBNAIL_CAPTION       = 'thumbnailData.mediaCaption';
    const FIELD_THUMBNAIL_ALT           = 'thumbnailData.mediaAlt';
    const FIELD_CUSTOM_TAXONOMIES       = 'customTaxonomies.data';
    const FIELD_DATE_CREATED            = 'dateCreated';

    /**
     * @var null|array An array of names of the post categories. Each item is a string or array. If the item is a
     *                 string, then it is one of the main categories of the post. If it is an array, it represents
     *                 a category hierarchy. Each previous category name in the array is the parent category name of the
     *                 item. E.g. ['cat1', 'cat2', 'cat3'] represents 'cat1 > cat2 > cat3' hierarchy.
     */
    private $categoryNames;

    /** @var bool */
    private $paginate;

    /** @var string */
    private $nextPageUrl;

    /** @var array */
    private $allPageUrls;

    /*
     *
     */

    /** @var string */
    private $title;

    /** @var array */
    private $excerpt;

    /** @var array */
    private $contents;

    /** @var DateTime|null */
    private $dateCreated = null;

    /** @var array */
    private $shortCodeData;

    /** @var array */
    private $tags;

    /** @var string[]|null */
    private $preparedTags;

    /** @var string */
    private $slug;

    /** @var int|null */
    private $authorId;

    /** @var string|null */
    private $postStatus;

    /*
     * LIST
     */

    /** @var int */
    private $listStartPos;

    /** @var array */
    private $listNumbers;

    /** @var array */
    private $listTitles;

    /** @var array */
    private $listContents;

    /*
     * META
     */

    /** @var string */
    private $metaKeywords;

    /** @var array */
    private $metaKeywordsAsTags;

    /** @var string */
    private $metaDescription;

    /*
     *
     */

    /** @var null|MediaFile */
    private $thumbnailData;

    /** @var MediaFile[] */
    private $attachmentData = [];

    /*
     *
     */

    /** @var PostMeta[]|null */
    private $customMeta;

    /** @var TaxonomyItem[]|null */
    private $customTaxonomies;

    /** @var string */
    private $template;

    /*
     *
     */

    /** @var array WordPress post data */
    private $wpPostData = [];

    /*
     *
     */

    /** @var TransformableFieldList */
    private $transformableFields = null;

    /** @var TransformableFieldList */
    private $interactableFields = null;

    /** @var TransformableFieldList|null */
    private $conditionCommandFields = null;

    /** @var TransformableFieldList|null */
    private $actionCommandFields = null;

    /*
     * GETTERS AND SETTERS
     */

    /**
     * @return array|null See {@link $categoryNames}
     */
    public function getCategoryNames() {
        return $this->categoryNames;
    }

    /**
     * @param array|null $categoryNames See {@link $categoryNames}
     */
    public function setCategoryNames($categoryNames) {
        $this->categoryNames = $categoryNames;
    }

    /**
     * @return boolean
     */
    public function isPaginate() {
        return $this->paginate;
    }

    /**
     * @param boolean $paginate
     */
    public function setPaginate($paginate) {
        $this->paginate = $paginate;
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

    /**
     * @return array
     */
    public function getAllPageUrls() {
        return $this->allPageUrls;
    }

    /**
     * @param array $allPageUrls
     */
    public function setAllPageUrls($allPageUrls) {
        $this->allPageUrls = $allPageUrls;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getExcerpt() {
        return $this->excerpt;
    }

    /**
     * @param array $excerpt See {@link excerpt}
     */
    public function setExcerpt($excerpt) {
        $this->excerpt = $excerpt;
    }

    /**
     * @return array
     */
    public function getContents() {
        return $this->contents;
    }

    /**
     * @param array $contents
     */
    public function setContents($contents) {
        $this->contents = $contents;
    }

    /**
     * @param bool $asString If this is true, the date is returned as a string in the MySQL date format. Otherwise,
     *                       a {@link DateTime} object is returned.
     * @return string|DateTime
     */
    public function getDateCreated($asString = false) {
        // The created date will not consider GMT offset defined in WP settings. So, the date must have been already
        // set. Otherwise, we probably create an inaccurate date here.
        if ($this->dateCreated === null) $this->dateCreated = new DateTime();
        return $asString
            ? $this->dateCreated->format(Environment::mysqlDateFormat())
            : $this->dateCreated;
    }

    /**
     * @param DateTime|null $dateCreated The post creation date
     */
    public function setDateCreated(?DateTime $dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return array
     */
    public function getShortCodeData() {
        return $this->shortCodeData;
    }

    /**
     * @param array $shortCodeData
     */
    public function setShortCodeData($shortCodeData) {
        $this->shortCodeData = $shortCodeData;
    }

    /**
     * @return array
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * @param string[]|null $tags
     */
    public function setTags($tags) {
        $this->tags = $tags;
    }

    /**
     * @return string[]|null
     */
    public function getPreparedTags() {
        return $this->preparedTags;
    }

    /**
     * @param array $preparedTags
     */
    public function setPreparedTags($preparedTags) {
        $this->preparedTags = $preparedTags;
    }

    /**
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug) {
        $this->slug = $slug;
    }

    /**
     * @return int|null
     * @since 1.11.0
     */
    public function getAuthorId(): ?int {
        return $this->authorId;
    }

    /**
     * @param int|null $authorId
     * @since 1.11.0
     */
    public function setAuthorId(?int $authorId) {
        $this->authorId = $authorId;
    }

    /**
     * @return string|null
     * @since 1.11.0
     */
    public function getPostStatus(): ?string {
        return $this->postStatus;
    }

    /**
     * @param string|null $postStatus
     * @since 1.11.0
     */
    public function setPostStatus(?string $postStatus) {
        $this->postStatus = $postStatus;
    }

    /**
     * @return int
     */
    public function getListStartPos() {
        return $this->listStartPos;
    }

    /**
     * @param int $listStartPos
     */
    public function setListStartPos($listStartPos) {
        $this->listStartPos = $listStartPos;
    }

    /**
     * @return array
     */
    public function getListNumbers() {
        return $this->listNumbers;
    }

    /**
     * @param array $listNumbers
     */
    public function setListNumbers($listNumbers) {
        $this->listNumbers = $listNumbers;
    }

    /**
     * @return array
     */
    public function getListTitles() {
        return $this->listTitles;
    }

    /**
     * @param array $listTitles
     */
    public function setListTitles($listTitles) {
        $this->listTitles = $listTitles;
    }

    /**
     * @return array
     */
    public function getListContents() {
        return $this->listContents;
    }

    /**
     * @param array $listContents
     */
    public function setListContents($listContents) {
        $this->listContents = $listContents;
    }

    /**
     * @return string
     */
    public function getMetaKeywords() {
        return $this->metaKeywords;
    }

    /**
     * @param string $metaKeywords
     */
    public function setMetaKeywords($metaKeywords) {
        $this->metaKeywords = $metaKeywords;
    }

    /**
     * @return array
     */
    public function getMetaKeywordsAsTags() {
        return $this->metaKeywordsAsTags;
    }

    /**
     * @param array $metaKeywordsAsTags
     */
    public function setMetaKeywordsAsTags($metaKeywordsAsTags) {
        $this->metaKeywordsAsTags = $metaKeywordsAsTags;
    }

    /**
     * @return string
     */
    public function getMetaDescription() {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription) {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return MediaFile|null
     */
    public function getThumbnailData() {
        return $this->thumbnailData;
    }

    /**
     * @param MediaFile $mediaFile
     */
    public function setThumbnailData($mediaFile) {
        $this->thumbnailData = $mediaFile;
    }

    /**
     * @return MediaFile[]
     */
    public function getAttachmentData() {
        return $this->attachmentData;
    }

    /**
     * @param MediaFile[] $attachmentData
     */
    public function setAttachmentData($attachmentData) {
        $this->attachmentData = $attachmentData ?: [];
    }

    /**
     * Deletes previously saved attachments.
     */
    public function deleteAttachments() {
        if(!$this->getAttachmentData()) return;

        foreach($this->getAttachmentData() as $mediaFile) {
            Utils::deleteFile($mediaFile->getLocalPath());

            // If the media file has an ID, delete the attachment with that ID.
            if ($mediaFile->getMediaId()) {
                wp_delete_attachment($mediaFile->getMediaId(), true);
            }
        }
    }

    /**
     * @return PostMeta[]|null
     */
    public function getCustomMeta(): ?array {
        return $this->customMeta;
    }

    /**
     * @param PostMeta[]|null $customMeta See {@link customMeta}
     */
    public function setCustomMeta(?array $customMeta) {
        $this->customMeta = $customMeta;
    }

    /**
     * @return TaxonomyItem[]|null
     */
    public function getCustomTaxonomies(): ?array {
        return $this->customTaxonomies;
    }

    /**
     * @param TaxonomyItem[]|null $customTaxonomies
     */
    public function setCustomTaxonomies(?array $customTaxonomies) {
        $this->customTaxonomies = $customTaxonomies;
    }

    /**
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template) {
        $this->template = $template;
    }

    /**
     * @return array
     */
    public function getWpPostData() {
        return $this->wpPostData;
    }

    /**
     * @param array $wpPostData
     */
    public function setWpPostData($wpPostData) {
        $this->wpPostData = $wpPostData;
    }

    /**
     * Get all media files, which contain attachment media files and the thumbnail media file.
     *
     * @return MediaFile[]
     * @since 1.8.0
     */
    public function getAllMediaFiles() {
        $mediaFiles = $this->getAttachmentData();
        if ($this->getThumbnailData()) $mediaFiles[] = $this->getThumbnailData();
        return $mediaFiles;
    }

    public function getTransformableFields(): TransformableFieldList {
        if ($this->transformableFields === null) {
            $this->transformableFields = new TransformableFieldList([
                new TransformableField(static::FIELD_TITLE,                  _wpcc('Title'),                    ValueType::T_STRING),
                new TransformableField(static::FIELD_EXCERPT,                _wpcc('Excerpt'),                  ValueType::T_STRING),
                new TransformableField(static::FIELD_CATEGORY_NAMES,         _wpcc('Category Names'),           [ValueType::T_STRING, ValueType::T_COUNTABLE]),
                new TransformableField(static::FIELD_SLUG,                   _wpcc('Slug'),                     ValueType::T_STRING),
                new TransformableField(static::FIELD_TEMPLATE,               _wpcc('Content'),                  ValueType::T_STRING),
                new TransformableField(static::FIELD_PREPARED_TAGS,          _wpcc('Tags'),                     [ValueType::T_STRING, ValueType::T_COUNTABLE]),
                new TransformableField(static::FIELD_META_KEYWORDS,          _wpcc('Meta Keywords'),            ValueType::T_STRING),
                new TransformableField(static::FIELD_META_DESCRIPTION,       _wpcc('Meta Description'),         ValueType::T_STRING),
                new TransformableField(static::FIELD_CUSTOM_META,            _wpcc('Custom Meta'),              [ValueType::T_STRING, ValueType::T_COUNTABLE]),
                new TransformableField(static::FIELD_ATTACHMENT_TITLE,       _wpcc('Media Title'),              [ValueType::T_STRING, ValueType::T_COUNTABLE]),
                new TransformableField(static::FIELD_ATTACHMENT_DESCRIPTION, _wpcc('Media Description'),        [ValueType::T_STRING, ValueType::T_COUNTABLE]),
                new TransformableField(static::FIELD_ATTACHMENT_CAPTION,     _wpcc('Media Caption'),            [ValueType::T_STRING, ValueType::T_COUNTABLE]),
                new TransformableField(static::FIELD_ATTACHMENT_ALT,         _wpcc('Media Alternate Text'),     [ValueType::T_STRING, ValueType::T_COUNTABLE]),
                new TransformableField(static::FIELD_THUMBNAIL_TITLE,        _wpcc('Thumbnail Title'),          ValueType::T_STRING),
                new TransformableField(static::FIELD_THUMBNAIL_DESCRIPTION,  _wpcc('Thumbnail Description'),    ValueType::T_STRING),
                new TransformableField(static::FIELD_THUMBNAIL_CAPTION,      _wpcc('Thumbnail Caption'),        ValueType::T_STRING),
                new TransformableField(static::FIELD_THUMBNAIL_ALT,          _wpcc('Thumbnail Alternate Text'), ValueType::T_STRING),
                new TransformableField(static::FIELD_CUSTOM_TAXONOMIES,      _wpcc('Taxonomies'),               [ValueType::T_STRING, ValueType::T_COUNTABLE]),
            ], new FieldConfig(EventGroupKey::POST_DATA));
        }

        return $this->transformableFields;
    }

    public function getInteractableFields(): TransformableFieldList {
        if ($this->interactableFields === null) {
            $this->interactableFields = (new TransformableFieldList(null, new FieldConfig(EventGroupKey::POST_DATA)))
                ->addAllFromList($this->getTransformableFields())
                ->addAll([
                    new TransformableField(static::FIELD_NEXT_PAGE_URL,   _wpcc('Next Page URL'),      ValueType::T_STRING),
                    new TransformableField(static::FIELD_ALL_PAGE_URLS,   _wpcc('All Page URLs'),      [ValueType::T_STRING, ValueType::T_COUNTABLE]),
                    new TransformableField(static::FIELD_SHORT_CODE_DATA, _wpcc('Custom Short Codes'), [ValueType::T_STRING, ValueType::T_COUNTABLE]),
                ]);
        }

        return $this->interactableFields;
    }

    public function getConditionCommandFields(): ?TransformableFieldList {
        if ($this->conditionCommandFields === null) {
            $this->conditionCommandFields = (new TransformableFieldList(null, new FieldConfig(EventGroupKey::POST_DATA)))
                ->addAll([
                    // TODO: This is actually not useful. Either provide a full suit of conditions and actions for both
                    //  MediaFile class and MediaFile array or remove this.
                    (new SpecialTransformableField(static::FIELD_ATTACHMENT, _wpcc('Media Files'), ValueType::T_COUNTABLE))
                        // Modify the extractor options. We do not want to allow everything. We want to allow objects
                        // only. If everything is allowed, subject items contain only 1 key that has an array value. We
                        // want as many keys as there are media files. In other words, the resultant array must contain
                        // all media files as its direct values.
                        ->setModifyExtractorOptionsCallback(function(ValueExtractorOptions $options) {
                            $options
                                ->setAllowAll(false)
                                ->setAllowObjects(true);
                        }),

                    // TODO: Add publish date to action command fields as well and add action commands to let the user
                    //  modify the date conditionally.
                    (new DateTimeTransformableField(static::FIELD_DATE_CREATED, _wpcc('Publish Date'), ValueType::T_DATE))
                ]);
        }

        return $this->conditionCommandFields;
    }

    public function getActionCommandFields(): ?TransformableFieldList {
        return $this->actionCommandFields;
    }

}