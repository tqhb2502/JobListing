<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id) {

        $user = User::find($id);

        return view('user.profile', [
            'id' => $id,
            'email' => $user->email,
            'name' => $user->name,
            'dob' => $user->dob,
            'gender' => $user->gender,
            'address' => $user->address,
            'phone' => $user->phone,
            'cv_url' => $user->cv_url,
        ]);
    }

    public function uploadCv(Request $request) {

        $id = Auth::guard('user')->id();

        $url = "cv/$id";
        if (Storage::disk('upload')->exists($url)) {
            Storage::disk('upload')->deleteDirectory($url);
        }
        Storage::disk('upload')->makeDirectory($url);

        if ($request->__isset('cv')) {
            $cv = $request->file('cv');
        }

        if (!empty($cv)) {
            $cv->storeAs($url, $cv->getClientOriginalName(), 'upload');
            User::where('id', $id)->update(['cv_url' => 'upload/' . $url . '/' . $cv->getClientOriginalName()]);
        }

        return redirect()->route('user.show', ['id' => $id]);
    }

    public function apply($jobId) {

        $userId = Auth::guard('user')->id();
        $user = User::find($userId);

        $job = Job::find($jobId);

        $user->jobs()->attach($job, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $job->applied++;
        $job->save();

        return redirect()->back();
    }

    public function appliedJobs() {

        $id = Auth::guard('user')->id();
        
        $user = User::find($id);
        $query = $user->jobs()->orderBy('created_at', 'desc');
        $count = $query->count();
        $jobs = $query->paginate(8);

        return view('job.listing', [
            'user' => $user,
            'jobs' => $jobs,
            'count' => $count,
        ]);
    }
}
