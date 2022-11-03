<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 26/10/2018
 * Time: 10:16
 */

namespace WPCCrawler\Test\General;


use Illuminate\Contracts\View\View;
use WPCCrawler\Objects\Crawling\Bot\CategoryBot;
use WPCCrawler\Objects\Crawling\Data\CategoryData;
use WPCCrawler\Test\Base\AbstractGeneralTest;
use WPCCrawler\Test\Data\GeneralTestData;
use WPCCrawler\Utils;

class GeneralCategoryTest extends AbstractGeneralTest {

    /** @var CategoryData */
    private $categoryData;
    private $template;

    /**
     * Conduct the test and return an array of results.
     *
     * @param GeneralTestData $data
     */
    protected function createResults($data) {
        $categoryData = new CategoryData();
        $template = false;

        if(!empty($data->getTestUrl())) {
            $bot = new CategoryBot($data->getSettings(), $data->getSiteId());

            if($categoryData = $bot->collectUrls(Utils::prepareUrl($bot->getSiteUrl(), $data->getTestUrl()))) {
                $template = Utils::view('site-tester/category-test')->with([
                    'nextPageUrl'   =>  $categoryData->getNextPageUrl(),
                    'urls'          =>  $categoryData->getPostUrlList()->toArray()
                ])->render();
            }
        }

        $this->categoryData = $categoryData;
        $this->template     = $template;

        $this->addNextPageUrlInfo($this->categoryData);
    }

    /**
     * Create a view from the results found in {@link createResults} method.
     *
     * @return View|null
     */
    protected function createView() {
        return Utils::view('site-tester/test-results')->with([
            'info'      =>  $this->getInfo(),
            'data'      =>  (array) $this->categoryData,
            'template'  =>  $this->template
        ]);
    }

}