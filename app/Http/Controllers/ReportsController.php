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
            Reports::create([
                'name' => $params['name'],
                'htmlReport' => $params['htmlReport'],
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
    public function show(Reports $reports)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function edit(Reports $reports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reports $reports)
    {
        \DB::beginTransaction();

        try {
            $params = $request->all();

            $reports->name = $params['name'];
            $reports->htmlReport = $params['htmlReport'];

            $reports->save();
            \DB::commit();
            return redirect()->back()->with(['message' => 'Saved']);
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

            \DB::rollback();

            return redirect()->back()->withErrors(['message' => 'Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reports $reports)
    {
        //
    }
}
