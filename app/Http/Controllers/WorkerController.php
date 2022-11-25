<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Worker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $worker = Worker::with('address')->get();

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

        $worker  = Arr::only($data, ['name', 'email', 'mobile']);
        $query = Worker::create($worker);

        if($query->id)
        {
            $address = Arr::except($data, ['name', 'email', 'mobile']);
            $query->address()->create($address);
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
        $worker = Worker::where('id', $id)->with('address')->get();
        // $worker = Worker::find($id)->load('address');

        /**
         * This below code is not a ideal way to get the address record
         */
        // $worker = Worker::find($id);
        // $worker = $worker->address()->get();

        // $address = Address::where('worker_id', $id)->with('worker')->get();

        if($worker)
        {
            //to check if there is no record with the given id
            return response()->json([
                'data' => [
                    'worker' => $worker,
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
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */

    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->all();
        $query = Worker::find($id);
        //To clarify - put method query params
        if($query)
        {
            $worker  = Arr::only($data, ['name', 'email', 'mobile']);
            $updateWorker = $query->update($worker);
            if($updateWorker)
            {
                $address = Arr::except($data, ['name', 'email', 'mobile']);
                $query->address()->update($address);
            }
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
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $query = Worker::find($id);
        if($query)
        {
            $query->address()->delete();
            $query->delete();
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
