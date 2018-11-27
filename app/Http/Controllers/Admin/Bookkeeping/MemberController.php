<?php

namespace App\Http\Controllers\Admin\Bookkeeping;

use App\AboutContent;
use App\Region;
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

        $data = Member::with(['rank','class','subscription','region'])->whereIsApprove(true)->get();

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
                'date_of_birth' => substr($member['date_of_birth'],0,10),
                'email' => $member['email'],
                'fax' => $member['fax'],
                'telephone' => $member['telephone'],
                'mobile' => $member['mobile'],
                'join_date' => substr($member['join_date'],0,10),
                'is_active' => $member['is_active'],
                'is_approve' => $member['is_approve'],
                'class' => $member['class'],
                'region' => $member['region'],
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

    public function loadClassRegion(){
        return Region::all();
    }

    public function addMember(Request $request){

        DB::transaction(function () use ($request) {

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
            $member->join_date = $request->personal['join_date'] == '' 
                                ? null 
                                : substr($request->personal['join_date'],0,10);

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
                $member->region()->attach($region['id']);
            }

        });
    }

    public function updateMember(Request $request, Member $member){

        $member->name = $request->name;
        $member->gender = $request->gender;
        $member->place_of_birth = $request->place_of_birth;
        $member->date_of_birth = substr($request->date_of_birth,0, 10);
        $member->telephone = $request->telephone;
        $member->mobile = $request->mobile;
        $member->email = $request->email;
        $member->fax = $request->fax;
        $member->class_id = $request->class_id;
        $member->join_date = substr($request->join_date,0, 10);

        $member->update();
    }

    //-----------------------------//
    //          RANK               //
    //-----------------------------//
    public function addRank(Request $request){

        $member = Member::find($request->member_id);

        $member->rank()
               ->attach( 
                    $request->rank_id, [
                        'annointed_date' => substr($request->annointed_date,0,10)
                    ]);
    }

    public function updateRank(Request $request){

        $member = Member::find($request->member_id);

        $member->rank()
               ->updateExistingPivot(
                    $request->rank_id, [
                        'annointed_date' => substr($request->annointed_date,0,10)
                    ]);
    }


    public function deleteRank(Request $request){

        $member = Member::find($request->member_id);

        $member->rank()->detach($request->rank_id);
    }

    //-----------------------------//
    //          REGION             //
    //-----------------------------//
    public function addClassRegion(Request $request){

        $member = Member::find($request->member_id);

        $member->region()->attach($request->region_id);

    }

    public function deleteClassRegion(Request $request){

        $member = Member::find($request->member_id);

        $member->region()->detach($request->rank_id);

    }

     //-----------------------------//
    //          Subscription       //
    //-----------------------------//
    public function addSubscription(Request $request){
        $subscription = new Subscription;
        $subscription->year = $request->year;
        $subscription->member_id = $request->member_id;

        $subscription->save();

        return $subscription->id;
    }

    public function deleteSubscription(Subscription $subscription){
        $subscription->delete();
    }


    //-----------------------------//
    //       APPLICANT MEMBER      //
    //-----------------------------//
    public function applicant(){

    	return view('admin.bookkeeping.applicant_member');

    }

    public function loadApplicantMember(){

        $members = Member::with('class')->get();

        $applicantMember = [];

        foreach ($members as  $member) {
            foreach ($member->class as $class) {
                if(!$class['pivot']->is_approve){
                    array_push($applicantMember,[
                        'id' => $member->id,
                        'name' => $member->name,
                        'gender' => $member->gender,
                        'place_of_birth' => $member->place_of_birth,
                        'date_of_birth' => $member->date_of_birth,
                        'telephone' => $member->telephone,
                        'mobile' => $member->mobile,
                        'fax' => $member->fax,
                        'email' => $member->email,
                        'class_id' => $class->id,
                        'class_title' => $class->title,
                        'is_approve' => $class['pivot']->is_approve,
                    ]);
                }
            }
        }

    	return $applicantMember;
    }

    public function update(Request $request, Member $member){

        $member->class()->updateExistingPivot($request->class_id, ['is_approve' => $request->is_approve]);

    }

    public function destroy(Member $member, AboutContent $class){

        $size = sizeof($member->class);

        if($size > 1){
            $member->class()->detach($class->id);
        }else{
            $member->class()->detach($class->id);

            $member->delete();
        }
    }
}
