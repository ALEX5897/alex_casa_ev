<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPassengerRequest;
use App\Http\Requests\StorePassengerRequest;
use App\Http\Requests\UpdatePassengerRequest;
use App\Models\Flight;
use App\Models\Passenger;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PassengerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('passenger_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passengers = Passenger::with(['vuelos'])->get();

        return view('admin.passengers.index', compact('passengers'));
    }

    public function create()
    {
        abort_if(Gate::denies('passenger_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vuelos = Flight::pluck('name', 'id');

        return view('admin.passengers.create', compact('vuelos'));
    }

    public function store(StorePassengerRequest $request)
    {
        $passenger = Passenger::create($request->all());
        $passenger->vuelos()->sync($request->input('vuelos', []));

        return redirect()->route('admin.passengers.index');
    }

    public function edit(Passenger $passenger)
    {
        abort_if(Gate::denies('passenger_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vuelos = Flight::pluck('name', 'id');

        $passenger->load('vuelos');

        return view('admin.passengers.edit', compact('passenger', 'vuelos'));
    }

    public function update(UpdatePassengerRequest $request, Passenger $passenger)
    {
        $passenger->update($request->all());
        $passenger->vuelos()->sync($request->input('vuelos', []));

        return redirect()->route('admin.passengers.index');
    }

    public function show(Passenger $passenger)
    {
        abort_if(Gate::denies('passenger_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passenger->load('vuelos');

        return view('admin.passengers.show', compact('passenger'));
    }

    public function destroy(Passenger $passenger)
    {
        abort_if(Gate::denies('passenger_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passenger->delete();

        return back();
    }

    public function massDestroy(MassDestroyPassengerRequest $request)
    {
        $passengers = Passenger::find(request('ids'));

        foreach ($passengers as $passenger) {
            $passenger->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
