<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 17-7-2016
 * Time: 02:14
 */

namespace Dizzy\Trakt\Contracts;

/**
 * Interface EndpointInterface
 * @package Dizzy\Trakt\Contracts
 */
interface EndpointInterface
{
    /**
     * Sets the requested page.
     * @param int $page
     * @return $this
     */
    public function page($page);

    /**
     * Sets the limit of results.
     * @param int $limit
     * @return $this
     */
    public function limit($limit);

    /**
     * Extends the request with images.
     * @return $this
     */
    public function withImages();

    /**
     * Extends the request with full.
     * @return $this
     */
    public function withFull();
}