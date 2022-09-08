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
        dd($defaults);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DefaultCertificate  $defaultCertificate
     * @return \Illuminate\Http\Response
     */
    public function show(DefaultCertificate $defaultCertificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DefaultCertificate  $defaultCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(DefaultCertificate $defaultCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DefaultCertificate  $defaultCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DefaultCertificate $defaultCertificate)
    {
        //
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
