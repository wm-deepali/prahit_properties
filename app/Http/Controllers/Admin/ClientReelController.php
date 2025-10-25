<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientReel;
use Illuminate\Http\Request;
use Storage;

class ClientReelController extends Controller
{
    public function index()
    {
        $reels = ClientReel::all();
        return view('admin.client_reels.index', compact('reels'));
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'html' => view('admin.client_reels.create')->render(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'designation' => 'nullable|string|max:255',

            'reel_type' => 'required|in:youtube,facebook,upload',
            'youtube_url' => 'nullable|required_if:reel_type,youtube|url',
            'facebook_url' => 'nullable|required_if:reel_type,facebook|url',
            'video_file' => 'nullable|required_if:reel_type,upload|mimes:mp4,mov,avi|max:20480',
        ]);

        // Upload author image
        if ($request->hasFile('author_image')) {
            $data['author_image'] = $request->file('author_image')->store('client_reels/authors', 'public');
        }

        // Upload video file
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('client_reels/videos', 'public');
        }

        ClientReel::create($data);

        return response()->json(['success' => true, 'message' => 'Client reel added successfully.']);
    }

    public function show(ClientReel $clientReel)
    {
        return view('admin.client_reels.show', compact('clientReel'));
    }

    public function edit($id)
    {
        $clientReel = ClientReel::findOrFail($id);

        return response()->json([
            'success' => true,
            'html' => view('admin.client_reels.edit', compact('clientReel'))->render(),
        ]);
    }

    public function update(Request $request, ClientReel $clientReel)
    {
        $data = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'designation' => 'nullable|string|max:255',

            'reel_type' => 'required|in:youtube,facebook,upload',
            'youtube_url' => 'nullable|required_if:reel_type,youtube|url',
            'facebook_url' => 'nullable|required_if:reel_type,facebook|url',
            'video_file' => 'nullable|required_if:reel_type,upload|mimes:mp4,mov,avi|max:20480',
        ]);

        // Update author image
        if ($request->hasFile('author_image')) {
            if ($clientReel->author_image) {
                Storage::disk('public')->delete($clientReel->author_image);
            }
            $data['author_image'] = $request->file('author_image')->store('client_reels/authors', 'public');
        }

        // Update video file
        if ($request->hasFile('video_file')) {
            if ($clientReel->video_file) {
                Storage::disk('public')->delete($clientReel->video_file);
            }
            $data['video_file'] = $request->file('video_file')->store('client_reels/videos', 'public');
        }

        $clientReel->update($data);

        return response()->json(['success' => true, 'message' => 'Client reel updated successfully.']);
    }

    public function destroy(ClientReel $clientReel)
    {
        if ($clientReel->author_image) {
            Storage::disk('public')->delete($clientReel->author_image);
        }

        if ($clientReel->video_file) {
            Storage::disk('public')->delete($clientReel->video_file);
        }

        $clientReel->delete();

        return response()->json(['success' => true, 'message' => 'Client reel deleted successfully.']);
    }

    public function publicIndex()
    {
        // Only active reels
        $reels = ClientReel::get();
        return response()->json($reels);
    }
}
