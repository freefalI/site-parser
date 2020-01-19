<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 15:52
 */

namespace SiteParser\Commands;

use SiteParser\Handlers\CountImagesHandler;
use SiteParser\Handlers\SaveToFileHandler;
use SiteParser\ParseManager;
use SiteParser\Scrappers\ImageScraper;
use SiteParser\Scrappers\UrlScraper;
use SiteParser\ValueObjects\Url;

class ParseCommand extends Command
{
    /**
     * @var Url
     */
    private $url;

    /**
     * ParseCommand constructor.
     * @param string $url
     * @throws \ErrorException
     */
    public function __construct($url)
    {
        $url = new Url('my_url');
        $this->url = $url;
        $this->execute();
    }

    function execute()
    {

        $parserManager = new ParseManager();
        $parserManager->setUrlScrapper(new UrlScraper());
        $parserManager->setImageScrapper(new ImageScraper());
        $parserManager->registerHandler(new SaveToFileHandler());
        $parserManager->registerHandler(new CountImagesHandler());

        $parserManager->parse($this->url);
    }


    function validate()
    {
        // TODO: Implement validate() method.
    }
}