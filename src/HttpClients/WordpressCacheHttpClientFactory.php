<?php

namespace FourOver\HttpClients;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Kevinrob\GuzzleCache\Storage\WordPressObjectCacheStorage;

class WordpressCacheHttpClientFactory
{
    /**
     * Returns GuzzleHttp\Client that supports Wordpress cache
     *
     * @return \Psr\Http\Client\ClientInterface
     */
    public static function get() : \Psr\Http\Client\ClientInterface
    {
        $stack = HandlerStack::create();

        $stack->push(
            new CacheMiddleware(
                new PrivateCacheStrategy(
                    new WordPressObjectCacheStorage()
                )
            ),
            'cache'
        );

        return new Client(['handler' => $stack]);
    }
}