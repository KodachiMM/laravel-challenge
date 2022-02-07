<?php

namespace App\Http\Controllers;

use App\Models\Payroll;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('staff')->paginate(10);
        return response()->json($payrolls);
    }
}
