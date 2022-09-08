<?php

namespace App\Http\Controllers;

use App\Models\DefaultCertificate;
use Illuminate\Http\Request;

class DefaultCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $defaults = DefaultCertificate::first();
        return view('pages.defaults.index', compact('defaults'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DefaultCertificate  $defaultCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DefaultCertificate $default)
    {
        \DB::beginTransaction();
        try {
            $params = $request->all();

            $default->cemetery_administrator = $params['cemetery_administrator'];
            $default->parish_office_staff = $params['parish_office_staff'];
            $default->parish_team_moderator = $params['parish_team_moderator'];
            $default->parish_team_member = $params['parish_team_member'];
            $default->save();

            \DB::commit();

            return redirect()->back()->with(['message' => 'Saved']);
        } catch (\Exception $e) {
            \Log::error(get_class().' update() '.$e);

            \DB::rollback();

            return redirect()->back()->withErrors(['message' => 'Something Went Wrong']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DefaultCertificate  $defaultCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(DefaultCertificate $defaultCertificate)
    {
        //
    }
}
