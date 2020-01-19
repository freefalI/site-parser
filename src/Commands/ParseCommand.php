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
use SiteParser\Scrappers\LinkScraper;
use SiteParser\ValueObjects\Link;

class ParseCommand extends Command
{
    /**
     * @var Link
     */
    private $url;

    /**
     * ParseCommand constructor.
     * @param string $link
     * @throws \ErrorException
     */
    public function __construct($link)
    {
        $link = new Link('my_link');
        $this->url = $link;
        $this->execute();
    }

    function execute()
    {

        $parserManager = new ParseManager();
        $parserManager->setScrapper(new LinkScraper());
        $parserManager->setScrapper(new ImageScraper());
        $parserManager->registerHandler(new SaveToFileHandler());
        $parserManager->registerHandler(new CountImagesHandler());

        $parserManager->parse();
    }


    function validate()
    {
        // TODO: Implement validate() method.
    }
}