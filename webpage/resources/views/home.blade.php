@extends('layouts.app')

@section('content')
        <section class="flex flex-col mx-11">
            <p class="text-center text-3xl font-bold m-1">Accesos recientes</p>

            <div class="mt-4">
                <p class="text-lg text-slate-700 font-bold border-b border-slate-500 w-auto">Filtros</p>
                <form method="GET" action="{{ route('filter') }}" class="flex gap-4 mt-6" id="filterForm">
                    <div class="border-r pr-3 border-slate-500">
                        <label for="start_date" class="font-semibold text-slate-700">Desde:</label>
                        <input type="datetime-local" id="start_date" name="start_date" value="{{ request('start_date') }}" class="rounded-md border-none text-slate-700">
                        <span class="mr-1"></span>
                        <label for="end_date" class="font-semibold text-slate-700">Hasta:</label>
                        <input type="datetime-local" id="end_date" name="end_date" value="{{ request('end_date') }}" class="rounded-md border-none text-slate-700">
                    </div>
                    
                    <div>
                        <label for="worker_id" class="font-semibold text-slate-700">Matricula:</label>
                        <input type="text" id="worker_id" name="worker_id" value="{{ request('worker_id') }}" class="rounded-md border-none" placeholder="Ingrese matricula...">
                    </div>

                    <div>
                        <label for="action">Acción:</label>
                        <select name="action" id="action" class="rounded-md border-none text-slate-700">
                            <option value="">Selecciona</option>
                            <option value="entrada" {{ request('action') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                            <option value="salida" {{ request('action') == 'salida' ? 'selected' : '' }}>Salida</option>
                        </select>
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
                                Fecha
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
                                    {{ $worker->date }}
                                </td>
                                <td class="px-6 py-4 {{ $worker->action == 'entrada' ? 'text-green-400' : 'text-red-400' }}">
                                {{ $worker->action }}
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