<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 26/10/2018
 * Time: 10:43
 */

namespace WPCCrawler\Test\General;


use Exception;
use Illuminate\Contracts\View\View;
use WPCCrawler\Objects\Crawling\Bot\PostBot;
use WPCCrawler\Objects\Crawling\Data\PostData;
use WPCCrawler\Objects\Crawling\Data\PostSaverData;
use WPCCrawler\PostDetail\PostDetailsService;
use WPCCrawler\Objects\File\MediaFile;
use WPCCrawler\Test\Base\AbstractGeneralTest;
use WPCCrawler\Test\Data\GeneralTestData;
use WPCCrawler\Test\Enums\TestType;
use WPCCrawler\Utils;

class GeneralPostTest extends AbstractGeneralTest {

    /** @var PostBot */
    private $postBot;

    /** @var string */
    private $template;

    /** @var PostData */
    private $postData;

    /**
     * Conduct the test and return an array of results.
     *
     * @param GeneralTestData $data
     * @throws Exception
     */
    protected function createResults($data) {
        $postData = new PostData();

        // PREPARE THE URL AND GET THE POST
        $template = '';
        if (!empty($data->getTestUrl())) {
            $bot = new PostBot($data->getSettings(), $data->getSiteId());

            $preparedUrl = Utils::prepareUrl($bot->getSiteUrl(), $data->getTestUrl());
            $saverData = new PostSaverData($bot, false, true);
            if ($postData = $bot->crawlPost($preparedUrl, $saverData)) {
                $template = $postData->getTemplate();

                // If there are errors, add them to info.
                if ($errorDescriptions = $bot->getDescriptionsWithErrorValues()) {
                    $this->addInfo(_wpcc('Errors'), $errorDescriptions);
                }
            }

            $this->postBot = $bot;
        }

        $this->template = $template;
        $this->postData = $postData;

        $this->addPredefinedInfos();
    }

    /**
     * Create a view from the results found in {@link createResults} method.
     *
     * @return View|null
     */
    protected function createView() {
        $viewVars = [
            'template'          => $this->template,
            'info'              => $this->getInfo(),
            'data'              => (array)$this->postData,
            'showSourceCode'    => true,
            'templateMessage'   => _wpcc('Styling can be different on front page depending on your theme.')
        ];

        // Add views defined for the custom post details
        if ($this->postData) {
            $viewVars['postDetailViews'] = PostDetailsService::getInstance()->getTestViews($this->postBot, $this->postData, $viewVars);
        }

        return Utils::view('site-tester/test-results')->with($viewVars);
    }

    /*
     * PRIVATE METHODS
     */

    /**
     * Prepares and sets the test info using predefined infos
     */
    private function addPredefinedInfos() {
        if (!$this->postData) return;

        $this->addNextPageUrlInfo($this->postData);
        $this->setAllPagesInfo();
        $this->addInfo(_wpcc("Title"),      $this->postData->getTitle(),    true);

        $this->addInfo(_wpcc("Slug"),       $this->postData->getSlug(),     true);

        $this->addInfo(_wpcc('Categories'), $this->getCategoryNames(),      true);

        if ($date = $this->postData->getDateCreated(true)) {
            $this->addInfo(_wpcc("Date"), Utils::getDateFormatted($date) . " ({$date})");
        }

        $this->addInfo(_wpcc("Meta Keywords"),          $this->postData->getMetaKeywords(),         true);
        $this->addInfo(_wpcc("Meta Keywords As Tags"),  $this->postData->getMetaKeywordsAsTags(),   true);
        $this->addInfo(_wpcc("Meta Description"),       $this->postData->getMetaDescription(),      true);

        if ($this->postData->getExcerpt() && $excerpt = $this->postData->getExcerpt()["data"]) {
            $this->addInfo(_wpcc("Excerpt"), $excerpt);
        }

        $this->addInfo(_wpcc("Tags"), $this->postData->getTags(), true);
        $this->addInfo(_wpcc("Prepared Post Tags"), $this->postData->getPreparedTags(), true);

        $this->setCustomMetaInfo();
        $this->setCustomTaxonomyInfo();
        $this->setThumbnailInfo();
        $this->setAttachmentInfo();
    }

