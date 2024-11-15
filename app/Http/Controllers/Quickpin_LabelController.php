<?php

namespace App\Http\Controllers;

use App\Models\Quickpin_Label;
use Illuminate\Http\Request;
use DataTables;

class Quickpin_LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getData()
    {
        // $users = Belanja::select(['id_product', 'jenisBelanja', 'keteranganBarang', 'totalBelanja', 'created_at']);

        // $quickpin_label = Belanja::whereMonth('created_at', Carbon::now()->month)->get();
        $quickpin_label = Quickpin_Label::all();

       // dd($quickpin_label);

        return DataTables::of($quickpin_label)
            ->editColumn('id_label', function ($quickpin_label) {
                $yearSuffix = $quickpin_label->created_at->format('y'); // Get the last two digits of the year
                $id_label_padded = str_pad($quickpin_label->id_label, 3, '0', STR_PAD_LEFT); // Pad the id_label with zeros to be 3 digits long
                return $yearSuffix . $id_label_padded; // Combine the year suffix and the padded id_label
            })
            ->editColumn('created_at', function ($quickpin_label) {
                return $quickpin_label->created_at->format('Y-m-d H:i');
            })
            ->addColumn('action', function($quickpin_label) {
                $showUrl = route('Quickpin_Label.show', $quickpin_label->created_at); 
                // $editUrl = route('Quickpin_Label.edit', $quickpin_label->id_label); 
                // <a href="'.$editUrl.'" class="btn btn-xs btn-primary">Edit</a>
                $deleteUrl = route('Quickpin_Label.destroy', $quickpin_label->id_label); 
                return '
                    <a href="'.$showUrl.'" class="btn btn-xs btn-primary">View</a>
                    <form action="'.$deleteUrl.'" method="POST" style="display: inline-block;">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                    </form>
                ';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'brand' => 'required',
            'customer' => 'required',
            'PO' => 'required',
            'type.*' => 'required',  // Using the * syntax to validate each array entry
            'scale.*' => 'required',
            'input.*' => 'required',
            'qty.*' => 'required',
        ]);

        // Loop through each set of inputs
        foreach ($request['type'] as $index => $type) {
            // Get the quantity for the current index
            $quantity = $request['qty'][$index];

            // Create multiple entries based on the quantity
            for ($i = 0; $i < $quantity; $i++) {
                Quickpin_Label::create([
                    'brand' => $request['brand'],
                    'customer' => $request['customer'],
                    'PO' => $request['PO'],
                    'type' => $type,
                    'scale' => $request['scale'][$index],
                    'input' => $request['input'][$index],
                    'qty' => 1, // Set qty to 1 for each individual entry
                ]);
            }
        }

        return redirect('/Labs')->with('success', 'Form submitted successfully!');
    }
    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show($created_at)
    {
        // Fetch all records with the given PO
        $quickpin_Label = Quickpin_Label::where('created_at', $created_at)->get();

        // dd($quickpin_Label);

        // Pass the records to the view
        return view('base.Quickpin_LabelShow', compact('Quickpin_Label'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Quickpin_Label $quickpin_Label)
    {
        //
    }


    // public function edit(Quickpin_Label $quickpin_Label)
    //{
    //
    //}

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Quickpin_Label $quickpin_Label)
    {
        //
    }

    //public function update(Request $request, Quickpin_Label $quickpin_Label)
    //{
    //
    //}

    public function destroy(Quickpin_Label $quickpin_Label)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    //public function destroy(Quickpin_Label $quickpin_Label)
    //{
    //
    //}
}
