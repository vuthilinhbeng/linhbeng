<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 21/12/2018
 * Time: 11:37
 *
 * @since 1.8.0
 */

namespace WPCCrawler\Objects\Traits;


use WPCCrawler\Objects\File\FileService;

trait ShortCodeReplacerAndFindAndReplace {

    use FindAndReplaceTrait;
    use ShortCodeReplacer;

    /**
     * Replaces short codes considering the existence of a file name with a short code in it. Basically, since short
     * codes in the file name have different opening and closing brackets, in addition to replacing short codes with
     * regular opening and closing brackets, performs another replacement considering the brackets in the file name as
     * well.
     *
     * @param array        $map        See {@link ShortCodeReplacer::replaceShortCodes()}
     * @param array|string $templates  See {@link ShortCodeReplacer::replaceShortCodes()}
     * @param array        $frForMedia Find and replaces for media URLs. See
     *                                 {@link PostTemplatePreparer::applyShortCodesAndFindReplaces()}
     * @return array|string
     * @uses  ShortCodeReplacer::replaceShortCodes()
     * @uses  PostTemplatePreparer::applyShortCodesAndFindReplaces()
     * @since 1.8.0
     */
    protected function applyShortCodesConsideringFileName(&$map, $templates, $frForMedia) {
        $templates = $this->applyShortCodesAndFindReplaces($templates, $map, $frForMedia);
        $templates = $this->replaceShortCodes($map, $templates, null, FileService::SC_OPENING_BRACKETS, FileService::SC_CLOSING_BRACKETS);
        return $templates;
    }

    /**
     * Applies find-replace options to the subject and then replaces the short codes in the subject
     *
     * @param string|array $subject      See {@link FindAndReplaceTrait::applyFindAndReplaces()} and
     *                                   {@link ShortCodeReplacer::replaceShortCodes()}
     * @param array        $shortCodeMap See {@link ShortCodeReplacer::replaceShortCodes()}
     * @param array        $findReplaces See {@link FindAndReplaceTrait::applyFindAndReplaces()}
     * @param null|string  $innerKey     See {@link FindAndReplaceTrait::applyFindAndReplaces()} and
     *                                   {@link ShortCodeReplacer::replaceShortCodes()}
     * @return array|string The subject with all replacements applied
     * @uses  FindAndReplaceTrait::applyFindAndReplaces()
     * @uses  ShortCodeReplacer::replaceShortCodes()
     * @since 1.8.0
     */
    protected function applyShortCodesAndFindReplaces($subject, &$shortCodeMap, &$findReplaces, $innerKey = null) {
        return $this->replaceShortCodes($shortCodeMap,
            $this->applyFindAndReplaces($findReplaces, $subject, $innerKey),
            $innerKey
        );
    }

}