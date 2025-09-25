<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PriceLabel;
use Illuminate\Http\Request;

class PriceLabelController extends Controller
{
    /**
     * Display a listing of the price labels.
     */
    public function index()
    {
        $labels = PriceLabel::latest()->get();
        return view('admin.price-label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new price label.
     */
    public function create()
    {
        return view('admin.price-label.create');
    }

    /**
     * Store a newly created price label in storage.
     */
    public function store(Request $request)
    {
        // Validate arrays
        $request->validate([
            'label_name.*' => 'required|string|max:255',
            'input_type.*' => 'required|in:dropdown,checkbox',
            'second_input.*' => 'required|in:yes,no',
            'second_input_label.*' => 'nullable|string|max:255',
        ]);

        $labels = $request->label_name;
        $inputTypes = $request->input_type;
        $secondInputs = $request->second_input;
        $secondInputLabels = $request->second_input_label ?? [];

        foreach ($labels as $index => $name) {
            PriceLabel::create([
                'name' => $name,
                'input_format' => $inputTypes[$index],
                'second_input' => $secondInputs[$index],
                'second_input_label' => $secondInputs[$index] === 'yes' ? ($secondInputLabels[$index] ?? null) : null,
                'status' => 'active',
            ]);
        }

        return redirect()->route('admin.price-labels.index')
            ->with('success', 'Price Labels added successfully.');
    }


    /**
     * Show the form for editing the specified price label.
     */
    public function edit($id)
    {
        $priceLabel = PriceLabel::findOrFail($id);
        return view('admin.price-label.edit', compact('priceLabel'));
    }

    /**
     * Update the specified price label in storage.
     */
    public function update(Request $request, $id)
    {
        $label = PriceLabel::findOrFail($id);

        $request->validate([
            'label_name' => 'required|string|max:255',
            'input_type' => 'required|in:dropdown,checkbox',
            'second_input' => 'required|in:yes,no',
            'second_input_label' => 'nullable|required_if:second_input,yes|string|max:255',
        ]);

        $label->update([
            'name' => $request->label_name,
            'input_format' => $request->input_type,
            'second_input' => $request->second_input,
            'second_input_label' => $request->second_input === 'yes' ? $request->second_input_label : null,
        ]);

        return redirect()->route('admin.price-labels.index')
            ->with('success', 'Price Label updated successfully.');
    }

    /**
     * Remove the specified price label from storage.
     */
    public function destroy($id)
    {
        $label = PriceLabel::findOrFail($id);
        $label->delete();

        return back()->with('success', 'Price Label deleted successfully.');
    }

    /**
     * Toggle the status (active/inactive) of a price label.
     */
    public function changeStatus(Request $request)
    {
        $label = PriceLabel::findOrFail($request->id);
        $label->status = $label->status === 'active' ? 'inactive' : 'active';
        $label->save();

        return response()->json('Status updated successfully.');
    }
}
