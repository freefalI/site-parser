<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:26
 */

namespace SiteParser\Handlers;

use SiteParser\DTO\ScrapedData;

abstract class Handler
{
    /**
     * @var string
     */
    private $domain;

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @param ScrapedData[] $dtos
     * @return mixed
     */
    abstract public function handle($dtos);
}