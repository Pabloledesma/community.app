<?php

namespace App\Http\Controllers;

use App\Exceptions\CommunityLinkAlreadySubmitted;
use App\CommunityLink;
use App\Channel;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller
{
    public function index()
    {
		$links = CommunityLink::where('approved', 1)->latest('updated_at')->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();

    	return view('community.index', compact('links', 'channels'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'channel_id'    => 'required|exists:channels,id',
            'title'         => 'required',
            'link'          => 'required'
        ]);

        try {
            CommunityLink::from(
                auth()->user()
            )->contribute($request->all());

            if(auth()->user()->isTrusted()){
                flash('Thanks for the contribution', 'success');
            } else {
                flash()->overlay('This contribution will be approved shortly', 'Thanks!');
            }
        } catch (CommunityLinkAlreadySubmitted $e) {
            flash()->overlay(
                "We'll instead bump the timestamps and bring that link back to the top. Thanks!",
                "That link has already been submitted"
            );
        }

    	return back();
    }
}
