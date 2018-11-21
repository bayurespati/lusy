<?php

namespace App\Http\Controllers\Admin\Bookkeeping;

use App\AboutContent;
use App\ClassRegion;
use App\Subscription;
use App\Rank;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function member(){

        return view('admin.bookkeeping.member');

    }

    public function loadMember(){

        $data = Member::with(['rank','class','classRegion','subscription'])->whereIsApprove(true)->get();

        $dataMember = $data->map(function ($member) {

            $ranks = $member['rank']->map(function ($rank){

                $data = [
                    'rankId' => $rank['id'],
                    'title' => $rank['title'],
                    'annointed_date' => $rank['pivot']['annointed_date']
                ];

                return $data;
            });

            $member = [
                'id' => $member['id'],
                'name' => $member['name'],
                'gender' => $member['gender'],
                'place_of_birth' => $member['place_of_birth'],
                'date_of_birth' => $member['date_of_birth'],
                'email' => $member['email'],
                'fax' => $member['fax'],
                'telephone' => $member['telephone'],
                'mobile' => $member['mobile'],
                'join_date' => $member['join_date'],
                'is_active' => $member['is_active'],
                'is_approve' => $member['is_approve'],
                'class' => $member['class'],
                'class_region' => $member['class_region'],
                'subscription' => $member['subscription'],
                'ranks' => $ranks
            ];

            return $member;
        });

        return $dataMember;
    }

    public function loadRank(){
        return Rank::all();
    }

    public function loadClass(){
        $classList = AboutContent::where('is_class', 1)->get();

        return $classList;
    }

    public function addMember(Request $request){

        return DB::transaction(function () use ($request) {

            $member = new Member;
            $member->name = $request->personal['name'];
            $member->gender = $request->personal['gender'];
            $member->place_of_birth = $request->personal['place_of_birth'];
            $member->date_of_birth = substr($request->personal['date_of_birth'],0,10);
            $member->is_approve = true;
            $member->is_active = false;
            $member->email = $request->personal['email'];
            $member->telephone = $request->personal['telephone'];
            $member->mobile = $request->personal['mobile'];
            $member->fax = $request->personal['fax'];
            $member->class_id = $request->personal['class_id'];
            $member->join_date = substr($request->personal['join_date'],0,10);

            $member->save();

            foreach ($request->ranks as $rank) {
                $member->rank()->attach($rank['rankId'], ['annointed_date' => substr($rank['annointed_date'],0,10) ]);
            }

            foreach ($request->subscription as $subscription) {
                $sub = new Subscription;
                $sub->member_id = $member->id;
                $sub->year = $subscription;
                $sub->save();
            }

            foreach ($request->region as $region) {
                $classRegion = new ClassRegion;
                $classRegion->member_id = $member->id;
                $classRegion->name = $region['name'];
                $classRegion->city = $region['city'];
                $classRegion->address = $region['address'];
                $classRegion->save();
            }

        });
    }

    //-----------------------------//
    //       APPLICANT MEMBER      //
    //-----------------------------//
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
