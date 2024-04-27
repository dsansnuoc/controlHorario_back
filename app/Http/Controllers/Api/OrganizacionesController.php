<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganizacionesController extends Controller
{
    public function index()
    {
        return Organizacion::all();
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();

        try {
            Organizacion::create([
                'name' => $data['name'],
                'nif' =>  $data['nif'],
                'email' =>  $data['email'],
                'conection' =>  $data['conection'],
                'smtpPort' =>  $data['smtpPort'],
                'smtpUser' =>  $data['smtpUser'],
                'smtpPassword' => $data['smtpPassword'],
                'smtpServer' =>  $data['smtpServer'],
                'activate' =>  $data['active']
            ]);

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function show(Request $request)
    {
        $data = $request->json()->all();

        try {

            $organizacion = Organizacion::where('id', $data['id'])->first();
            return response()->json(['message' => $organizacion, 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update(Request $request, $id)
    {
        $data = $request->json()->all();

        try {

            $organizacion = Organizacion::findOrFail($id);

            $organizacion->update($request->all());
            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function changeStatus(Request $request)
    {
        $data = $request->json()->all();
        try {

            $organizacion = Organizacion::where('id', $request->id);

            $organizacion->update([
                'activate' => $request->activate
            ]);

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
