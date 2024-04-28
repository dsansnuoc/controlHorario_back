<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoParada;
use App\Models\TipoPausa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TipoParadaController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->json()->all();
        $nombreConexion = $data['nombreConexion'];
        $tipoParada = TipoParada::on($nombreConexion)->get();
        return $tipoParada;
    }

    public function show(Request $request)
    {

        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];
            $id = $data['id'];

            $tipoParada = TipoParada::on($nombreConexion)->findOrFail($id);
            return response()->json($tipoParada, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];

            $tipoParada = new TipoParada();
            $tipoParada->descripcion = $data['descripcion'];
            $tipoParada->setConnection($nombreConexion);
            $tipoParada->save();

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

            $tipoParada = TipoParada::on($nombreConexion)->findOrFail($id);
            $tipoParada->descripcion = $data['descripcion'];
            $tipoParada->setConnection($nombreConexion);
            $tipoParada->save();

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
