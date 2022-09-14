<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return response()->json([
            'data' => Contract::where('deceased_id', $id)->with('payment')->with('reports')->get()
        ]);
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
        \DB::beginTransaction();
        try {
            $params = $request->all();
            Contract::create([
                'deceased_id' => $params['deceased_id_form'],
                'payment_id' => array_key_exists('lease_amount_select_field', $params) ? $params['lease_amount_select_field'] : null,
                'reports_id' => array_key_exists('report', $params) ? $params['report'] : null,
                'lessee' => array_key_exists('lesse_field', $params) ? $params['lesse_field'] : null,
                'niche_identification_number' => array_key_exists('niche_identification_field', $params) ? $params['niche_identification_field'] : null,
                'contract_number' => array_key_exists('contract_number_field', $params) ? $params['contract_number_field'] : null,
                'address' => array_key_exists('address_field', $params) ? $params['address_field'] : null,
                'remarks' => array_key_exists('remarks', $params) ? $params['remarks'] : null,
                'date_start' => array_key_exists('date_start_field', $params) ? $params['date_start_field'] : null,
                'date_expire' => array_key_exists('date_expire_field', $params) ? $params['date_expire_field'] : null
            ]);

            \DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Saved',
                'data' => Contract::where('deceased_id', $params['deceased_id_form'])->with('payment')->get()
            ]);
        } catch (\Exception $e) {
            \Log::error(get_class().' store(): '.$e);

            \DB::rollback();

            return response()->json([
                'error' => true,
                'message' => 'Something Went Wrong',
                'data' => []
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => Contract::where('id', $id)
                ->with('payment')
                ->with('reports')
                ->with(['deceased' => function ($others) {
                    $others->with('person')
                    ->with('approvedBy')
                    ->with('createdBy')
                    ->with('updatedBy')
                    ->with('deletedBy');
                }])
                ->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'data' => Contract::where('deceased_id', $id)
                ->with('payment')
                ->with('reports')
                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        \DB::beginTransaction();
        try {
            $params = $request->all();
            $contract->payment_id = array_key_exists('lease_amount_select_field', $params) ? $params['lease_amount_select_field'] : null;
            $contract->lessee = array_key_exists('lesse_field', $params) ? $params['lesse_field'] : null;
            $contract->niche_identification_number = array_key_exists('niche_identification_field', $params) ? $params['niche_identification_field'] : null;
            $contract->contract_number = array_key_exists('contract_number_field', $params) ? $params['contract_number_field'] : null;
            $contract->address = array_key_exists('address_field', $params) ? $params['address_field'] : null;
            $contract->remarks = array_key_exists('remarks', $params) ? $params['remarks'] : null;
            $contract->date_start = array_key_exists('date_start_field', $params) ? $params['date_start_field'] : null;
            $contract->date_expire = array_key_exists('date_expire_field', $params) ? $params['date_expire_field'] : null;
            $contract->save();

            \DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Updated',
                'data' => Contract::where('deceased_id', $params['deceased_id_form'])->with('payment')->get()
            ]);
        } catch (\Exception $e) {
            \Log::error(get_class().' update(): '.$e);

            \DB::rollback();

            return response()->json([
                'error' => true,
                'message' => 'Something Went Wrong',
                'data' => []
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        \DB::beginTransaction();
        try {
            $id = $contract->deceased_id;
            $contract->delete();
            \DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Updated',
                'data' => Contract::where('deceased_id', $id)->with('payment')->get()
            ]);
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

            \DB::rollback();


            \DB::commit();

            return response()->json([
                'error' => true,
                'message' => 'Something Went Wrong',
                'data' => []
            ]);
        }
    }
}
