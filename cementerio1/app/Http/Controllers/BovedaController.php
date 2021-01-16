<?php

namespace App\Http\Controllers;

use App\Models\Boveda;
use Illuminate\Http\Request;

class BovedaController extends Controller
{
    //GET
    public function index(Request $request)
    {
        if($request->has('txtBuscar'))
        {
            $bovedas = Boveda::where('nombre','like','%' . $request->txtBuscar . '%')->get();
        }
        else
        {
            $bovedas = Boveda::all();
        }

        return $bovedas;
    }

    //POST Insertar
    public function store(Request $request)
    {
        $input = $request->all();
        Boveda::create($input);
        return response()->json([
            'res' => true,
            'message' => 'Registro insertado'
        ],200);
    }

   //GET 1 SOLO REGISTRO
    public function show(Boveda $boveda)
    {
        return $boveda;
    }

    //PUT Update
    public function update(Request $request, Boveda $boveda)
    {
        $input = $request->all();
        $boveda->update($input);
        return response()->json([
            'res' => true,
            'message' => 'Registro actualizado'
        ],200);
    }

  
    //DELETE
    public function destroy($id)
    {
        Boveda::destroy($id);
        return response()->json([
            'res' => true,
            'message' => 'Registro eliminado'
        ],200);
    }
}
