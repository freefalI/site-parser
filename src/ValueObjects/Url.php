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
     * @var string
     */
    private $url;
    /**
     * http or https
     * @var string
     */
    private $scheme;
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $port;
    /**
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $pass;
    /**
     * @var string
     */
    private $path;
    /**
     * Agfter ?
     * @var string
     */
    private $query;
    /**
     * After #
     * @var string
     */
    private $fragment;

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
        $parsedUrl = parse_url($url);
        foreach ($parsedUrl as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getFragment(): string
    {
        return $this->fragment;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->url;
    }

}
