<?php

namespace App\Services\EmployeeManagement;

use App\Helpers\ExceptionHelper;
use App\Models\Staff;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class Applicant implements Employee
{
    public function applyJob($job)
    {
        if (!$job->is_active) {
            ExceptionHelper::throwException(Response::HTTP_FORBIDDEN, 'The employer does not accept more applications.');
        }

        try {
            auth()->user()->jobs()->attach($job->id, ['salary' => request('salary') ?: null]);
        } catch (QueryException $e) {
            ExceptionHelper::throwException(Response::HTTP_FORBIDDEN, 'You already applied for this job.');
        }
    }

    public function salary($staff): bool
    {
        return true;
    }

    public function hire($job, $user)
    {
        try {
            Staff::create([
                'name' => $user->name,
                'email' => $user->email,
                'salary' => request('salary'),
            ]);
        } catch (QueryException $e) {
            ExceptionHelper::throwException(Response::HTTP_FORBIDDEN, 'You already hire this staff.');
        }
    }
}
