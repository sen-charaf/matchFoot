<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pay;
use Illuminate\Support\Facades\Validator;

class PayContoller extends Controller
{
    public function index()
    {
        return Pay::all();
    }

    public function show($id)
    {
        return Pay::find($id);
    }

    public function find($nationalite)
    {
        return Pay::where('nationalite', $nationalite)->first();
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nationalite' => 'required | string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pay = new Pay();
        $pay->nationalite = $request->nationalite;
        $pay->save();

        return response()->json(['message' => 'Pay created'], 201);
    }

    public function update(Request $request, $id)
    {
        $pay = Pay::find($id);

        if ($pay == null) {
            return response()->json(['error' => 'Pay not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nationalite' => 'required | string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pay->nationalite = $request->nationalite;
        $pay->save();

        return response()->json(['message' => 'Pay updated'], 200);
    }

    public function destroy($id)
    {
        $pay = Pay::find($id);

        if ($pay == null) {
            return response()->json(['error' => 'Pay not found'], 404);
        }

        $pay->delete();

        return response()->json(['message' => 'Pay deleted'], 200);
    }
}
