<?php

namespace App\Http\Controllers;

use App\CommunityLink;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller
{
    public function index()
    {
		$links = CommunityLink::paginate(25);
    	return view('community.index', compact('links'));
    }

    public function store(Request $request)
    {
    	CommunityLink::from(auth()->user())
    		->contribute($request->all());

    	return back();
    }
}
