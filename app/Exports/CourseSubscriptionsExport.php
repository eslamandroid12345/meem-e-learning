<?php

namespace App\Exports;

use App\Http\Traits\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class CourseSubscriptionsExport implements FromView
{
    use Exportable;
}
