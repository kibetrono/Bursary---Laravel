<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class ApplicationPeriod extends Model
{
    use HasFactory;

    protected $fillable= [
        'financial_year',
        'period_from',
        'period_to',
        'status'
    ];

    public function isApplicationAllowed()
    {
        $currentYear = date('Y');
        $currentDate = Carbon::now()->format('Y-m-d');
        $applicationPeriods = self::all();
        
        foreach ($applicationPeriods as $applicationPeriod) {

            $startYear = (int) $applicationPeriod->financial_year;
            $endYear = $startYear + 1;
           

            if ($currentYear == $startYear && $currentYear + 1 == $endYear && $applicationPeriod->status === 1) {

                $period_from = Carbon::parse($applicationPeriod->period_from)->format('Y-m-d');
                $period_to = Carbon::parse($applicationPeriod->period_to)->format('Y-m-d');
    
                if ($currentDate >= $period_from && $currentDate <= $period_to) {
                    return true;
                }
            }
        }

        return false;
    }
    
}
