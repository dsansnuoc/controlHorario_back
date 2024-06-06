<?php

namespace App\Http\Controllers\Export\Pdf;

use App\Http\Controllers\Api\Exports\FichajesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Barryvdh\DomPDF\Facade\Pdf;

class ExportFichajeControllerPdf extends Controller
{
    public function exportFichajesPdf(Request $request)
    {
        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];
            $userid = $data['userid'];
            $fInicial = $data['fInicial'];
            $fFinal = $data['fFinal'];

            $fichajes = new FichajesExport($userid, $fInicial, $fFinal, $nombreConexion);

            $pdf = Pdf::loadView('pdf.fichajes', ['fichajes' => $fichajes]);


            return $pdf->download('fichajes_' . $userid . '.pdf');

            //            return (new FichajesExport($userid, $fInicial, $fFinal, $nombreConexion))->download('fichajes_' . $userid . '.csv');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}