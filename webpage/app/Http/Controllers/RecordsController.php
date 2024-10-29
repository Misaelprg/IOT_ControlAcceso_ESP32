<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RecordsController extends Controller
{
    public function index()
    {
        // Mostrando todos los registros, con un limite de 100 registros, en el dia actual.
        $today = now()->subDay()->toDateString();

        $workers = DB::table('workers')
            ->join('registers_records', 'workers.id', '=', 'registers_records.worker_id')
            ->select('workers.name', 'workers.paternal_lastname', 'workers.maternal_lastname', 
            'workers.worker_code', 'workers.area', 'registers_records.date', 'registers_records.action')
            ->where('registers_records.date', '>=', $today. ' 00:00:00')
            ->orderBy('registers_records.date')
            ->limit(100)
            ->get();

        return view('home', ['workers' => $workers]);
    }

    public function filter(Request $request) {
        // Mostrando registros con ciertos filtros.
        
        $startDate = $request->input('start_date');  // Filtrar por fecha de inicio
        $endDate = $request->input('end_date');      // Filtrar por fecha de fin
        $workerId = $request->input('worker_id');    // Filtrar por trabajador específico
        $action = $request->input('action');         // Filtrar por acción (entrada/salida)
        $rowsLimit = $request->input('rows_limit');  // Limite de registros           

        $query = DB::table('workers')
            ->join('registers_records', 'workers.id', '=', 'registers_records.worker_id')
            ->select('workers.name', 'workers.paternal_lastname', 'workers.maternal_lastname', 
                    'workers.worker_code', 'workers.area', 'registers_records.date', 'registers_records.action');
        
        if ($startDate && $endDate) {
            $query->whereBetween('registers_records.date', [$startDate, $endDate]);
        } elseif (isset($startDate)) {
            $query->where('registers_records.date', '>=', $startDate);
        } elseif (isset($endDate)) {
            $query->where('registers_records.date', '<=', $endDate);
        }

        if ($workerId) {
            $query->where('workers.worker_code', $workerId);
        }

        if ($action) {
            $query->where('registers_records.action', $action);
        }

        $records = $query->orderBy('registers_records.date')
                        ->limit($rowsLimit)
                        ->get();

        
        return view('home', ['workers' => $records]);
    }
}
