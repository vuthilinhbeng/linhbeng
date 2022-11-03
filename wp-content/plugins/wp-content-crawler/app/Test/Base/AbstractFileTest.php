<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 12/12/2018
 * Time: 15:52
 *
 * @since 1.8.0
 */

namespace WPCCrawler\Test\Base;


use WPCCrawler\Objects\File\MediaFile;
use WPCCrawler\Test\Data\TestData;
use WPCCrawler\Test\TestService;

abstract class AbstractFileTest extends AbstractTest {

    /** @var MediaFile[] Stores the temporary media files */
    private $tempMediaFiles = [];

    /**
     * @param TestData    $data Information required for the test
     * @param MediaFile[] $mediaFiles
     * @return array|string|mixed
     * @since 1.8.0
     */
    abstract protected function createFileTestResults($data, $mediaFiles);

    /**
     * Conduct the test and return an array of results.
     *
     * @param TestData $data Information required for the test
     * @return array|string|mixed
     */
    protected function createResults($data) {
        // Here, an array of form item values and test data must exist.
        if (!$data->getFormItemValues() || !is_array($data->getFormItemValues()) || !$data->getTestData()) return null;

        // Here, we expect the test URLs to be file URLs. Create temporary media files for each file URL.
        foreach($data->getTestData() as $fileUrl) {
            $mediaFile = TestService::getInstance()->createTempMediaFileForUrl($fileUrl);
            if (!$mediaFile) continue;

            $this->tempMediaFiles[] = $mediaFile;
        }

        // If there is no media file, return an empty result.
        if (!$this->tempMediaFiles) return [];

        // Set the test data as newly-created media files so that options box applier or any other tester can use the
        // media files by retrieving them from TestData.
        $data->setTestData($this->tempMediaFiles);

        // Do the tests
        $results = $this->createFileTestResults($data, $this->tempMediaFiles);

        // After the test results have been created, delete the temporary media files.
        foreach($this->tempMediaFiles as $mediaFile) {
            $mediaFile->deleteCopyFiles();
            $mediaFile->delete();
        }

        return $results;
    }

}