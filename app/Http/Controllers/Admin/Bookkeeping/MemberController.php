<?php

namespace App\Http\Controllers\Admin\Bookkeeping;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function applicant(){

    	return view('admin.bookkeeping.applicant_member');

    }

    public function loadApplicantMember(){

    	return Member::where('is_approve', 0)->with('class')->get();

    }

    public function update(Request $request, Member $member){

    	$member->is_approve = $request->is_approve;
    	$member->update();

    }

    public function destroy(Member $member){

    	$member->delete();
        
    }
}
