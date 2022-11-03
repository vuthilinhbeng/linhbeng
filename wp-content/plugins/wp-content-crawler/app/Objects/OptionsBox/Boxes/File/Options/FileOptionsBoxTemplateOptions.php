<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 11/12/2018
 * Time: 15:57
 *
 * @since 1.8.0
 */

namespace WPCCrawler\Objects\OptionsBox\Boxes\File\Options;


use WPCCrawler\Objects\OptionsBox\Boxes\Base\BaseOptionsBoxOptions;
use WPCCrawler\Utils;

class FileOptionsBoxTemplateOptions extends BaseOptionsBoxOptions {

    /** @var null|array */
    private $fileNameTemplates = null;

    /** @var null|array */
    private $mediaTitleTemplates = null;

    /** @var null|array */
    private $mediaDescriptionTemplates = null;

    /** @var null|array */
    private $mediaCaptionTemplates = null;

    /** @var null|array */
    private $mediaAltTemplates = null;

    protected function prepare() {
        $this->fileNameTemplates            = $this->getTemplates('templates_file_name');
        $this->mediaTitleTemplates          = $this->getTemplates('templates_media_title');
        $this->mediaDescriptionTemplates    = $this->getTemplates('templates_media_description');
        $this->mediaCaptionTemplates        = $this->getTemplates('templates_media_caption');
        $this->mediaAltTemplates            = $this->getTemplates('templates_media_alt_text');
    }

    /*
     * GETTERS
     */

    /**
     * @return array
     */
    public function getFileNameTemplates() {
        return $this->fileNameTemplates;
    }

    /**
     * @return array
     */
    public function getMediaTitleTemplates() {
        return $this->mediaTitleTemplates;
    }

    /**
     * @return array
     */
    public function getMediaDescriptionTemplates() {
        return $this->mediaDescriptionTemplates;
    }

    /**
     * @return array
     */
    public function getMediaCaptionTemplates() {
        return $this->mediaCaptionTemplates;
    }

    /**
     * @return array
     */
    public function getMediaAltTemplates() {
        return $this->mediaAltTemplates;
    }

    /*
     * PRIVATE METHODS
     */

    /**
     * Get templates for an option key.
     *
     * @param string $key Option key under which the templates are stored
     * @return array An array of strings. Each string is a template.
     * @since 1.8.0
     */
    private function getTemplates($key) {
        // Prepare templates
        return array_map(function($v) {
            return $v && isset($v['template']) && $v['template'] ? $v['template'] : null;
        }, Utils::array_get($this->getRawData(), $key, []));
    }
}