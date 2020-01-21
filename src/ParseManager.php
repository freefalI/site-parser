<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:20
 */

namespace SiteParser;

use SiteParser\DTO\ScrapedImages;
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
        $parse = parse_url($url->getUrl());
        $domain = $parse['host'];

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

//            $pageText = file_get_contents($url->getUrl());
//            $pageText = $this->getSSLPage($url->getUrl());
            $pageText = $this->get_web_page($url->getUrl());
//            $urls = $this->urlScrapper->run($url, $pageText);
            $images = $this->imageScrapper->run($url, $pageText);
            $imagesDTOs[] = $images;
            $scrapedUrls[] = $url;


//            foreach ($urls as $url) {
////                if(!in_array($url,$this->urlsToScrap)){
//                $this->urlsToScrap[] = $url;
////                }
//            }
            break;
        }
        $this->callHandlers($domain, $imagesDTOs);
    }

    /**
     * @param string $domain
     * @param ScrapedImages[] $imagesDTOs
     */
    public function callHandlers($domain, $imagesDTOs): void
    {
        foreach ($this->handlers as $handler) {
            $handler->setDomain($domain);
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

    function getSSLPage($url)
    {
        //TODO handle error
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
     * array containing the HTTP server response header fields and content.
     */
    function get_web_page($url)
    {
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST => "GET",        //set request type post or get
            CURLOPT_POST => false,        //set to GET
            CURLOPT_USERAGENT => $user_agent, //set user agent
            CURLOPT_COOKIEFILE => "cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR => "cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING => "",       // handle all encodings
            CURLOPT_AUTOREFERER => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT => 120,      // timeout on response
            CURLOPT_MAXREDIRS => 10,       // stop after 10 redirects
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $content;
    }

}