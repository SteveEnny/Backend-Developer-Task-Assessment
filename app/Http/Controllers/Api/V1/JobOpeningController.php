<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreJobOpeningRequest;
use App\Http\Resources\V1\JobOpeningResource;
use App\Models\JobOpening;
use App\Traits\ApiResponses;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class JobOpeningController extends Controller
{
    use ApiResponses;
    public function __construct(){
        // $this->authorizeResource(JobOpening::class, 'job');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return JobOpeningResource::collection(JobOpening::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobOpeningRequest $request)
    {
        $data = array_merge($request->all(), ['user_id' => $request->user()->id]);
        $jobs = JobOpening::create($data);

        return new JobOpeningResource($jobs);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $job_id)
    {
        try{

            $job = JobOpening::findOrFail($job_id);
            return new JobOpeningResource($job);

        }
        catch(ModelNotFoundException $ex){
            return $this->error('Job not found', 400);
        }
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