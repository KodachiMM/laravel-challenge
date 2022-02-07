<?php

namespace App\Services\InternetServiceProvider;

class Mpt
{
    protected $operator = 'mpt';
    protected $monthlyFees = 200;

    public function __construct(protected $month)
    {
        //
    }

    public function calculateTotalAmount()
    {
        return $this->month * $this->monthlyFees;
    }
}
