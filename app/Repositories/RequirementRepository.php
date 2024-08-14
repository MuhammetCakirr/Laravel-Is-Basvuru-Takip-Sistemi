<?php

namespace App\Repositories;

use App\Models\JobPosting;
use App\Models\JobRequirement;

class RequirementRepository
{
    public function create(int $postId,string $require):JobRequirement
    {
        return JobRequirement::query()->create(
            [
                "postId"=>$postId,
                "require"=>$require
            ]
        );
    }

    public function delete(int $reqId):JobRequirement
    {
        $req=JobRequirement::query()->with('post')->find($reqId);
        $req->delete();
        return $req;
    }


    public function update(int $reqId,string $require):JobRequirement
    {
        $req=JobRequirement::query()->with('post')->find($reqId);
        $req->update(["require"=>$require]);
        return $req;
    }

    public function showRequirementsPostById(int $postId):JobPosting
    {
        return JobPosting::query()->where('id',$postId)->with('requirements')->first();
    }



}
