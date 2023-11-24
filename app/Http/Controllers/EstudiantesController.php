<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //view students
        return Estudiante::all();
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create student
        $inputs = $request->input();
        $respuesta = Estudiante::create($inputs);
        return response()->json([
            'data' => $respuesta,
            'mensaje' => "Estudiante creado con éxito.",
        ]);
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //single student query
        $e = Estudiante::find($id);
        //estudent exists
        if (isset($e)) {
            return response()->json([
                'data' => $e,
                'mensaje' => "Estudiante encontrado con éxito.",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe el estudiante.",
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        //update student
        $e = Estudiante::find($id);
        //estudent exists
        if (isset($e)) {
            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;
            if ($e->save()) {
                return response()->json([
                    'data' => $e,
                    'mensaje' => "Estudiante actualizado con éxito.",
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => "No se actualizó el estudiante",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe el estudiante.",
            ]);
        }
    }

    /**
     *
     */

    public function destroy($id)
    {
        //single student query
        $e = Estudiante::find($id);
        //estudent exists
        if (isset($e)) {
            $res = Estudiante::destroy($id);
            if ($res) {
                return response()->json([
                    'data' => $e,
                    'mensaje' => "Estudiante eliminado con éxito.",
                ]);
            } else {
                return response()->json([
                    'data' => $e,
                    'mensaje' => "Estudiante no existe.",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe el estudiante.",
            ]);
        }
    }
}