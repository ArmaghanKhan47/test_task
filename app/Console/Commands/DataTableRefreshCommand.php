<?php

namespace App\Console\Commands;

use App\Models\Data;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class DataTableRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:updateTable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command, updates the record';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        $response = RateLimiter::attempt('fetch-data', 1, function() {
            Data::truncate();
            return Http::get('https://cspf-dev-challenge.herokuapp.com/');
        }, 3600);

        if (!$response) {
            $this->error('Too many attempts, please wait 60 minutes');
            return;
        }

        $data = json_decode($response->body())->data;

        $rows = $data->rows;

        foreach($rows as $row) {
            Data::create([
                'id' => $row->id,
                'first_name' => $row->fname,
                'last_name' => $row->lname,
                'email' => $row->email,
                'date' => $row->date,
            ]);
        }
    }
}
