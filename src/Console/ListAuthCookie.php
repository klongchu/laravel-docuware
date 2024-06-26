<?php

namespace Klongchu\DocuWare\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Klongchu\DocuWare\Facades\DocuWare;
use Klongchu\DocuWare\Support\Auth;

class ListAuthCookie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docuware:list-auth-cookie {--with-date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List DocuWare Auth Cookie';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DocuWare::login();

        $cacheKey = Auth::CACHE_KEY;
        $cookie = Auth::cookies();
        $cookieHash = Arr::get($cookie, Auth::COOKIE_NAME);
        $cookieCreationDate = Arr::get($cookie, 'CreatedAt');

        if (! $cookieHash) {
            $this->info('No cookie found for the Key "'.$cacheKey.'".');
        }
        if ($cookieHash) {
            $this->info($cookieHash);
            if ($this->option('with-date')) {
                $this->newLine();
                $this->info("created at: {$cookieCreationDate}");
            }
        }

        return Command::SUCCESS;
    }
}
