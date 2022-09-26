<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromQuery
{

    use Exportable,Queueable,Dispatchable,InteractsWithQueue;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return User::query();
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