    /**
     * Sets the custom meta info
     */
    private function setCustomMetaInfo() {
        $customPostMeta = $this->postData->getCustomMeta();
        if (!$customPostMeta) return;

        $preparedCustomPostMeta = [];

        foreach ($customPostMeta as $item) {
            $preparedCustomPostMeta[] = Utils::view('site-tester.partial.custom-post-meta-item')->with([
                'item' => $item
            ])->render();
        }

        $this->addInfo(_wpcc("Custom Post Meta"), $preparedCustomPostMeta);
    }

    /**
     * Sets the custom taxonomy info
     */
    private function setCustomTaxonomyInfo() {
        $customPostTaxonomies = $this->postData->getCustomTaxonomies();
        if (!$customPostTaxonomies) return;

        $preparedCustomPostTaxonomies = [];

        foreach ($customPostTaxonomies as $item) {
            $preparedCustomPostTaxonomies[] = Utils::view('site-tester.partial.custom-post-taxonomy-item')->with([
                'item' => $item
            ])->render();
        }

        $this->addInfo(_wpcc("Custom Post Taxonomies"), $preparedCustomPostTaxonomies);
    }

    /**
     * Sets the thumbnail info
     */
    private function setThumbnailInfo() {
        // Show featured image link as a real link, and add a preview to be displayed in tooltip.
        if ($mediaFile = $this->postData->getThumbnailData())
            $this->addInfo(_wpcc("Featured Image"),
                Utils::view('site-tester.partial.attachment-item')->with([
                    'item'      => $mediaFile,
                    'tooltip'   => true
                ])->render()
            );
    }

    /**
     * Sets the attachment info
     */
    private function setAttachmentInfo() {
        // Get the attachments
        $attachmentData = $this->postData->getAttachmentData();

        // Stop if there are none.
        if (!$attachmentData) return;

        // Show attachment links as real links. Add a preview tooltip if the attachment is an image.
        $attachmentData = array_map(function ($mediaFile) {
            /** @var MediaFile $mediaFile */
            $tooltip = preg_match('/\.(jpg|JPG|png|PNG|gif|GIF|jpeg|JPEG)/', $mediaFile->getLocalUrl()) ? true : false;

            return Utils::view('site-tester.partial.attachment-item')->with([
                'item'      => $mediaFile,
                'tooltip'   => $tooltip
            ])->render();

        }, $attachmentData);

        $this->addInfo(_wpcc("Attachments"), $attachmentData);
    }

    /**
     * Sets "all pages" info
     */
    private function setAllPagesInfo() {
        // Show all next page URLs as a list with test buttons, so that the user can just click the button to test the next page.
        if ($allPageUrls = $this->postData->getAllPageUrls()) {
            $this->addInfo(
                _wpcc("Next Page URLs"),
                Utils::view('site-tester/urls-with-test')->with([
                    'urls'           => $allPageUrls,
                    'testType'       => TestType::POST,
                    'hideThumbnails' => true
                ])->render()
            );
        }
    }

    /**
     * Prepares category names for presentation.
     *
     * @return array|null
     * @since 1.8.0
     */
    private function getCategoryNames() {
        if (!$this->postData->getCategoryNames()) return null;

        return array_map(function($v) {
            if (!$v) return null;
            if (!is_array($v)) $v = [$v];

            $v = array_map(function($category) {
                return sprintf('<span class="category">%1$s</span>', $category);
            }, $v);

            return $v ? implode('<span class="category-separator">›</span>', $v) : null;
        }, $this->postData->getCategoryNames());
    }

}