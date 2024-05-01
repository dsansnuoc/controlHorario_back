<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoSolicitud;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TipoSolicitudController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->json()->all();
        $nombreConexion = $data['nombreConexion'];
        $tipoSolicitud = TipoSolicitud::on($nombreConexion)->get();
        return $tipoSolicitud;
    }

    public function show(Request $request)
    {

        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];
            $id = $data['id'];

            $tipoSolicitud = TipoSolicitud::on($nombreConexion)->findOrFail($id);
            return response()->json($tipoSolicitud, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];

            $tipoSolicitud = new TipoSolicitud();
            $tipoSolicitud->description = $data['description'];
            $tipoSolicitud->setConnection($nombreConexion);
            $tipoSolicitud->save();

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

            $tipoSolicitud = TipoSolicitud::on($nombreConexion)->findOrFail($id);
            $tipoSolicitud->description = $data['description'];
            $tipoSolicitud->setConnection($nombreConexion);
            $tipoSolicitud->save();

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
