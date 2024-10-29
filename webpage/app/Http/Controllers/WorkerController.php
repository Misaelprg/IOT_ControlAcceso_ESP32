<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WorkerController extends Controller
{
    public function index()
    {
        //Code to display all workers info, even if theyre not atached to the ESP32 system.
        $workers = DB::table('workers')->get();

        return view('workers', ['workers' => $workers]);
    }

    public function filter(Request $request)
    {
        
        $rowsLimit = $request->input('rows_limit');        
        $registered = $request->input('registered');        
        $workerId = $request->input('worker_id');

        $query = DB::table('workers');
        if($registered != null) {
            $query->whereNull('finger_id');
        }

        if ($workerId) {
            $query->where('workers.worker_code', $workerId);
        }

        if(!isset($rowsLimit)) {
            $rowsLimit = 264;
        } 
    

        $records = $query
                        ->limit($rowsLimit)
                        ->get();

        return view('workers', ['workers' => $records]);
    }
    
    public function saveFingerPrint(Request $request)
    {
        $worker_id = $request->input('worker_fid');
        $response = Http::get("http://192.168.0.122/register_id", [
            'worker_fid' => $worker_id,
        ]);

        return redirect()->route('workers.index')->with('status', 'ID enviado al ESP32: ' . $worker_id);
    }
}
