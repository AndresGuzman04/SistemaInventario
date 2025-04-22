<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePresentacionesRequest;
use App\Http\Requests\UpdatePresentacionesRequest;
use App\Models\Caracteristica;
use App\Models\Presentacione;
use Exception;
use Illuminate\Support\Facades\DB;

class PresentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get();
        return view('presentaciones.index', ['presentaciones' => $presentaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('presentaciones.create', [
            'redirect' => $request->input('redirect')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresentacionesRequest $request)
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->presentacione()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }


        // Redirección condicional
        if ($request->filled('redirect') && $request->input('redirect') === 'productos.create') {
            $old = json_decode($request->input('old'), true);
            return redirect()->route('productos.create')->withInput($old)->with('success', 'Presentación creada');
        }

        return redirect()->route('presentaciones.index')->with('success', 'Presentación registrada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presentacione $presentacione)
    {
        return view('presentaciones.edit', ['presentacione' => $presentacione]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentacionesRequest $request, Presentacione $presentacione)
    {
        Caracteristica::where('id', $presentacione->caracteristica->id)
        ->update($request->validated());

        return redirect()->route('presentaciones.index')->with('success', 'Presentación editada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $presentacione = Presentacione::find($id);
        if ($presenpresentacionetacion->caracteristica->estado == 1) {
            Caracteristica::where('id', $presentacione->caracteristica->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Presentación eliminada';
        } else {
            Caracteristica::where('id', $presentacione->caracteristica->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Presentación restaurada';
        }

        return redirect()->route('presentaciones.index')->with('success', $message);
    }
}
