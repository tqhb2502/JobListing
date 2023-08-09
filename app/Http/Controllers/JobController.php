<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class JobController extends Controller
{
    private const DAYS = [1, 7, 14, 30];

    private const MIN_SALARY = [
        1 => 5000000,
        2 => 10000000,
        3 => 20000000,
        4 => 30000001,
    ];

    private const MAX_SALARY = [
        0 => 4999999,
        1 => 10000000,
        2 => 20000000,
        3 => 30000000,
    ];

    public function index() {

        $query = Job::query();
        $query->orderBy('created_at', 'desc');
        $count = $query->with('company')->count();
        $jobs = $query->paginate(8);

        return view('job.listing', [
            'jobs' => $jobs,
            'count' => $count,
        ]);
    }

    public function show($id) {

        // get job and company info
        $job = Job::with(['company', 'users'])->find($id);
        $company = $job->company;
        $candidates = $job->users;

        // current account can apply to this job or not
        $isUser = false;
        $canApply = false;
        if (Auth::guard('user')->check()) {

            $isUser = true;

            $userId = Auth::guard('user')->id();
            $count = Job::where('id', $id)
                ->whereHas('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->count();

            if ($count == 0) {
                $canApply = true;
            }
        }

        return view('job.details', [
            'isUser' => $isUser,
            'canApply' => $canApply,
            'company' => $company,
            'candidates' => $candidates,
            'id' => $id,
            'title' => $job->title,
            'min_salary' => $job->min_salary,
            'max_salary' => $job->max_salary,
            'job_nature' => $job->job_nature,
            'vacancy' => $job->vacancy,
            'applied' => $job->applied,
            'location' => $job->location,
            'position' => $job->position,
            'description' => $job->description,
            'created_at' => $job->created_at,
            'expires_at' => $job->expires_at,
        ]);
    }

    public function filter(Request $request) {
        
        $query = Job::query();
        $query->orderBy('created_at', 'desc');

        // company id
        if ($request->__isset('companyId')) {
            $companyId = $request->companyId;
            $query->where('company_id', $companyId);
        }

        // user id
        if ($request->__isset('userId')) {
            $userId = $request->userId;
            $query->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
        }
        
        // search text
        if ($request->__isset('searchText')) {

            $searchText = $request->searchText;

            $titleWithoutSpaces = "REPLACE(REPLACE(REPLACE(title, ' ', ''), '\t', ''), '\n', '')";
            $locationWithoutSpaces = "REPLACE(REPLACE(REPLACE(location, ' ', ''), '\t', ''), '\n', '')";
            $positionWithoutSpaces = "REPLACE(REPLACE(REPLACE(position, ' ', ''), '\t', ''), '\n', '')";
            $descriptionWithoutSpaces = "REPLACE(REPLACE(REPLACE(description, ' ', ''), '\t', ''), '\n', '')";

            $subQuery = Job::selectRaw("
                id AS sub_query_id,
                $titleWithoutSpaces AS titleWithoutSpaces,
                $locationWithoutSpaces AS locationWithoutSpaces,
                $positionWithoutSpaces AS positionWithoutSpaces,
                $descriptionWithoutSpaces AS descriptionWithoutSpaces
            ");

            $query->joinSub(
                $subQuery,
                'sub_query',
                function (JoinClause $join) {
                    $join->on('id', '=', 'sub_query_id');
                }
            )
                ->where(function (Builder $query) use ($searchText) {

                    $searchTextWithSpaces = trim($searchText);
                    $searchTextWithoutSpaces = preg_replace('/\s+/', '', $searchText);

                    $query->whereRaw("TRIM(title) LIKE ?", ['%' . $searchTextWithSpaces . '%'])
                        ->orWhereRaw("TRIM(location) LIKE ?", ['%' . $searchTextWithSpaces . '%'])
                        ->orWhereRaw("TRIM(position) LIKE ?", ['%' . $searchTextWithSpaces . '%'])
                        ->orWhereRaw("TRIM(description) LIKE ?", ['%' . $searchTextWithSpaces . '%'])
                        ->orWhereRaw("titleWithoutSpaces LIKE ?", ['%' . $searchTextWithoutSpaces . '%'])
                        ->orWhereRaw("locationWithoutSpaces LIKE ?", ['%' . $searchTextWithoutSpaces . '%'])
                        ->orWhereRaw("positionWithoutSpaces LIKE ?", ['%' . $searchTextWithoutSpaces . '%'])
                        ->orWhereRaw("descriptionWithoutSpaces LIKE ?", ['%' . $searchTextWithoutSpaces . '%']);
                });
        }

        // job natures
        if ($request->__isset('jobNatures')) {

            $jobNatures = $request->jobNatures;

            $query->where(function (Builder $query) use ($jobNatures) {
                foreach ($jobNatures as $jobNature) {
                    $query->orWhere('job_nature', $jobNature);
                }
            });
        }

        // created within
        if ($request->__isset('createdWithin') && $request->createdWithin != -1) {

            $index = $request->createdWithin;

            $query->whereBetween('created_at', [
                Carbon::now()->subDays(self::DAYS[$index]),
                Carbon::now()
            ]);
        }

        // salary
        if ($request->__isset('salary') && $request->salary != -1) {

            $index = $request->salary;

            $query->where(function (Builder $query) use ($index) {

                $query->where(function (Builder $query) use ($index) {

                    if (!empty(self::MIN_SALARY[$index])) {
                        $query->where('min_salary', '>=', self::MIN_SALARY[$index]);
                    }

                    if (!empty(self::MAX_SALARY[$index])) {
                        $query->where('min_salary', '<=', self::MAX_SALARY[$index]);
                    }
                });

                $query->orWhere(function (Builder $query) use ($index) {

                    if (!empty(self::MIN_SALARY[$index])) {
                        $query->where('max_salary', '>=', self::MIN_SALARY[$index]);
                    }

                    if (!empty(self::MAX_SALARY[$index])) {
                        $query->where('max_salary', '<=', self::MAX_SALARY[$index]);
                    }
                });
            });
        }

        // pagination
        $count = $query->with('company')->count();
        $jobs = $query->paginate(8);

        return view('job.listing', [
            'jobs' => $jobs,
            'count' => $count,
            'request' => $request,
        ]);
    }

    public function edit() {

        $companyId = Auth::guard('company')->id();
        $company = Company::find($companyId);

        return view('job.edit', [
            'company' => $company,
        ]);
    }

    public function store(Request $request) {
        // return response()->json($request);

        $job = Job::create([
            'company_id' => $request->companyId,
            'title' => $request->title,
            'position' => $request->position,
            'location' => $request->location,
            'vacancy' => $request->vacancy,
            'job_nature' => $request->jobNature,
            'min_salary' => $request->minSalary,
            'max_salary' => $request->maxSalary,
            'expires_at' => Carbon::createFromFormat('Y-m-d H:i:s',
                $request->expirationDate . ' ' . $request->expirationTime . ':00'),
            'description' => $request->description,
        ]);

        return redirect()->route('job.show', ['id' => $job->id]);
    }
}
