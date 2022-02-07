<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Response;

class PayrollController extends Controller
{
    public function index()
    {
        if (!auth()->user()->tokenCan('admin')) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $payrolls = Payroll::with('staff')->paginate(10);
        return response()->json($payrolls);
    }
}
