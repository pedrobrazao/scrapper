<?php

namespace Scrapper\Source;

use Scrapper\AbstractSource;
use Scrapper\Post;
use Scrapper\PostInterface;
use Scrapper\SourceInterface;

class Slashdot extends AbstractSource implements SourceInterface
{

    const NAME = 'Slashdot';
    const URL = 'https://slashdot.org/';

    /**
     * Load the source and return array of URLs.
     *
     * @return array
     */
    public function load(): array
    {
        $result = $this->getGoutteClient()->request('GET', $this->getUrl());
        $urls = [];

        /* @var $a \DOMElement */
        foreach ($result->filter('span.story-title a') as $i => $a) {
            $urls[] = $a->attributes->getNamedItem('href')->nodeValue;
        }

        return $urls;
    }

    /**
     * Parse a given URL contents into a Post instance.
     *
     * @param string $url
     * @return PostInterface
     */
    public function parse(string $url): PostInterface
    {
        throw new RuntimeException('Not implemented.');
    }
}
