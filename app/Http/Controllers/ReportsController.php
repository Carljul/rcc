<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Reports::all();
        return view('pages.reports.index', compact('reports'));
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
            Reports::create([
                'name' => $params['name'],
                'htmlReport' => $params['htmlReport'],
                'fields' => $params['fields'],
                'reportType' => $params['reportType']
            ]);

            \DB::commit();
            return redirect()->back()->with(['message' => 'Saved']);
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

            \DB::rollback();

            return redirect()->back()->withErrors(['message' => 'Something went wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function show(Reports $report)
    {
        if (request()->ajax()) {
            return response()->json([
                'data' => $report
            ]);
        }
        return view('pages.reports.show', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reports $report)
    {
        \DB::beginTransaction();

        try {
            $params = $request->all();

            if (isset($params['isActiveOnly'])) {
                $isActive = $report->isActive;
                if ($isActive == 1) {
                    $report->isActive = 0;
                } else {
                    $report->isActive = 1;
                }
            } else {
                $report->name = $params['name'];
                $report->htmlReport = $params['htmlReport'];
                $report->fields = $params['fields'];
                $report->reportType = $params['reportType'];
            }

            $report->save();
            \DB::commit();
            return redirect()->back()->with(['message' => 'Saved']);
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

            \DB::rollback();

            return redirect()->back()->withErrors(['message' => 'Something went wrong']);
        }
    }

    public function report(Request $request)
    {
        dd($report);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reports $report)
    {
        \DB::beginTransaction();
        try {
            $report->delete();

            \DB::commit();

            return redirect()->back()->with(['message' => 'Deleted']);
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

            \DB::rollback();

            return redirect()->back()->withErrors(['message' => 'Something went wrong']);
        }
    }
}
