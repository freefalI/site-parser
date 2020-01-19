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
use SiteParser\ValueObjects\Url;

class ParseManager
{

    /**
     * @var Scraper
     */
    private $urlScrapper;
    /**
     * @var Scraper
     */
    private $imageScrapper;
    /**
     * @var Handler[]
     */
    private $handlers;

    /**
     * @var Url[]
     */
    private $urlsToScrap;

    public function registerHandler(Handler $handler)
    {
        $this->handlers[] = $handler;
    }

    public function parse(Url $url)
    {
        $imagesDTOs = [];
        $scrapedUrls = [];
        $this->urlsToScrap[] = $url;
        while (True) {
            if (!count($this->urlsToScrap)) {
                break;
            }
            $url = array_pop($this->urlsToScrap);

            if (in_array($url, $scrapedUrls)) {
                continue;
            }

            $pageText = file_get_contents($url);
            $urls = $this->urlScrapper->run($url, $pageText);
            $images = $this->imageScrapper->run($url, $pageText);
            $imagesDTOs[] = $images;
            $scrapedUrls[] = $url;


            foreach ($urls as $url) {
//                if(!in_array($url,$this->urlsToScrap)){
                $this->urlsToScrap[] = $url;
//                }
            }
        }
        foreach ($this->handlers as $handler) {
            $handler->handle($imagesDTOs);
        }
    }

    /**
     * @return Scraper
     */
    public function getUrlScrapper()
    {
        return $this->urlScrapper;
    }

    /**
     * @param Scraper $urlScrapper
     */
    public function setUrlScrapper($urlScrapper)
    {
        $this->urlScrapper = $urlScrapper;
    }


    /**
     * @return Scraper
     */
    public function getImageScrapper()
    {
        return $this->imageScrapper;
    }

    /**
     * @param Scraper $imageScrapper
     */
    public function setImageScrapper($imageScrapper)
    {
        $this->imageScrapper = $imageScrapper;
    }

    /**
     * @return Handler[]
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * @param Handler[] $handlers
     */
    public function setHandlers($handlers)
    {
        $this->handlers = $handlers;
    }


}