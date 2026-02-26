<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactos = Contacto::with('entidad')->get();
        return response()->json($contactos, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     
    *public function create()
    *{
    *    //
    *}
    */

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
    {
        $request->validate([
            'nombre'           => 'required|string|max:191|unique:contactos,nombre',
            'identificacion'   => 'required|string|max:191|unique:contactos,identificacion',
            'email'            => 'nullable|email|max:191|unique:contactos,email',
            'telefono'         => 'nullable|string|max:20',
            'direccion'        => 'nullable|string|max:255',
            'notas'            => 'nullable|string',
            'entidad_id'       => 'required|exists:entidades,id',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $contacto = Contacto::create($request->all());

        // load('entity') loads the relationship into the newly created object to return it in the response
        return response()->json($contacto->load('entidad'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contacto = Contacto::with('entidad')->find($id);

        if (!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($contacto, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     
    *public function edit(Contacto $contacto)
    *{
    *    //
    *}
    */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contacto = Contacto::find($id);

        if (!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'nombre'           => 'required|string|max:191|unique:contactos,nombre,' . $id,
            'identificacion'   => 'required|string|max:191|unique:contactos,identificacion,' . $id,
            'email'            => 'nullable|email|max:191|unique:contactos,email,' . $id,
            'telefono'         => 'nullable|string|max:20',
            'direccion'        => 'nullable|string|max:255',
            'notas'            => 'nullable|string',
            'entidad_id'       => 'required|exists:entidades,id',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $contacto->update($request->all());
        return response()->json($contacto->load('entidad'), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contacto = Contacto::find($id);

        if (!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $contacto->delete();
        return response()->json(['message' => 'Contacto eliminado correctamente'], Response::HTTP_OK);
    }
}
