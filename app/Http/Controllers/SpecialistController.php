<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specialist;
use Illuminate\Support\Arr;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\NewSpecialistEmail;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\UserUploadImages;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\ResizeController;

class SpecialistController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth_id = Auth::user()->id;
        $notificaciones = Notification::where('to_id', $auth_id)->get();
        $ide = User::where('status', '=', 1)->get();
        $data = Specialist::orderBy('id', 'DESC')->paginate(5);
        return view('specialist.index', compact('data', 'ide', 'notificaciones'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_id = Auth::user()->id;
        $notificaciones = Notification::where('to_id', $auth_id)->get();
        $roles = Role::pluck('name', 'name')->all();
        return view('specialist.create', compact('roles', 'notificaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$avatarUp = new ResizeController();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'specialty' => 'required',
            'bio' => 'required',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $email = $input['email'];
        Specialist::create($input);
        $user = User::create($input);
        DB::table('specialists')->where('email', '=', $email)->update(['user_id'=>$user->id]);
        $user->assignRole($request->input('roles'));

        $objData = new \stdClass();
        $objData->sender = 'Ricardo León - CEO RapiMed';
        $objData->receiver = $request['name'];
        $objData->email = $request['email'];
        $objData->pass = $request['password'];
        Mail::to($request['email'])->send(new NewSpecialistEmail($objData));

        //$avatarUp->uploadAvatarImage($filePhoto);

        return redirect()->route('specialist.index')
            ->with('success', 'Specialist created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
        return view('specialist.my', compact('specialist', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole')); */
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
        /* $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully'); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully'); */
    }
}
