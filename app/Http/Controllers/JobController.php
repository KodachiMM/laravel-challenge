<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Services\EmployeeManagement\Applicant;
use Illuminate\Http\Response;

class JobController extends Controller
{
    public function __construct(protected Applicant $applicant)
    {

    }

    public function apply(Job $job)
    {
        request()->validate([
            'salary' => ['nullable', 'numeric'],
        ]);

        $this->applicant->applyJob($job);

        return response()->json([
            'data' => 'Your application has been successfully submitted.',
        ]);
    }

    public function hire(Job $job, User $user)
    {
        if (!auth()->user()->tokenCan('admin')) {
            abort(Response::HTTP_NOT_FOUND);
        }

        request()->validate([
            'salary' => ['required', 'numeric'],
        ]);

        $this->applicant->hire($job, $user);

        return response()->json([
            'data' => 'The staff has been hired.',
        ]);
    }
}
