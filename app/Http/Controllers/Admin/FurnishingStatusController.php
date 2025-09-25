<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FurnishingStatus;
use Illuminate\Http\Request;

class FurnishingStatusController extends Controller
{
    public function index()
    {
        $statuses = FurnishingStatus::latest()->get();
        return view('admin.furnishing-status.index', compact('statuses'));
    }

    public function create()
    {
        return view('admin.furnishing-status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name.*' => 'required|string|max:255',
            'input_type.*' => 'required|in:dropdown,checkbox',
            'second_input.*' => 'required|in:yes,no',
            'second_input_label.*' => 'nullable|string|max:255',
        ]);

        $names = $request->name;
        $inputTypes = $request->input_type;
        $secondInputs = $request->second_input;
        $secondInputLabels = $request->second_input_label ?? [];

        foreach ($names as $index => $name) {
            FurnishingStatus::create([
                'name' => $name,
                'input_format' => $inputTypes[$index],
                'second_input' => $secondInputs[$index],
                'second_input_label' => $secondInputs[$index] === 'yes' ? ($secondInputLabels[$index] ?? null) : null,
                'status' => 'active',
            ]);
        }

        return redirect()->route('admin.furnishing-statuses.index')
            ->with('success', 'Furnishing Status(es) added successfully.');
    }

    public function edit($id)
    {
        $status = FurnishingStatus::findOrFail($id);
        return view('admin.furnishing-status.edit', compact('status'));
    }

    public function update(Request $request, $id)
    {
        $status = FurnishingStatus::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'input_type' => 'required|in:dropdown,checkbox',
            'second_input' => 'required|in:yes,no',
            'second_input_label' => 'nullable|required_if:second_input,yes|string|max:255',
        ]);

        $status->update([
            'name' => $request->name,
            'input_format' => $request->input_type,
            'second_input' => $request->second_input,
            'second_input_label' => $request->second_input === 'yes' ? $request->second_input_label : null,
        ]);

        return redirect()->route('admin.furnishing-statuses.index')
            ->with('success', 'Furnishing Status updated successfully.');
    }

    public function destroy($id)
    {
        $status = FurnishingStatus::findOrFail($id);
        $status->delete();

        return back()->with('success', 'Furnishing Status deleted successfully.');
    }

    public function changeStatus(Request $request)
    {
        $status = FurnishingStatus::findOrFail($request->id);
        $status->status = $status->status === 'active' ? 'inactive' : 'active';
        $status->save();

        return response()->json('Status updated successfully.');
    }
}
