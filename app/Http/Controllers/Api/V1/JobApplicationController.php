<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\JobApplyRequest;
use App\Http\Resources\JobApplicationResource;
use App\Models\JobApplication;
use App\Models\JobOpening;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of applied jobs for a business.
     */
    public function jobApplications(string $job_id)
    {
        try{
            $job = JobOpening::findOrFail($job_id);

            $this->authorize('view', $job);

            $job_applications =JobApplication::where('job_id', $job_id)->paginate(20);
            return JobApplicationResource::collection($job_applications);
         }
        catch(ModelNotFoundException $ex){
            return $this->error('Job not found', 400);
        }catch(AuthorizationException $ex) {
            return $this->error('Job not found', 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function apply(JobApplyRequest $request, string $job_id)
    {
        try{
            JobOpening::findOrFail($job_id);

            $isApplied = JobApplication::where([
                'job_id' => $job_id,
                'email' => $request->email,
            ])->exists();

            if ($isApplied) {
                return $this->error('You have already applied for this job.', 200);
            }

            $path = Storage::disk('public')->put('cvs', $request->file('cv'));
            $url = asset($path);

            $data = [
                ...$request->validated(),
                'job_id' => $job_id,
                'cv' => $url
            ];

            new JobApplicationResource(JobApplication::create($data));
            return $this->successWithoutData('Application Successfully Submitted!');
        }
        catch(ModelNotFoundException $ex){
            return $this->error('Invalid Job ID', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}