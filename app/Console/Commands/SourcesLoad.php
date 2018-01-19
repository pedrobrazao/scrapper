<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;
use Scrapper\ScrapperServiceInterface;
use Scrapper\SourceInterface;

class SourcesLoad extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrapper:load {source=all} {limit=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load new entries from sources.';

    /**
     * @var \Scrapper\ScrapperServiceInterface
     */
    protected $scrapperService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ScrapperServiceInterface $scrapperService)
    {
        parent::__construct();
        $this->scrapperService = $scrapperService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $source = $this->argument('source');
        $limit = $this->argument('limit');

        if ('all' === $source) {
            $sources = $this->scrapperService->listSources();
        } else {
            $sources = [$source];
        }

        if ($limit < 1 || $limit > 1000) {
            $this->error('Limit must be an integer between 1 and 1000.');
            exit(1);
        }

        foreach ($sources as $class) {
            if (false === class_exists($class) || false === is_a($class, SourceInterface::class, true)) {
                $this->error(sprintf('Source "%s" does not exist or is invalid.', $class));
                exit(1);
            }

            $this->handleSource($class, $limit);
        }
    }

    /**
     * Handle a single source.
     *
     * @param string $class
     * @param int $limit
     * @return void
     */
    protected function handleSource(string $class, int $limit)
    {
        $this->info(sprintf('Loading source "%s"', $class));

        /* @var $source \Scrapper\SourceInterface */
        $source = new $class();

        try {
           $urls = $source->load();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        $counter = 0;

        foreach ($urls as $url) {
            if (0 < Post::where('url', $url)->count()) {
                continue;
            }

            $this->line($url);

            try {
                $scrapped = $source->parse($url);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
                continue;
            }

            $post = new Post([
                'source' => $scrapped->getSource()->getName(),
                'date' => $scrapped->getDate(),
                'title' => $scrapped->getTitle(),
                'summary' => $scrapped->getSummary(),
                'url' => $url,
            ]);

            $post->save();
            $counter++;

            if ($counter >= $limit) {
                break;
            }
        }

        $this->line(sprintf('%d new posts created.', $counter));
    }

}
