<?php

namespace Scrapper;

use Goutte\Client as GoutteClient;
use GuzzleHttp\Client as GuzzleClient;
use Zend\Feed\Reader\Reader as ZendReader;

abstract class AbstractSource
{

    /**
     * Get name of the source.
     *
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * Get URL where source is located.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return static::URL;
    }

    /**
     * Get Guzzle client.
     *
     * @param array $config
     * @return GuzzleClient
     */
    public function getGuzzleClient(array $config = []): GuzzleClient
    {
        return new GuzzleClient($config);
    }

    /**
     * Get Goutte client.
     *
     * @param GuzzleClient $guzzle
     * @return GoutteClient
     */
    public function getGoutteClient(GuzzleClient $guzzle = null): GoutteClient
    {
        $goutte = new GoutteClient();

        // allow configured Guzzle client
        if (null !== $guzzle) {
            $goutte->setClient($guzzle);
        }

        return $goutte;
    }

    /**
     * Get Zend RSS Reader.
     *
     * @return ZendReader
     */
    public function getZendReader(): ZendReader
    {
        return new ZendReader();
    }
}
