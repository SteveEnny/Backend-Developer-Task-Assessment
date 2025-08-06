<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreJobRequest;
use App\Http\Requests\Api\V1\UpdateJobRequest;
use App\Http\Resources\V1\JobResource;
use App\Models\JobOpening;
use App\Policies\JobOpeningPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $keyword = $request->query('q');
        $jobs_posted = JobOpening::where('user_id', $userId)->filter($keyword)->paginate(20);
        return JobResource::collection($jobs_posted);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        if($request->hasFile('company_logo')){
            $path = Storage::disk('public')->put('logos', $request->file('company_logo'));
            $url = asset($path);
        }

        $data = array_merge($request->validated(), [
            'user_id' => $request->user()->id,
            'company_logo' => $url ?? null,
        ]);

        $jobs = JobOpening::create($data);
        $new_job = new JobResource($jobs);
        return $this->success('Job Successfully Created!', $new_job);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $job_id)
    {
        try{

            $job = JobOpening::findOrFail($job_id);
            $this->authorize('view', $job);
            return new JobResource($job);

        }
        catch(ModelNotFoundException $ex){
            return $this->error('Job not found', 400);
        }catch(AuthorizationException $ex) {
            return $this->error('Job not found', 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, string $job_id)
    {
        try {
            $job = JobOpening::findOrFail($job_id);

            $this->authorize('update', $job);

            if($request->hasFile('company_logo')){
                $path = Storage::disk('public')->put('logos', $request->file('company_logo'));
                $url = asset($path);
            }
            $data = [
                ...$request->validated(),
                'company_logo' => $url ?? null
            ];


            $job->update($data);
            $updated_job = new JobResource($job);
            return $this->success('Job Successfully Updated!', $updated_job);
        } catch(ModelNotFoundException $exception){
            return $this->ok('User not found', [
                'error' => 'The provided user id does not exists'
            ]);
        }catch(AuthorizationException $ex) {
            return $this->error('You are not authorized to update that resource', 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $job_id)
    {
        try{
            $job = JobOpening::findOrFail($job_id);

            // policy
            $this->authorize('delete', $job);


            $job->delete();
            return $this->ok('Job successfully deleted');
        } catch(ModelNotFoundException $exception){
            return $this->error("Job cannot be found", 404);
        }
    }
}