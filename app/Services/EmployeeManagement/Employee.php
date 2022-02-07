<?php

namespace App\Services\EmployeeManagement;

interface Employee
{
    public function applyJob($job);
    
    public function salary($staff);
}