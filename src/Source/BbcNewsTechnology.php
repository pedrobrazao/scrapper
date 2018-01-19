<?php

namespace Scrapper\Source;

use Scrapper\AbstractSource;
use Scrapper\Post;
use Scrapper\PostInterface;
use Scrapper\SourceInterface;
use Zend\Feed\Reader\Reader;

class BbcNewsTechnology extends AbstractSource implements SourceInterface
{

    const NAME = 'BbcNewsTechnology';
    const URL = 'http://feeds.bbci.co.uk/news/technology/rss.xml';

    /**
     * Load the source and return array of URLs.
     *
     * @return array
     */
    public function load(): array
    {
        $result = Reader::import($this->getUrl());

        $urls = [];

        /* @entry \Zend\Feed\Reader\Entry\Rss */
        foreach ($result as $entry) {
            $urls[] = $entry->getLink();
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
