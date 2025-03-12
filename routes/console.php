<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//gère l'import APIMO des propriétés
Schedule::job(new \App\Jobs\ProcessImportProperties)->dailyAt('02:00');
