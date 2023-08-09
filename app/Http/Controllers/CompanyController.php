<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function show($id) {
        
        $company = Company::where('id', $id)->first();

        return view('company.about', [
            'isEditing' => 0,
            'id' => $id,
            'cover_image' => $company->cover_image,
            'name' => $company->name,
            'description' => $company->description,
            'website' => $company->website,
            'address' => $company->address,
            'phone' => $company->phone,
            'email' => $company->email,
        ]);
    }

    public function edit() {
        
        $id = Auth::guard('company')->id();
        $company = Company::where('id', $id)->first();

        return view('company.about', [
            'isEditing' => 1,
            'id' => $id,
            'cover_image' => $company->cover_image,
            'name' => $company->name,
            'description' => $company->description,
            'website' => $company->website,
            'address' => $company->address,
            'phone' => $company->phone,
            'email' => $company->email,
        ]);
    }

    public function store(Request $request) {

        $id = Auth::guard('company')->id();
        $company = Company::where('id', $id)->first();

        $company->name = $request->name;
        $company->description = $request->description;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->phone = $request->phone;

        if ($company->save()) {
            return redirect()->route('company.show', ['id' => $id]);
        } else {
            return redirect()->route('company.show', ['id' => $id]);
        }
    }

    public function jobsList($id) {

        $company = Company::where('id', $id)->first();

        $query = Job::query();
        $query->orderBy('created_at', 'desc');
        $count = $query->with('company')->where('company_id', $id)->count();
        $jobs = $query->paginate(8);

        return view('job.listing', [
            'company' => $company,
            'jobs' => $jobs,
            'count' => $count,
        ]);
    }
}
