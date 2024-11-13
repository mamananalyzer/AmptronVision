<?php

namespace App\Http\Controllers;

use App\Models\Metering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeteringController extends Controller
{
    // List all metering
    public function index()
    {
        return response()->json(Metering::all(), 200);
    }

    // Store a new metering
    // public function store(Request $request)
    // {
    //     $metering = Metering::create($request->all());
    //     return response()->json($metering, 201);
    // }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'F' => 'required',
        //     'U1' => 'required',
        //     'U2' => 'required',
        //     'U3' => 'required',
        //     'Uavg' => 'required',
        //     'U12' => 'required',
        //     'U23' => 'required',
        //     'U31' => 'required',
        //     'Ulavg' => 'required',
        //     'IL1' => 'required',
        //     'IL2' => 'required',
        //     'IL3' => 'required',
        //     'Iavg' => 'required',
        //     'In' => 'required',
        //     'Pa' => 'required',
        //     'Pb' => 'required',
        //     'Pc' => 'required',
        //     'Psum' => 'required',
        //     'Qa' => 'required',
        //     'Qb' => 'required',
        //     'Qc' => 'required',
        //     'Qsum' => 'required',
        //     'Sa' => 'required',
        //     'Sb' => 'required',
        //     'Sc' => 'required',
        //     'Ssum' => 'required',
        //     'PFa' => 'required',
        //     'PFb' => 'required',
        //     'PFc' => 'required',
        //     'PFsum' => 'required',
        //     'U_unbl' => 'required',
        //     'I_unbl' => 'required',
        //     'LCR' => 'required',
        //     'P_Dmd' => 'required',
        //     'Q_Dmd' => 'required',
        //     'S_Dmd' => 'required',
        //     'I1_Dmd' => 'required',
        //     'I2_Dmd' => 'required',
        //     'I3_Dmd' => 'required',
        //     'Ep_Imp' => 'required',
        //     'Ep_Exp' => 'required',
        //     'Eq_Imp' => 'required',
        //     'Eq_Exp' => 'required',
        //     'Ep_sum' => 'required',
        //     'Ep_net' => 'required',
        //     'Eq_sum' => 'required',
        //     'Eq_net' => 'required',
        //     'Es' => 'required',
        //     'Epa_Imp' => 'required',
        //     'Epa_Exp' => 'required',
        //     'Epb_Imp' => 'required',
        //     'Epb_Exp' => 'required',
        //     'Epc_Imp' => 'required',
        //     'Epc_Exp' => 'required',
        //     'Eqa_Imp' => 'required',
        //     'Eqa_Exp' => 'required',
        //     'Eqb_Imp' => 'required',
        //     'Eqb_Exp' => 'required',
        //     'Eqc_Imp' => 'required',
        //     'Eqc_Exp' => 'required',
        //     'Esa' => 'required',
        //     'Esb' => 'required',
        //     'Esc' => 'required',
        //     'PhsAngV2toV1' => 'required',
        //     'PhsAngV3toV1' => 'required',
        //     'PhsAngI1toV1' => 'required',
        //     'PhsAngI2toV1' => 'required',
        //     'PhsAngI3toV1' => 'required',
        // ]);

        $validatedData = $request->all();
        $validatedData['project'] = $request->input('is_active', 'amptron office');
        $validatedData['section'] = $request->input('is_active', 'panel kantor');
        $validatedData['device'] = $request->input('is_active', 'Acuvim II');
        $validatedData['sn'] = $request->input('is_active', 'AMxxxxxxxx');
        $validatedData['status'] = $request->input('is_active', 1);

        try {
            // Create a new Metering instance and save it
            Metering::create($validatedData);

            // $metering = new Metering([
            //     'project' => $validatedData['project'],
            //     'section' => $validatedData['section'],
            //     'device' => $validatedData['device'],
            //     'sn' => $validatedData['sn'],
            //     'status' => $validatedData['status'],
            //     'F' => $validatedData['F'],
            //     'U1' => $validatedData['U1'],
            //     'U2' => $validatedData['U2'],
            //     'U3' => $validatedData['U3'],
            //     'Uavg' => $validatedData['Uavg'],
            //     'U12' => $validatedData['U12'],
            //     'U23' => $validatedData['U23'],
            //     'U31' => $validatedData['U31'],
            //     'Ulavg' => $validatedData['Ulavg'],
            //     'IL1' => $validatedData['IL1'],
            //     'IL2' => $validatedData['IL2'],
            //     'IL3' => $validatedData['IL3'],
            //     'Iavg' => $validatedData['Iavg'],
            //     'In' => $validatedData['In'],
            //     'Pa' => $validatedData['Pa'],
            //     'Pb' => $validatedData['Pb'],
            //     'Pc' => $validatedData['Pc'],
            //     'Psum' => $validatedData['Psum'],
            //     'Qa' => $validatedData['Qa'],
            //     'Qb' => $validatedData['Qb'],
            //     'Qc' => $validatedData['Qc'],
            //     'Qsum' => $validatedData['Qsum'],
            //     'Sa' => $validatedData['Sa'],
            //     'Sb' => $validatedData['Sb'],
            //     'Sc' => $validatedData['Sc'],
            //     'Ssum' => $validatedData['Ssum'],
            //     'PFa' => $validatedData['PFa'],
            //     'PFb' => $validatedData['PFb'],
            //     'PFc' => $validatedData['PFc'],
            //     'PFsum' => $validatedData['PFsum'],
            //     'U_unbl' => $validatedData['U_unbl'],
            //     'I_unbl' => $validatedData['I_unbl'],
            //     'LCR' => $validatedData['LCR'],
            //     'P_Dmd' => $validatedData['P_Dmd'],
            //     'Q_Dmd' => $validatedData['Q_Dmd'],
            //     'S_Dmd' => $validatedData['S_Dmd'],
            //     'I1_Dmd' => $validatedData['I1_Dmd'],
            //     'I2_Dmd' => $validatedData['I2_Dmd'],
            //     'I3_Dmd' => $validatedData['I3_Dmd'],
            //     'Ep_Imp' => $validatedData['Ep_Imp'],
            //     'Ep_Exp' => $validatedData['Ep_Exp'],
            //     'Eq_Imp' => $validatedData['Eq_Imp'],
            //     'Eq_Exp' => $validatedData['Eq_Exp'],
            //     'Ep_sum' => $validatedData['Ep_sum'],
            //     'Ep_net' => $validatedData['Ep_net'],
            //     'Eq_sum' => $validatedData['Eq_sum'],
            //     'Eq_net' => $validatedData['Eq_net'],
            //     'Es' => $validatedData['Es'],
            //     'Epa_Imp' => $validatedData['Epa_Imp'],
            //     'Epa_Exp' => $validatedData['Epa_Exp'],
            //     'Epb_Imp' => $validatedData['Epb_Imp'],
            //     'Epb_Exp' => $validatedData['Epb_Exp'],
            //     'Epc_Imp' => $validatedData['Epc_Imp'],
            //     'Epc_Exp' => $validatedData['Epc_Exp'],
            //     'Eqa_Imp' => $validatedData['Eqa_Imp'],
            //     'Eqa_Exp' => $validatedData['Eqa_Exp'],
            //     'Eqb_Imp' => $validatedData['Eqb_Imp'],
            //     'Eqb_Exp' => $validatedData['Eqb_Exp'],
            //     'Eqc_Imp' => $validatedData['Eqc_Imp'],
            //     'Eqc_Exp' => $validatedData['Eqc_Exp'],
            //     'Esa' => $validatedData['Esa'],
            //     'Esb' => $validatedData['Esb'],
            //     'Esc' => $validatedData['Esc'],
            //     'PhsAngV2toV1' => $validatedData['PhsAngV2toV1'],
            //     'PhsAngV3toV1' => $validatedData['PhsAngV3toV1'],
            //     'PhsAngI1toV1' => $validatedData['PhsAngI1toV1'],
            //     'PhsAngI2toV1' => $validatedData['PhsAngI2toV1'],
            //     'PhsAngI3toV1' => $validatedData['PhsAngI3toV1'],
            // ]);

            // $metering->save();

            return response()->json(['message' => 'Data inserted successfully'], 201);
        } catch (\Exception $e) {
            // Log and return error if insertion fails
            Log::error('Error inserting data: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while inserting data.'], 500);
        }
    }

    // Show a specific metering
    public function show($id)
    {
        $metering = Metering::find($id);
        if (!$metering) {
            return response()->json(['error' => 'metering not found'], 404);
        }
        return response()->json($metering, 200);
    }

    // Update an metering
    public function update(Request $request, $id)
    {
        $metering = Metering::find($id);
        if (!$metering) {
            return response()->json(['error' => 'metering not found'], 404);
        }
        $metering->update($request->all());
        return response()->json($metering, 200);
    }

    // Delete an metering
    public function destroy($id)
    {
        $metering = Metering::find($id);
        if (!$metering) {
            return response()->json(['error' => 'metering not found'], 404);
        }
        $metering->delete();
        return response()->json(['message' => 'metering deleted'], 200);
    }

    public function getData()
    {
        // Fetch all relevant data from the database
        $data = Metering::select([
            'project', 'section', 'device', 'sn', 'status',
            'F', 'U1', 'U2', 'U3', 'Uavg', 'U12', 'U23', 'U31', 'Ulavg',
            'IL1', 'IL2', 'IL3', 'Iavg', 'In', 'Pa', 'Pb', 'Pc', 'Psum',
            'Qa', 'Qb', 'Qc', 'Qsum', 'Sa', 'Sb', 'Sc', 'Ssum',
            'PFa', 'PFb', 'PFc', 'PFsum', 'U_unbl', 'I_unbl', 'LCR',
            'P_Dmd', 'Q_Dmd', 'S_Dmd', 'I1_Dmd', 'I2_Dmd', 'I3_Dmd',
            'Ep_Imp', 'Ep_Exp', 'Eq_Imp', 'Eq_Exp', 'Ep_sum', 'Ep_net',
            'Eq_sum', 'Eq_net', 'Es', 'Epa_Imp', 'Epa_Exp', 'Epb_Imp',
            'Epb_Exp', 'Epc_Imp', 'Epc_Exp', 'Eqa_Imp', 'Eqa_Exp',
            'Eqb_Imp', 'Eqb_Exp', 'Eqc_Imp', 'Eqc_Exp', 'Esa', 'Esb',
            'Esc', 'PhsAngV2toV1', 'PhsAngV3toV1', 'PhsAngI1toV1',
            'PhsAngI2toV1', 'PhsAngI3toV1', 'updated_at'
        ])->get();

        return response()->json($data);
    }
}
