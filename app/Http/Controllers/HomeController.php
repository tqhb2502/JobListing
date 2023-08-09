<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $jobs = Job::orderBy('max_salary', 'desc')->limit(5)->get();

        return view('index', [
            'jobs' => $jobs,
        ]);
    }
}
