<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //create user
        $inputs = $request->input();
        $inputs["password"] = Hash::make(trim($request->password));

        $respuesta = User::create($inputs);
        return response()->json([
            'data' => $respuesta,
            'mensaje' => "Registrado con éxito.",
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //single student query
        $e = User::find($id);
        //estudent exists
        if (isset($e)) {
            return response()->json([
                'data' => $e,
                'mensaje' => "Encontrado con éxito.",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe.",
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //update student
        $e = User::find($id);
//estudent exists
        if (isset($e)) {
            $e->first_name = $request->first_name;
            $e->last_name = $request->last_name;
            $e->email = $request->email;
            $e->password = Hash::make($request->password); //hash to hide password
            if ($e->save()) {
                return response()->json([
                    'data' => $e,
                    'mensaje' => "Usuario actualizado con éxito.",
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => "No se actualizó el usuario",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe el usuario.",
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //single student query
        $e = User::find($id);
//estudent exists
        if (isset($e)) {
            $res = User::destroy($id);
            if ($res) {
                return response()->json([
                    'data' => $e,
                    'mensaje' => "Eliminado con éxito.",
                ]);
            } else {
                return response()->json([
                    'data' => $e,
                    'mensaje' => "No existe.",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe.",
            ]);
        }

    }
}