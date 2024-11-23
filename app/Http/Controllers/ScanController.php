<?php

namespace App\Http\Controllers;

use App\Models\Scan;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Scan::get();

        return response()->json([
            "status" => "success",
            "message" => "oke",
            "data" => $data,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $validator = validator::make(
            $request->all(),
            [
                'title' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => "validation errors",
                'errors' => $validator->errors(),
                'data' => []
            ]);
        }

        $scan = new Scan();
        $scan->title = $request->title;

        $result = $scan->save();

        if ($result) {
            return response()->json([
                "status" => "success",
                "message" => "save data success"
                "data" => []
            ], 200);
        } else {
            return response()->json([
                "status"=> "error",
                "message"=> "save data failed",
            ], 200);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);

        $data = Scan::find($id);

        return response()->json([
            "status" => "success",
            "message" => "oke",
            "data" => $data,
        ],200);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $scan = Scan::find($id);

        if ($scan == null) {
            return response()->json([
                "status" => "error",
                "message" => "scan not found",
                "data" => []
            ], 200);
    }

    $scan->title = $request->title;

    $result = $scan->save();

    if ($result) {
        return response()->json([
            "status" => "success",
            "message" => "update data success",
            "data" => []
        ], 200);
    } else {
        return response()->json([
            "status"=> "error",
            "message"=> "update data failed",
        ], 200);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
