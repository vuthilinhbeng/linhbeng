<?php
/**
 * Created by PhpStorm.
 * User: tsaricam
 * Date: 14/11/2020
 * Time: 21:08
 *
 * @since 1.11.0
 */

namespace WPCCrawler\Objects\Database;


use DateTime;
use WPCCrawler\Environment;

class UrlTuple {

    /** @var int ID of the URL tuple */
    private $id;

    /** @var int ID of the site-type post that stores the site settings */
    private $siteId;

    /** @var string URL of the target post */
    private $url;

    /** @var string|null URL of the post's thumbnail image, retrieved from the target site, i.e. not a local URL */
    private $thumbnailUrl;

    /** @var int ID of a category created in WordPress. The post is intended to be saved into this category. */
    private $categoryId;

    /** @var bool True if the URL tuple's "is_saved" column is true */
    private $saved;

    /** @var int|null ID of the WordPress created by crawling this URL tuple */
    private $savedPostId;

    /** @var int Number of times this URL is crawled and its WordPress post is updated */
    private $updateCount;

    /** @var bool True if this URL is currently being processed. Otherwise, false. */
    private $locked;

    /** @var DateTime|null The date and time this URL tuple was created */
    private $createdAt;

    /** @var DateTime|null The date and time this URL tuple was last updated */
    private $updatedAt;

    /** @var DateTime|null The date and time this URL was crawled */
    private $savedAt;

    /** @var DateTime|null The date and time this URL's WordPress post was last updated */
    private $recrawledAt;

    /** @var DateTime|null The date and time this URL's WordPress post was deleted */
    private $deletedAt;

    /**
     *
     * @param object $urlTuple A URL tuple retrieved from the database. All the columns must exist.
     * @since 1.11.0
     */
    public function __construct(object $urlTuple) {
        $this->fill($urlTuple);
    }

    /**
     * Fill this object's fields from a URL tuple retrieved from the database. This updates all the available fields of
     * this object from the information available in the given URL tuple object.
     *
     * @param object $urlTuple A URL tuple retrieved from the database
     * @since 1.11.0
     */
    public function fill(object $urlTuple) {
        $this->id           = (int) $urlTuple->id;
        $this->siteId       = (int) $urlTuple->post_id;
        $this->url          = $urlTuple->url;
        $this->thumbnailUrl = $urlTuple->thumbnail_url ?: null;
        $this->categoryId   = (int) $urlTuple->category_id;
        $this->saved        = $urlTuple->is_saved ? true : false;
        $this->savedPostId  = $urlTuple->saved_post_id ? (int) $urlTuple->saved_post_id : null;
        $this->updateCount  = (int) $urlTuple->update_count;
        $this->locked       = $urlTuple->is_locked ? true : false;
        $this->createdAt    = $this->createDateTime($urlTuple->created_at);
        $this->updatedAt    = $this->createDateTime($urlTuple->updated_at);
        $this->savedAt      = $this->createDateTime($urlTuple->saved_at);
        $this->recrawledAt  = $this->createDateTime($urlTuple->recrawled_at);
        $this->deletedAt    = $this->createDateTime($urlTuple->deleted_at);
    }

    /**
     * @return int See {@link id}
     * @since 1.11.0
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return int See {@link siteId}
     * @since 1.11.0
     */
    public function getSiteId(): int {
        return $this->siteId;
    }

    /**
     * @return string See {@link url}
     * @since 1.11.0
     */
    public function getUrl(): string {
        return $this->url;
    }

    /**
     * @return string|null See {@link thumbnailUrl}
     * @since 1.11.0
     */
    public function getThumbnailUrl(): ?string {
        return $this->thumbnailUrl;
    }

    /**
     * @return int See {@link categoryId}
     * @since 1.11.0
     */
    public function getCategoryId(): int {
        return $this->categoryId;
    }

    /**
     * @return bool See {@link saved}
     * @since 1.11.0
     */
    public function isSaved(): bool {
        return $this->saved;
    }

    /**
     * @return int|null See {@link savedPostId}
     * @since 1.11.0
     */
    public function getSavedPostId(): ?int {
        return $this->savedPostId;
    }

    /**
     * @return int See {@link updateCount}
     * @since 1.11.0
     */
    public function getUpdateCount(): int {
        return $this->updateCount;
    }

    /**
     * @return bool See {@link locked}
     * @since 1.11.0
     */
    public function isLocked(): bool {
        return $this->locked;
    }

    /**
     * @return DateTime|null See {@link createdAt}
     * @since 1.11.0
     */
    public function getCreatedAt(): ?DateTime {
        return $this->createdAt;
    }

    /**
     * @return DateTime|null See {@link updatedAt}
     * @since 1.11.0
     */
    public function getUpdatedAt(): ?DateTime {
        return $this->updatedAt;
    }

    /**
     * @return DateTime|null See {@link savedAt}
     * @since 1.11.0
     */
    public function getSavedAt(): ?DateTime {
        return $this->savedAt;
    }

    /**
     * @return DateTime|null See {@link recrawledAt}
     * @since 1.11.0
     */
    public function getRecrawledAt(): ?DateTime {
        return $this->recrawledAt;
    }

    /**
     * @return DateTime|null See {@link deletedAt}
     * @since 1.11.0
     */
    public function getDeletedAt(): ?DateTime {
        return $this->deletedAt;
    }

    /*
     * PROTECTED HELPERS
     */

    /**
     * Create a {@link DateTime} instance from a date-time string
     *
     * @param string|null $dateTime A date-time string formatted in {@link Environment::mysqlDateFormat()}
     * @return DateTime|null If a {@link DateTime} object could be created, it is returned. Otherwise, null.
     * @since 1.11.0
     */
    protected function createDateTime(?string $dateTime): ?DateTime {
        if ($dateTime === null) return null;

        $result = DateTime::createFromFormat(Environment::mysqlDateFormat(), $dateTime);
        return $result ?: null;
    }

}