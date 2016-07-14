<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 01:19
 */

namespace Dizzy\Trakt;

use GuzzleHttp\Client;

/**
 * Class TraktHttpClient
 * @package Dizzy\Trakt\Request
 */
class TraktHttpClient
{
    const API_URL = 'https://api.trakt.tv';

    const API_VERSION = 2;

    /**
     * Creates a new Client instance of GuzzleHttp.
     *
     * @return Client
     */
    public static function make()
    {
        return new Client([
            'base_url' => [
                static::API_URL,
                [
                    'version' => static::API_VERSION
                ]
            ]
        ]);
    }
}