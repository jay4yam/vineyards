<?php

namespace App\Jobs;

use App\Libraries\APIMO\ApimoPropertiesImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Log;

class ProcessImportProperties implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {}

    /**
     * Execute the job.
     * @throws ConnectionException
     */
    public function handle(ApimoPropertiesImport $propertiesImport): void
    {
        $propertiesImport->import(2421, null);
    }

    /**
     * @param $exception
     * @return void
     */
    public function fail($exception = null):void
    {
        Log::error('Erreur Import Properties from APIMO' . $exception->getMessage());
    }
}
