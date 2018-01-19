<?php

namespace Scrapper;

interface SourceInterface
{
    /**
     * Get name of the source.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get URL where source is located.
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Load the source and return array of URLs.
     *
     * @return array
     */
    public function load(): array;

    /**
     * Parse a given URL contents into a Post instance.
     *
     * @param string $url
     * @return PostInterface
     */
    public function parse(string $url): PostInterface;
}
