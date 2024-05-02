<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fichaje;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FichajeController extends Controller
{
    public function show(Request $request)
    {

        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];
            $id = $data['id'];

            $fichaje = Fichaje::on($nombreConexion)
                ->where('userId', $id)
                ->orderBy('hora_fichaje', 'desc')
                ->first();

            return response()->json($fichaje, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function altaFichaje(Request $request)
    {

        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];
            $id = $data['id'];

            $fichaje = new Fichaje();

            $fichaje->userId =  $data['id'];
            $fichaje->tipo_fichaje = $data['tipo_fichaje'];
            $fichaje->hora_fichaje = $data['hora_fichaje'];
            $fichaje->tipo_pausa = $data['tipo_pausa'];

            $fichaje->setConnection($nombreConexion);
            $fichaje->save();

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
