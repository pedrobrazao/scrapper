<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Scrapper\ScrapperServiceInterface;

class SourcesList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrapper:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all available sources to scrap.';

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
        $sources = $this->scrapperService->listSources();
        $this->info(sprintf('%d sources available:', count($sources)));

        foreach ($sources as $source) {
            $this->line($source);
        }
    }
}
