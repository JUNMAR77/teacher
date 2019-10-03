<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;

class MembersController extends Controller
{
    public function store()
    {
        Member::create($this->validateRequest());
    }
    
    public function update(Member $member)
    {
        $member->update($this->validateRequest());
    }

    public function validateRequest()
    {
        return request()->validate([
            'first_name'=> 'required',
            'last_name' => 'required',
            'middle_name'=> 'required',
        ]);

    }
}
