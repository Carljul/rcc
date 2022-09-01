<?php

namespace App\Http\Controllers;

use App\Models\Lighting;
use Illuminate\Http\Request;

class LightingController extends Controller
{
    public function show($id)
    {
        return response()->json([
            'data' => Lighting::find($id)
        ]);
    }
}
