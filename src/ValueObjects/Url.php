<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 17:07
 */

namespace SiteParser\ValueObjects;

use ErrorException;

class Url
{
    /**
     * Url
     *
     * @var Url
     */
    private $url;

    /**
     * Url constructor.
     * @param string $url
     * @throws ErrorException
     */
    public function __construct($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new ErrorException('not valid Url');
        }
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

}
