<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyStatus;
use Illuminate\Http\Request;

class PropertyStatusController extends Controller
{
    /**
     * Display a listing of property statuses.
     */
    public function index()
    {
        $statuses = PropertyStatus::latest()->get();
        return view('admin.property-status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new property status.
     */
    public function create()
    {
        return view('admin.property-status.create');
    }

    /**
     * Store newly created property statuses in storage.
     */
    public function store(Request $request)
    {
        // Validate arrays
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
            PropertyStatus::create([
                'name' => $name,
                'input_format' => $inputTypes[$index],
                'second_input' => $secondInputs[$index],
                'second_input_label' => $secondInputs[$index] === 'yes' ? ($secondInputLabels[$index] ?? null) : null,
                'status' => 'active',
            ]);
        }

        return redirect()->route('admin.property-statuses.index')
            ->with('success', 'Property Status(es) added successfully.');
    }

    /**
     * Show the form for editing a specific property status.
     */
    public function edit($id)
    {
        $status = PropertyStatus::findOrFail($id);
        return view('admin.property-status.edit', compact('status'));
    }

    /**
     * Update the specified property status in storage.
     */
    public function update(Request $request, $id)
    {
        $status = PropertyStatus::findOrFail($id);

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

        return redirect()->route('admin.property-statuses.index')
            ->with('success', 'Property Status updated successfully.');
    }

    /**
     * Remove a property status from storage.
     */
    public function destroy($id)
    {
        $status = PropertyStatus::findOrFail($id);
        $status->delete();

        return back()->with('success', 'Property Status deleted successfully.');
    }

    /**
     * Toggle status (active/inactive) of a property status.
     */
    public function changeStatus(Request $request)
    {
        $status = PropertyStatus::findOrFail($request->id);
        $status->status = $status->status === 'active' ? 'inactive' : 'active';
        $status->save();

        return response()->json('Status updated successfully.');
    }
}
