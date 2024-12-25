<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Photo;

class ClearWeeklyPhoto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-weekly-photo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete or nullify photos weekly.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Photo::whereNotNull('Photo')->update(['Photo' => null]);

        $this->info('Weekly cleanup of non-null records completed.');
    }
}
