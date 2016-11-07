<?php

namespace App\Http\Controllers;

use App\Exceptions\CommunityLinkAlreadySubmitted;
use App\CommunityLink;
use App\Channel;
use App\Http\Requests\CommunityLinkForm;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller
{
    /**
    * Show all community links
    *
    * @param Channel $channel
    * @return \Illuminate\view\view
    */
    public function index(Channel $channel = null)
    {
        $links = CommunityLink::with('votes')->forChannel($channel)
            ->where('approved', 1)
            ->latest('updated_at')
            ->paginate(3);

       // dd($links);

        $channels = Channel::orderBy('title', 'asc')->get();

    	return view('community.index', compact('links', 'channels', 'channel'));
    }

    public function store(CommunityLinkForm $form)
    {

        try {
            $form->persist();

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
