<?php

namespace Scrapper;

use DateTimeInterface;

class Post implements PostInterface
{

    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var DateTimeInterface
     */
    private $date;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $summary;

    /**
     * @var string
     */
    private $url;

    /**
     * Create new instance of Post.
     *
     * @param \Scrapper\SourceInterface $source
     * @param DateTimeInterface $date
     * @param string $title
     * @param string $url
     * @param string|null $summary
     */
    public function __construct(SourceInterface $source, DateTimeInterface $date, string $title, string $url, string $summary = null)
    {
        $this->source = $source;
        $this->date = $date;
        $this->title = $title;
        $this->summary = $summary;
        $this->url = $url;
    }

    /**
     * Get source of the post.
     *
     * @return SourceInterface
     */
    public function getSource(): SourceInterface
    {
        return $this->source;
    }

    /**
     * Get date of the post.
     *
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Get title of the post.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get summary of the post.
     *
     * @return string|null
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Get URL of the post.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
