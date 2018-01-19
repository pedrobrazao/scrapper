<?php

namespace Scrapper;

interface ScrapperServiceInterface
{
    /**
     * Get a list of all available sources.
     *
     * @param string $path
     * @return array
     */
    public function listSources(string $path = __DIR__): array;

    /**
     * Load a single source.
     *
     * @param \Scrapper\SourceInterface $source
     * @return array
     */
    public function loadSource(SourceInterface $source): array;

    /**
     * Parse a single URL under a given source and return a PostInterface instance.
     *
     * @param \Scrapper\SourceInterface $source
     * @param string $url
     * @return \Scrapper\PostInterface
     */
    public function parseUrl(SourceInterface $source, string $url): PostInterface;
}
