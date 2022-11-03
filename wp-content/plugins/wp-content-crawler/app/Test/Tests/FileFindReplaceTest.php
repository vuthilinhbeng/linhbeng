<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 10/12/2018
 * Time: 16:27
 *
 * @since 1.8.0
 */

namespace WPCCrawler\Test\Tests;


use Exception;
use Illuminate\Contracts\View\View;
use WPCCrawler\Objects\File\MediaFile;
use WPCCrawler\Objects\Settings\Enums\SettingInnerKey;
use WPCCrawler\Objects\Traits\FindAndReplaceTrait;
use WPCCrawler\Test\Base\AbstractFileTest;
use WPCCrawler\Test\Data\TestData;
use WPCCrawler\Utils;

class FileFindReplaceTest extends AbstractFileTest {

    use FindAndReplaceTrait;

    /** @var string */
    private $message;

    /**
     * @param TestData    $data Information required for the test
     * @param MediaFile[] $mediaFiles
     * @return array|string|mixed
     * @since 1.8.0
     */
    protected function createFileTestResults($data, $mediaFiles) {
        // Get find-replace options
        $formItemValues = $data->getFormItemValues();
        $find       = Utils::array_get($formItemValues, SettingInnerKey::FIND);
        $replace    = Utils::array_get($formItemValues, SettingInnerKey::REPLACE);
        $regex      = isset($formItemValues[SettingInnerKey::REGEX]);

        $results = [];

        // Rename each file using find-replace options
        foreach($mediaFiles as $mediaFile) {
            $name = $mediaFile->getName();
            $newName = $this->findAndReplaceSingle($find, $replace, $name, $regex);

            $mediaFile->rename($newName);

            // Add the local temporary file's URL as the result
            $results[] = $mediaFile->getLocalUrl();
        }

        $message = sprintf(
            _wpcc('Test result for find %1$s and replace with %2$s'),
            "<span class='highlight find'>" . htmlspecialchars($find) . "</span>",
            "<span class='highlight replace'>" . htmlspecialchars($replace) . "</span>"
        );

        if($regex) $message .= " " . _wpcc("(as regex)");
        $message .= ':';

        $this->message = $message;

        return $results;
    }

    /**
     * Create the view of the response
     *
     * @return View|null
     * @throws Exception
     */
    protected function createView() {
        return Utils::view('partials/test-result')
            ->with("results", $this->getResults())
            ->with("message", $this->message);
    }
}