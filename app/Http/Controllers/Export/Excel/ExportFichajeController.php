<?php

namespace App\Http\Controllers\Export\Excel;

use App\Http\Controllers\Api\Exports\FicjajesExport;
use App\Http\Controllers\Api\Exports\RolesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Roles;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

//use Maatwebsite\Excel\Excel;

// use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Row;

class ExportFichajeController extends Controller
{
    public function exportRol()
    {


        return (new RolesExport(2))->download('users.xlsx');

        // return (new RolesExport(2))->download('users.csv', \Maatwebsite\Excel\Excel::CSV);

        /*
        $data = Roles::all()->toArray(); // Obtén los datos de tu tabla

        return Excel::download(function ($excel) use ($data) {
            $excel->sheet('SheetName', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        }, 'nombre_del_archivo.xlsx');

        return Roles::all()->downloadExcel('users.xlsx');
        */
    }

    public function exportFichajes(Request $request)
    {
        try {
            $data = $request->json()->all();
            $nombreConexion = $data['nombreConexion'];
            $userid = $data['userid'];

            return (new FicjajesExport($userid, $nombreConexion))->download('fichajes_' . $userid . '.xlsx');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
