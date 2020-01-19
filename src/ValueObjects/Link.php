<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 17:07
 */

namespace SiteParser\ValueObjects;

use ErrorException;

class Link
{
    /**
     * Link
     *
     * @var Link
     */
    private $link;

    /**
     * Link constructor.
     * @param string $link
     * @throws ErrorException
     */
    public function __construct($link)
    {
        if (!filter_var($link, FILTER_VALIDATE_URL)) {
            throw new ErrorException('not valid link');
        }
        $this->link = $link;
    }

    /**
     * @return Link
     */
    public function getLink()
    {
        return $this->link;
    }

}
