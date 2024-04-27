<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrganizacionUser;
use App\Models\RolesUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Spatie\FlareClient\Api;
use Illuminate\View\View;

class UsuariosController extends Controller
{

    public function create(): View
    {
        return view('auth.register');
    }

    public function index()
    {
        return User::with('roles', 'organizaciones')->get();
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            event(new Registered($user));

            $ultimoId = User::latest()->value('id');

            $userRol = RolesUser::create([
                'user_id' => $ultimoId,
                'roles_id' => $request->roles_id
            ]);

            event(new Registered($userRol));

            $userOrganizacion = OrganizacionUser::create([

                'user_id' => $ultimoId,
                'organizacion_id' => $request->organizacion_id
            ]);

            event(new Registered($userOrganizacion));

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Request $request)
    {
        $data = $request->json()->all();

        try {

            $usuario = User::with('roles', 'organizaciones')
                ->where('id', $data['id'])
                ->first();
            return response()->json(['message' => $usuario, 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {

        $data = $request->json()->all();
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],

                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::where('id', $id);
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password)
            ]);

            $rolUser = RolesUser::where('user_id', $id);
            $rolUser->update([
                'roles_id' => $request->roles_id
            ]);

            $organizacionUser = OrganizacionUser::where('user_id', $id);
            $organizacionUser->update([
                'organizacion_id' => $request->organizacion_id
            ]);

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function changeStatus(Request $request)
    {
        $data = $request->json()->all();
        try {

            $user = User::where('id', $request->id);

            $user->update([
                'activate' => $request->activate
            ]);

            return response()->json(['message' => 'OK', 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function indexUsersOrg(Request $request)
    {
        $data = $request->json()->all();

        try {

            $usuarios = User::with('roles', 'organizaciones')
                ->whereHas('organizaciones', function ($query) use ($request) {
                    $query->where('organizacion.id', $request->id);
                })
                ->get();

            return response()->json(['message' => $usuarios, 'id_error' => '200', 'etiqueta' => 'general.ok'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage(), 'id_error' => Response::HTTP_INTERNAL_SERVER_ERROR, 'etiqueta' => 'general.error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
