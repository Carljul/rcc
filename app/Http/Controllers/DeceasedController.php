<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Deceased;
use Illuminate\Http\Request;
use App\Http\Requests\DeceasedRequest;

class DeceasedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.deceased.index');
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
     * @param  App\Http\Requests\DeceasedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeceasedRequest $request)
    {
        $params = $request->all();

        $rtn = Deceased::register($params);

        if ($rtn['error']) {
            return response()->json([
                'error' => true,
                'message' => $rtn['message'],
                'data' => []
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => $rtn['message'],
            'data' => $rtn['data']
        ]);
    }

    /**
     * Display all resources.
     *
     * @param boolean $isDeleted returns deleted deceased if true
     * @return \Illuminate\Http\Response
     */
    public function list($isDeleted = false)
    {
        if ($isDeleted) {
            return response()->json([
                'data' => Deceased::whereNotNull('deleted_at')
                    ->with('person')
                    ->with('relative')
                    ->with('payment')
                    ->orderBy('created_at')
                    ->get()
            ]);
        }

        return response()->json([
            'data' => Deceased::whereNull('deleted_at')
                ->with('person')
                ->with('relative')
                ->with('payment')
                ->orderBy('created_at', 'DESC')
                ->get()
        ]);
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
            'data' => Deceased::show($id)->first()
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
    public function update(DeceasedRequest $request, $id)
    {
        $params = $request->all();
        $params['id'] = $id;

        $rtn = Deceased::updater($params);

        if ($rtn['error']) {
            return response()->json([
                'error' => true,
                'message' => $rtn['message'],
                'data' => []
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => $rtn['message'],
            'data' => $rtn['data']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rtn = Deceased::destroyRecord($id);

        if ($rtn['error']) {
            return response()->json([
                'error' => true,
                'message' => $rtn['message']
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => $rtn['message']
        ]);
    }

    /**
     * Approve specified resource.
     *
     * @param  Deceased $deceased
     * @return \Illuminate\Http\Response
     */
    public function approve(Deceased $deceased)
    {
        \DB::beginTransaction();
        try {
            $status = $deceased->isApprove;

            if ($status == 0) {
                $deceased->isApprove = 1;
                $deceased->approvedBy = Auth::user()->id;
            } else {
                $deceased->isApprove = 0;
                $deceased->approvedBy = null;
            }

            $deceased->save();

            \DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Approved'
            ]);
        } catch (\Exception $e) {
            \Log::erro(get_class().' '.$e);

            \DB::rollback();

            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
