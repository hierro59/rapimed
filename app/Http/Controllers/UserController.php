<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specialist;
use Illuminate\Support\Arr;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\MetadataUsers;
use App\Models\UserUploadImages;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_id = Auth::user()->id;
        $notificaciones = Notification::where('to_id', $auth_id)->get();
        $role = DB::Table('model_has_roles')->where('model_id', '=', $id)->get();
        if ($role[0]->role_id === 3) { // Especialistas
            $getAvatar = UserUploadImages::where('customer_id', '=', $id)->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
            $getPortada = UserUploadImages::where('customer_id', '=', $id)->where('type', '=', 'portada')->orderBy('created_at', 'DESC')->get();
            $specialist = Specialist::where('id', '=', $id)->get();
            $getMetadata = MetadataUsers::distinct('customer_id')->where('customer_id', '=', $id)->get();

            (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
            (count($getPortada) >= 1 ? $portada = $getPortada[0]['image_name'] : $portada = "generic-portada.jpg");
            if (count($getMetadata) >= 1) {
                if ($getMetadata[0]['sex'] == 1) {
                    $genero = 'la-mars';
                } elseif ($getMetadata[0]['sex'] == 2) {
                    $genero = 'la-venus';
                } else {
                    $genero = 'la-transgender';
                }
            } else {
                $genero = 'la-transgender';
            }
            (count($getMetadata) >= 1 ? $historial = $getMetadata[0]['medical_history'] : $historial = "Breve reseña de habilidades");
            (count($getMetadata) >= 1 ? $direccion = $getMetadata[0]['address'] : $direccion = "Sin datos");
            (count($getMetadata) >= 1 ? $ciudad = $getMetadata[0]['city'] : $ciudad = "Sin datos");
            (count($getMetadata) >= 1 ? $estado = $getMetadata[0]['state'] : $estado = "Sin datos");
            (count($getMetadata) >= 1 ? $pais = $getMetadata[0]['country'] : $pais = "Sin datos");
            (count($getMetadata) >= 1 ? $phone = $getMetadata[0]['phone'] : $phone = "Sin teléfono");

            $data = [
                'role' => 'Especialista',
                'avatar' => $avatar,
                'portada' => $portada,
                'genero' => $genero,
                'historial' => $historial,
                'direccion' => $direccion,
                'ciudad' => $ciudad,
                'estado' => $estado,
                'pais' => $pais,
                'phone' => $phone
            ];

            $user = User::find($id);
            return view('users.show', compact('user', 'specialist', 'id', 'data', 'notificaciones'));
        } elseif ($role[0]->role_id === 2) { //Paciente
            $getAvatar = UserUploadImages::where('customer_id', '=', $id)->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
            $getPortada = UserUploadImages::where('customer_id', '=', $id)->where('type', '=', 'portada')->orderBy('created_at', 'DESC')->get();
            $getMetadata = MetadataUsers::distinct('customer_id')->where('customer_id', '=', $id)->get();
            (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
            (count($getPortada) >= 1 ? $portada = $getPortada[0]['image_name'] : $portada = "generic-portada.jpg");
            if (count($getMetadata) >= 1) {
                if ($getMetadata[0]['sex'] == 1) {
                    $genero = 'la-mars';
                } elseif ($getMetadata[0]['sex'] == 2) {
                    $genero = 'la-venus';
                } else {
                    $genero = 'la-transgender';
                }
            } else {
                $genero = 'la-transgender';
            }
            (count($getMetadata) >= 1 ? $historial = $getMetadata[0]['medical_history'] : $historial = "Historial Médico");
            (count($getMetadata) >= 1 ? $direccion = $getMetadata[0]['address'] : $direccion = "Sin datos");
            (count($getMetadata) >= 1 ? $ciudad = $getMetadata[0]['city'] : $ciudad = "Sin datos");
            (count($getMetadata) >= 1 ? $estado = $getMetadata[0]['state'] : $estado = "Sin datos");
            (count($getMetadata) >= 1 ? $pais = $getMetadata[0]['country'] : $pais = "Sin datos");
            (count($getMetadata) >= 1 ? $phone = $getMetadata[0]['phone'] : $phone = "Sin teléfono");

            $data = [
                'role' => 'Paciente',
                'avatar' => $avatar,
                'portada' => $portada,
                'genero' => $genero,
                'historial' => $historial,
                'direccion' => $direccion,
                'ciudad' => $ciudad,
                'estado' => $estado,
                'pais' => $pais,
                'phone' => $phone
            ];
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            $user = User::find($id);
            return view('users.show', compact('user', 'specialist', 'id', 'data', 'notificaciones'));
        } elseif ($role[0]->role_id === 4) { //Company
            // data
        } elseif ($role[0]->role_id === 1) { //SuperAdmin
            $getAvatar = UserUploadImages::where('customer_id', '=', $id)->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
            $getPortada = UserUploadImages::where('customer_id', '=', $id)->where('type', '=', 'portada')->orderBy('created_at', 'DESC')->get();
            $getMetadata = MetadataUsers::distinct('customer_id')->where('customer_id', '=', $id)->get();
            (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
            (count($getPortada) >= 1 ? $portada = $getPortada[0]['image_name'] : $portada = "generic-portada.jpg");
            if (count($getMetadata) >= 1) {
                if ($getMetadata[0]['sex'] == 1) {
                    $genero = 'la-mars';
                } elseif ($getMetadata[0]['sex'] == 2) {
                    $genero = 'la-venus';
                } else {
                    $genero = 'la-transgender';
                }
            } else {
                $genero = 'la-transgender';
            }
            (count($getMetadata) >= 1 ? $historial = $getMetadata[0]['medical_history'] : $historial = "Historial Médico");
            (count($getMetadata) >= 1 ? $direccion = $getMetadata[0]['address'] : $direccion = "Sin datos");
            (count($getMetadata) >= 1 ? $ciudad = $getMetadata[0]['city'] : $ciudad = "Sin datos");
            (count($getMetadata) >= 1 ? $estado = $getMetadata[0]['state'] : $estado = "Sin datos");
            (count($getMetadata) >= 1 ? $pais = $getMetadata[0]['country'] : $pais = "Sin datos");
            (count($getMetadata) >= 1 ? $phone = $getMetadata[0]['phone'] : $phone = "Sin teléfono");

            $data = [
                'role' => 'SuperAdmin',
                'avatar' => $avatar,
                'portada' => $portada,
                'genero' => $genero,
                'historial' => $historial,
                'direccion' => $direccion,
                'ciudad' => $ciudad,
                'estado' => $estado,
                'pais' => $pais,
                'phone' => $phone
            ];
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            $user = User::find($id);
            return view('users.show', compact('user', 'specialist', 'id', 'data', 'notificaciones'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($request->sexo)) {
            $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
            if (count($getMetadata) >= 1) {
                $input = [
                    'sex' => $request->sexo
                ];
                $update = MetadataUsers::find($getMetadata[0]['id']);
                $update->update($input);
            } else {
                $input = [
                    'customer_id' => $id,
                    'sex' => $request->sexo
                ];
                $create = MetadataUsers::create($input);
            }
        }
        if (isset($request->bio)) {
            $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
            if (count($getMetadata) >= 1) {
                $input = [
                    'medical_history' => $request->bio
                ];
                $update = MetadataUsers::find($getMetadata[0]['id']);
                $update->update($input);
            } else {
                $input = [
                    'customer_id' => $id,
                    'medical_history' => $request->bio
                ];
                MetadataUsers::create($input);
            }
        }
        if (isset($request->address)) {
            $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
            if (count($getMetadata) >= 1) {
                $input = [
                    'address' => $request->address
                ];
                $update = MetadataUsers::find($getMetadata[0]['id']);
                $update->update($input);
            } else {
                $input = [
                    'customer_id' => $id,
                    'address' => $request->address
                ];
                MetadataUsers::create($input);
            }
        }
        if (isset($request->ciudad)) {
            $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
            if (count($getMetadata) >= 1) {
                $input = [
                    'city' => $request->ciudad
                ];
                $update = MetadataUsers::find($getMetadata[0]['id']);
                $update->update($input);
            } else {
                $input = [
                    'customer_id' => $id,
                    'city' => $request->ciudad
                ];
                MetadataUsers::create($input);
            }
        }
        if (isset($request->estado)) {
            $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
            if (count($getMetadata) >= 1) {
                $input = [
                    'state' => $request->estado
                ];
                $update = MetadataUsers::find($getMetadata[0]['id']);
                $update->update($input);
            } else {
                $input = [
                    'customer_id' => $id,
                    'state' => $request->estado
                ];
                MetadataUsers::create($input);
            }
        }
        if (isset($request->country)) {
            $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
            if (count($getMetadata) >= 1) {
                $input = [
                    'country' => $request->country
                ];
                $update = MetadataUsers::find($getMetadata[0]['id']);
                $update->update($input);
            } else {
                $input = [
                    'customer_id' => $id,
                    'country' => $request->country
                ];
                MetadataUsers::create($input);
            }
        }
        if (isset($request->phone)) {
            $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
            if (count($getMetadata) >= 1) {
                $input = [
                    'phone' => $request->phone
                ];
                $update = MetadataUsers::find($getMetadata[0]['id']);

                $update->update($input);
            } else {
                $input = [
                    'customer_id' => $id,
                    'phone' => $request->phone
                ];
                MetadataUsers::create($input);
            }
        }
        /* $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required'
        ]);

        $input = $request->all(); */
        /* if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        } */

        /* $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
*/
        return back()
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
