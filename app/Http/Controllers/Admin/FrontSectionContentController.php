<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontContent;
use App\Properties;
use App\State;
use App\City;

class FrontSectionContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner            = FrontContent::where('slug', 'Banner')->first();
        $hand_picked       = FrontContent::where('slug', 'Hand-Picked')->first();
        $trending          = FrontContent::where('slug', 'Trending-Projects')->first();
        $latest_property   = FrontContent::where('slug', 'Latest-Properties')->first();
        $featured_property = FrontContent::where('slug', 'Featured-Property')->first();
        $states            = State::where('country_id', 101)->orderBy('name', 'ASC')->get();
        $properties = Properties::select(['id', 'title', 'publish_status'])->where('publish_status', 'Publish')->orderBy('id', 'DESC')->get();
        return view('admin.manage-front-content', compact('banner', 'properties', 'hand_picked', 'trending', 'latest_property', 'featured_property', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'heading'     => 'nullable|max:190',
                'title'       => 'nullable|max:190',
                'image'       => 'nullable|mimes:jpg,png,svg,gif,jpeg'
        
            ]
        );
        $picked = FrontContent::find($id);
        if($request->has('image')) {
            $image_url = $request->image->store('home_images');
            Storage::delete($picked->image);
        }else {
            $image_url = $picked->image;
        }
        $picked->update(
            [
                'heading'      => $request->has('heading') ? $request->heading : $picked->heading,
                'title'        => $request->has('title') ? $request->title : $picked->title,
                'description'  => $request->has('description') ? $request->description : $picked->description,
                'ids'          => $request->has('ids') ? implode(',', $request->ids) : $picked->ids,
                'image'        => $image_url
            ]
        );
        return redirect()->back()->with('success', 'Content Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getMultipleCities(Request $request) {
        $cities = City::whereIn('state_id', $request->states)->orderby('name', 'ASC')->get();
        return $cities;
    }
}
