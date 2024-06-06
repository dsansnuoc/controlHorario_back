<?php

namespace App\Http\Controllers\Export\Csv;

use App\Http\Controllers\Api\Exports\FichajesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExportFichajeControllerCsv extends Controller
{
    //
    public function exportFichajesCsv(Request $request)
    {
        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];
            $userid = $data['userid'];
            $fInicial = $data['fInicial'];
            $fFinal = $data['fFinal'];

            return (new FichajesExport($userid, $fInicial, $fFinal, $nombreConexion))->download('fichajes_' . $userid . '.csv');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}