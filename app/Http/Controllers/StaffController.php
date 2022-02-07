<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayrollRequest;
use App\Models\Payroll;
use App\Models\Staff;
use App\Services\EmployeeManagement\Staff as StaffService;
use Illuminate\Http\Response;

class StaffController extends Controller
{
    protected $staff;

    public function __construct(StaffService $staff)
    {
        $this->staff = $staff;
    }

    public function payroll(PayrollRequest $request, Staff $staff)
    {
        if (!auth()->user()->tokenCan('admin')) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $attributes = $request->validated();
        $attributes['staff_id'] = $staff->id;
        $attributes['basic_salary'] = $staff->salary;

        $data = $this->staff->salary($attributes);

        return response()->json([
            'data' => $data->load(['staff']),
        ]);
    }
}
