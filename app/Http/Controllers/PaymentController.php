<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $data = Payment::create([
                'deceased_id' => $params['id'],
                'payer' => $params['payer'],
                'contact_number' => $params['contact_number'],
                'amount' => $params['amount'],
                'ORNumber' => $params['ornumber'],
                'balance' => $params['balance'],
                'terms_of_payment' => $params['temrs_of_payment'],
                'remarks' => $params['remarks'],
                'datePaid' => $params['datePaid'],
            ]);

            \DB::commit();

            return response()->json([
                'error' => false,
                'message' => $rtn['message'],
                'data' => $data
            ]);
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => Payment::where('deceased_id', $id)->get()
        ]);
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
        //
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
}
