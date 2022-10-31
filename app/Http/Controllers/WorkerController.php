<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $worker = Worker::all();

        return response()->json([
            'data' => [
                'worker' => $worker
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();

        $query = Worker::create($data);

        if($query)
        {
            return response()->json([
                'data' => [
                    'status' => true,
                    'msg' => 'Worker added successfully'
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'status' => false,
                'msg' => 'Oops! Something went wrong'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) : JsonResponse
    {
        //$worker = Worker::where('id',$id)->get();

        $worker = Worker::find($id);

        if($worker)
        {
            $get_address = $worker->address;
            //to check if there is no record with the given id
            return response()->json([
                'data' => [
                    'worker' => $worker,
                ]
            ]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $query = Worker::find($id);
        //To clarify - put method query params
        if($query)
        {
            $updateWorker = $query->update($data);

            return response()->json([
                'data' => [
                    'status' => true,
                    'msg' => 'Worker updated successfully'
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'status' => false,
                'msg' => 'Oops! Something went wrong'
            ]
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
        $query = Worker::find($id);

        if($query)
        {
            $deleteWorker = $query->delete();

            return response()->json([
                'data' => [
                    'status' => true,
                    'msg' => 'Worker deleted successfully'
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'status' => false,
                'msg' => 'Oops! Something went wrong'
            ]
        ]);
    }
}
