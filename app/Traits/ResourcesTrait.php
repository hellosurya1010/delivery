<?php

namespace App\Traits;

use App\Http\Resources\CityResource;
use App\Http\Resources\CollegeResource;
use App\Http\Resources\DegreeResource;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\UserCollegeResource;
use App\Http\Resources\UserResource;

trait ResourcesTrait
{

    public function userResource($user){
        return new UserResource($user);
    }
    public function usersResource($users){
        return UserResource::collection($users);
    }



    public function stateResource($state){
        return new StateResource($state);
    }
    public function statesResource($states){
        return StateResource::collection($states);
    }



    public function cityResource($city){
        return new CityResource($city);
    }
    public function citysResource($citys){
        return CityResource::collection($citys);
    }


    public function degreeResource($degree){
        return new DegreeResource($degree);
    }
    public function degreesResource($degrees){
        return DegreeResource::collection($degrees);
    }


    public function departmentResource($department){
        return new DepartmentResource($department);
    }
    public function departmentsResource($departments){
        return DepartmentResource::collection($departments);
    }

    public function userCollegeResource($college){
        return new UserCollegeResource($college);
    }
    public function userCollegesResource($colleges){
        return UserCollegeResource::collection($colleges);
    }

    public function collegeResource($college){
        return new CollegeResource($college);
    }
    public function collegesResource($colleges){
        return CollegeResource::collection($colleges);
    }
}
