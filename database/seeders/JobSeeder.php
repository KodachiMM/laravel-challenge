<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
                'title' => 'Senior Web Developer',
                'description' => 'Senior Web Developer',
            ],
            [
                'title' => 'Junior Web Developer',
                'description' => 'Junior Web Developer',
                'is_active' => false,
            ],
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
