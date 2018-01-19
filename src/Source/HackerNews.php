<?php

namespace Scrapper\Source;

use DateTime;
use RuntimeException;
use Scrapper\AbstractSource;
use Scrapper\PostInterface;
use Scrapper\SourceInterface;

class HackerNews extends AbstractSource implements SourceInterface
{

    const NAME = 'Hacker News';
    const URL = 'https://hacker-news.firebaseio.com/v0/topstories.json';

    /**
     * Load the source and return array of URLs.
     *
     * @return array
     */
    public function load(): array
    {
        $result = $this->getGuzzleClient()->get($this->getUrl());
        $json = $result->getBody()->getContents();

        if (false === $data = json_decode($json)) {
            throw new RuntimeException('Invalid JSON from ' . $this->getUrl());
        }

        $urls = [];

        foreach ($data as $id) {
            $urls[] = sprintf('https://hacker-news.firebaseio.com/v0/item/%d.json', $id);
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
        $result = $this->getGuzzleClient()->get($url);
        $json = $result->getBody()->getContents();

        if (false === $data = json_decode($json)) {
            throw new RuntimeException('Invalid JSON from ' . $this->getUrl());
        }

        if (false === isset($data->time)) {
            throw new RuntimeException('Missing "time" on URL: ' . $url);
        }

        if (false === isset($data->title)) {
            throw new RuntimeException('Missing "title" on URL: ' . $url);
        }

        $title = $data->title;
        $date = (new DateTime())->setTimestamp($data->time);
        $summary = true === isset($data->url) ? $data->url : null;

        return new \Scrapper\Post($this, $date, $title, $url, $summary);
    }
}
