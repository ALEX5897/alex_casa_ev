<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFlightRequest;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Models\Flight;
use App\Models\Passenger;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FlightController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('flight_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $flights = Flight::with(['pasajeros'])->get();

        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        abort_if(Gate::denies('flight_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pasajeros = Passenger::pluck('nombre', 'id');

        return view('admin.flights.create', compact('pasajeros'));
    }

    public function store(StoreFlightRequest $request)
    {
        $flight = Flight::create($request->all());
        $flight->pasajeros()->sync($request->input('pasajeros', []));

        return redirect()->route('admin.flights.index');
    }

    public function edit(Flight $flight)
    {
        abort_if(Gate::denies('flight_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pasajeros = Passenger::pluck('nombre', 'id');

        $flight->load('pasajeros');

        return view('admin.flights.edit', compact('flight', 'pasajeros'));
    }

    public function update(UpdateFlightRequest $request, Flight $flight)
    {
        $flight->update($request->all());
        $flight->pasajeros()->sync($request->input('pasajeros', []));

        return redirect()->route('admin.flights.index');
    }

    public function show(Flight $flight)
    {
        abort_if(Gate::denies('flight_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $flight->load('pasajeros');

        return view('admin.flights.show', compact('flight'));
    }

    public function destroy(Flight $flight)
    {
        abort_if(Gate::denies('flight_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $flight->delete();

        return back();
    }

    public function massDestroy(MassDestroyFlightRequest $request)
    {
        $flights = Flight::find(request('ids'));

        foreach ($flights as $flight) {
            $flight->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
