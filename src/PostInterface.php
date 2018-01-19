<?php

namespace Scrapper;

use DateTimeInterface;

interface PostInterface
{
    /**
     * Get source of the post.
     *
     * @return SourceInterface
     */
    public function getSource(): SourceInterface;

    /**
     * Get date of the post.
     *
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface;

    /**
     * Get title of the post.
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get summary of the post.
     *
     * @return string|null
     */
    public function getSummary();

    /**
     * Get URL of the post.
     *
     * @return string
     */
    public function getUrl(): string;
}
