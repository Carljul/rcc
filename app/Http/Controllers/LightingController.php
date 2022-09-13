<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Lighting;
use App\Models\Deceased;
use Illuminate\Http\Request;
use App\Http\Requests\LightingRequest;

class LightingController extends Controller
{
    public function store(LightingRequest $request)
    {
        // validator
        $validator = $request->validateApi();
        if ($validator['error']) {
            return $validator;
        }

        DB::beginTransaction();
        try {
            $params = $request->all();

            $lighting = Lighting::create([
                'deceased_id' => $params['id'],
                'name' => $params['name'],
                'dateOfConnection' => $params['dateOfConnection'],
                'expiryDate' => $params['expiryDate'],
                'amount' => $params['amount'],
                'ORNumber' => $params['ornumber'],
            ]);

            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Saved',
                'data' => $lighting
            ]);
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

            DB::rollback();

            return response()->json([
                'error' => true,
                'message' => 'Something Went Wrong',
                'data' => []
            ]);
        }
    }

    public function update(LightingRequest $request, Lighting $lighting)
    {
        // validator
        $validator = $request->validateApi();
        if ($validator['error']) {
            return $validator;
        }

        DB::beginTransaction();
        try {
            $params = $request->all();
            $lighting->update($params);
            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated!',
                'data' => $lighting
            ]);

        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

            DB::rollback();

            return response()->json([
                'error' => true,
                'message' => 'Something Went Wrong',
                'data' => []
            ]);
        }
    }

    public function show($deceasedId)
    {
        return response()->json([
            'data' => Lighting::where('deceased_id', $deceasedId)->get(),
            'recordOf' => Deceased::show($deceasedId)->first()
        ]);
    }

    public function lighting($id)
    {
        return response()->json([
            'data' => Lighting::where('id', $id)
                ->with('deceased')
                ->first()
        ]);
    }

    public function delete(Lighting $lighting)
    {
        \DB::beginTransaction();
        try {
            $deceasedId = $lighting->deceased_id;
            $lighting->delete();

            \DB::commit();

            return response()->json([
                'error' => false,
                'data'  => $deceasedId,
                'message' => 'Deleted'
            ]);
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

            \DB::rollback();

            return response()->json([
                'error' => true,
                'data'  => null,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
