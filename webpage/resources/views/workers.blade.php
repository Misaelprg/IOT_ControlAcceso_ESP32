@extends('layouts.app')

@section('content')
    <section class="flex flex-col mx-11 h-screen">
        <p class="text-center text-3xl font-bold m-1">Trabajadores</p>

        <div class="mt-4">
            <p class="text-lg text-slate-700 font-bold border-b border-slate-500 w-auto">Filtros</p>
            <form method="GET" action="{{ route('workersfilter') }}" class="flex gap-4 mt-6 items-center" id="filterForm">                
                <div>
                    <label for="action" class="font-semibold text-slate-700">No Registrados:</label>
                    <input type="checkbox" name="registered[]" id="registered" class="rounded-md border-none">
                </div>

                <div>
                    <label for="worker_id" class="font-semibold text-slate-700">Matricula:</label>
                    <input type="text" id="worker_id" name="worker_id" value="{{ request('worker_id') }}" class="rounded-md border-none" placeholder="Ingrese matricula...">
                </div>

                <div class="flex-grow">
                    <label for="rows_limit" class="font-semibold text-slate-700">Max. Registros:</label>
                    <input type="number" id="rows_limit" name="rows_limit" min="1" value="{{ request('rows_limit') }}" class="rounded-md border-none" placeholder="Limite a listar...">
                </div>

                <button type="button" class="px-3 py-2 ml-2 rounded-md text-slate-700 bg-white font-semibold" onclick="resetForm()">Reiniciar</button>
                <button type="submit" class="px-3 py-2 ml-2 rounded-md text-slate-700 bg-white font-semibold">Filtrar</button>
            </form>

            <p class="mt-4 text-left text-xl text-slate-700">Registros: <span class="font-bold">{{count($workers)}}</span></p>
        </div>
        
        <div class="overflow-y-auto h-2/3 mt-4">
            <table class="table-auto overflow-scroll w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 relative overflow-x-auto shadow-md">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Matricula
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Area
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Huella
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Accion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($workers as $worker)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $worker->name . ' ' . $worker->paternal_lastname . ' ' . $worker->maternal_lastname }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $worker->worker_code }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $worker->area }}
                            </td>
                            <td class="px-6 py-4">
                                @if ( $worker->finger_id == null )
                                    Sin Asignar
                                @else
                                    Asignado
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ( $worker->finger_id == null )
                                    <form method="GET" action="{{ route('workerSavePrint') }}">
                                        <input type="hidden" name="worker_fid" value="{{ $worker->id }}">
                                        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tomar Huella</button>
                                    </form>
                                @else
                                    <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Reset</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="bg-white p-5 text-center">No se encontraron registros.</td>
                        </tr>    
                    @endforelse
                    </tbody>
            </table>
        </div>
    </section>
@endsection