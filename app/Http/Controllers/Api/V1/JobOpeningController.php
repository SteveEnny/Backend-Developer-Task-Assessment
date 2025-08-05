<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreJobRequest;
use App\Http\Requests\Api\V1\UpdateJobRequest;
use App\Http\Resources\V1\JobResource;
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
        return JobResource::collection(JobOpening::paginate());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $job_id)
    {
        try{

            $job = JobOpening::findOrFail($job_id);
            return new JobResource($job);

        }
        catch(ModelNotFoundException $ex){
            return $this->error('Job not found', 400);
        }
    }

}