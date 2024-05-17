<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Solicitudes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SolicitudesController extends Controller
{
    public function show(Request $request)
    {
        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];
            $id = $data['id'];

            $solicitudes = Solicitudes::on($nombreConexion)
                ->where('userId', $id)
                ->orderBy('fecha_solicitud', 'desc')
                ->all();

            return response()->json($solicitudes, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function store(Request $request)
    {

        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];

            $solicitud = new Solicitudes();

            $solicitud->userId  = $data['userId'];
            $solicitud->tipo_solicitud  = $data['tipo_solicitud'];
            $solicitud->fecha_solicitud  = $data['fecha_solicitud'];
            $solicitud->fecha_inicio  = $data['fecha_inicio'];
            $solicitud->fecha_fin  = $data['fecha_fin'];
            $solicitud->setConnection($nombreConexion);
            $solicitud->save();

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];

            $solicitud = Solicitudes::on($nombreConexion)->findOrFail($id);

            switch ($data['tipo_update']) {

                case 'R':
                    $solicitud->fecha_rechazada  = $data['fecha_rechazada'];
                    $solicitud->rechazada  = $data['rechazada'];
                    break;

                case 'A':
                    $solicitud->fecha_aceptada  = $data['fecha_aceptada'];
                    $solicitud->aceptada  = $data['aceptada'];
                    break;

                case 'M':
                    $solicitud->tipo_solicitud  = $data['tipo_solicitud'];
                    $solicitud->fecha_inicio  = $data['fecha_inicio'];
                    $solicitud->fecha_fin  = $data['fecha_fin'];
                    break;
            }
            $solicitud->setConnection($nombreConexion);
            $solicitud->save();

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
