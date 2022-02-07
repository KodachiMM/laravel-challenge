<?php

namespace App\Services\EmployeeManagement;

use App\Helpers\ExceptionHelper;
use App\Models\Payroll;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class Staff implements Employee
{
    public function applyJob($job): bool
    {
        return true;
    }

    public function salary($attributes)
    {
        try {
            return Payroll::create($attributes);
        } catch (QueryException $e) {
            ExceptionHelper::throwException(Response::HTTP_FORBIDDEN, 'You already generate payroll for this staff for ' . $attributes['month'] . ' ' . $attributes['year'] . '.');
        }
    }
}
