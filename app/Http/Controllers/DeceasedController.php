<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Reports;
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
     * Show the deleted records.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted()
    {
        $deleted = Deceased::deletedR();
        return view('pages.deceased.deleted', compact('deleted'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\DeceasedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeceasedRequest $request)
    {
        // validator
        $validateRequest = $request->validateApi();
        if ($validateRequest['error']) {
            return $validateRequest;
        }

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
                'data' => Deceased::deletedR()
            ]);
        }

        return response()->json([
            'data' => Deceased::whereNull('deleted_at')
                ->with('payment')
                ->with('person')
                ->orderBy('created_at', 'DESC')
                ->get(),
            'reports' => Reports::where('isActive', 1)->get()
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeceasedRequest $request, $id)
    {
        // validator
        $validateRequest = $request->validateApi();
        if ($validateRequest['error']) {
            return $validateRequest;
        }

        $params = $request->all();
        $params['id'] = $id;

        $rtn = Deceased::updater($params);

        if (!request()->ajax()) {
            return redirect()->back()->with('result', $rtn);
        }

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('pages.deceased.import');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function expired(Request $request)
    {
        $param = $request->all();
        $year = date('Y');
        $month = date('m');

        if (array_key_exists('year', $param)) {
            $year = $param['year'];
        }

        if (array_key_exists('month', $param)) {
            $month = $param['month'];
        }

        $selectedYear = $year;
        $selectedMonth = $month;

        $years = Deceased::selectRaw('YEAR(expiryDate) AS expiry')
            ->whereNull('deleted_at')
            ->whereNotNull('expiryDate')
            ->groupBy('expiry')
            ->orderBy('expiry')
            ->get()
            ->pluck('expiry')
            ->toArray();

        $data = Deceased::expired($year, $month);

        if (!in_array(date('Y'), $years)) {
            array_push($years, date('Y'));
        }

        return view('pages.deceased.expire', compact('years', 'selectedYear', 'selectedMonth', 'data'));
    }
}
