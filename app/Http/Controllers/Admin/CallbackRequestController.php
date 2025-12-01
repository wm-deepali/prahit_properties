<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallbackRequest;

class CallbackRequestController extends Controller
{
    public function index()
    {
        $requests = CallbackRequest::latest()->get();
        return view('admin.callback_requests.index', compact('requests'));
    }

    public function destroy($id)
    {
        $request = CallbackRequest::findOrFail($id);
        $request->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Job Request deleted successfully.'
        ]);
    }
}

