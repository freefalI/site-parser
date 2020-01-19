<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:20
 */

namespace SiteParser;

use SiteParser\Handlers\Handler;
use SiteParser\Scrappers\Scraper;

class ParseManager
{

    /**
     * @var Scraper
     */
    private $scrapper;
    /**
     * @var Handler[]
     */
    private $handlers;

    /**
     * @return Scraper
     */
    public function getScrapper()
    {
        return $this->scrapper;
    }

    /**
     * @param Scraper $scrapper
     */
    public function setScrapper($scrapper)
    {
        $this->scrapper = $scrapper;
    }

    public function registerHandler(Handler $handler)
    {
        $this->handlers[] = $handler;
    }


}