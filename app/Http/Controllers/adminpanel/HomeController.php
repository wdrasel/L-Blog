<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Requests\AccountUpdateRequest;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PragmaRX\Tracker\Support\Minutes;
use Tracker;

class HomeController extends AdminpanelController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $range = new Minutes();

        $range->setStart(Carbon::now()->subDays(12));

        $range->setEnd(Carbon::now()->subDays(1));

        $pageViews = Tracker::pageViews($range);





        return view('adminpanel.home.index',compact('pageViews'));
    }

    public function edit(Request $request){

        $user = $request->user();

        return view('adminpanel.home.edit',compact('user'));
    }

    public function update(AccountUpdateRequest $request){

        $user = $request->user();
        $user->update($request->all());

        return redirect()->back()->with('message','successfully update profile');
    }
}
