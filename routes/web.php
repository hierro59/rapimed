<?php

use App\Mail\SendMail;

use App\Models\LogUser;
use App\Models\Operation;
use App\Models\Specialist;
use App\Models\MetadataUsers;
use App\Models\Citas;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ResizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\ScoreCustomerController;
use App\Models\UserUploadImages;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $especialistas = Specialist::where('status', '=', 1)->inRandomOrder()->limit(12)->get();

    $data = [];

    for ($i=0; $i < count($especialistas); $i++) {  
        $getAvatar = UserUploadImages::where('customer_id', '=', $especialistas[$i]['user_id'])->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
        $getPortada = UserUploadImages::where('customer_id', '=', $especialistas[$i]['user_id'])->where('type', '=', 'portada')->orderBy('created_at', 'DESC')->get();
        $getMetadata = MetadataUsers::distinct('customer_id')->where('customer_id', '=', $especialistas[$i])->get();

        (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
        (count($getPortada) >= 1 ? $portada = $getPortada[0]['image_name'] : $portada = "generic-portada.jpg");
        
        $line = [
            'user_id' => $especialistas[$i]['user_id'],
            'degree' => $especialistas[$i]['degree'],
            'nombre' => $especialistas[$i]['name'],
            'especialidad' => $especialistas[$i]['specialty'],
            'avatar' => $avatar
        ];
        array_push($data, $line);
    }
    
    return view('welcome', compact('data'));
})->name('welcome');

Route::get('/perfil/{id}', function (int $id) {

    (isset(Auth::user()->id) ? $user_id = Auth::user()->id : $user_id = false);

    $especialistas = Specialist::where('user_id', '=', $id)->where('status', '=', 1)->get();

    $getAvatar = UserUploadImages::where('customer_id', '=', $especialistas[0]['user_id'])->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
    $getPortada = UserUploadImages::where('customer_id', '=', $especialistas[0]['user_id'])->where('type', '=', 'portada')->orderBy('created_at', 'DESC')->get();
    $getMetadata = MetadataUsers::distinct('customer_id')->where('customer_id', '=', $especialistas[0]['user_id'])->get();
    $getCitas = Citas::distinct('user_id')->where('specialist_id', '=', $especialistas[0]['id'])->count('user_id');
    $getScore = Score::where('specialist_id', '=', $especialistas[0]['id'])->where('score', ">", 0)->get()->sum('score');

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

    $now = date_create(date('Y-m-d H:i:s'));
    
    $fechaActual = date('Y-m-d'); 
    $datetime1 = date_create($especialistas[0]['dob']);
    $datetime2 = date_create($fechaActual);
    $contador = date_diff($datetime1, $datetime2);
    $differenceFormat = '%a';
    

    $datedog = date_create($especialistas[0]['dob']);
    $contador = date_diff($datedog, $datetime2);
    $differenceFormatdog = '%a';
    
    
    (count($getMetadata) >= 1 ? $historial = $getMetadata[0]['medical_history'] : $historial = "Breve reseña de habilidades");
    (count($getMetadata) >= 1 ? $direccion = $getMetadata[0]['address'] : $direccion = "Sin datos");
    (count($getMetadata) >= 1 ? $ciudad = $getMetadata[0]['city'] : $ciudad = "Sin datos");
    (count($getMetadata) >= 1 ? $estado = $getMetadata[0]['state'] : $estado = "Sin datos");
    (count($getMetadata) >= 1 ? $pais = $getMetadata[0]['country'] : $pais = "Sin datos");
    (count($getMetadata) >= 1 ? $phone = $getMetadata[0]['phone'] : $phone = "Sin teléfono");
    (isset($especialistas[0]['dob']) ? $dob = $contador->format($differenceFormat) : $dob = "Sin datos");
    (isset($especialistas[0]['dog']) ? $dog = $contador->format($differenceFormatdog) : $dog = "Sin");
    (isset($especialistas[0]['tc_domicilio']) ? $tc_domicilio = true : $tc_domicilio = false);
    (isset($especialistas[0]['tc_virtual']) ? $tc_virtual = true : $tc_virtual = false);
    (isset($especialistas[0]['tc_consultorio']) ? $tc_consultorio = true : $tc_consultorio = false);
    
    $data = [
        'specialist_id' => $especialistas[0]['id'],
        'degree' => $especialistas[0]['degree'],
        'nombre' => $especialistas[0]['name'],
        'especialidad' => $especialistas[0]['specialty'],
        'email' => $especialistas[0]['email'],
        'avatar' => $avatar,
        'portada' => $portada,
        'genero' => $genero,
        'historial' => $especialistas[0]['bio'],
        'direccion' => $direccion,
        'ciudad' => $ciudad,
        'estado' => $estado,
        'pais' => $pais,
        'phone' => $phone,
        'user_id' => $user_id,
        'pacientes' => $getCitas,
        'score' => $getScore,
        'tc_domicilio' => $tc_domicilio,
        'tc_virtual' => $tc_virtual,
        'tc_consultorio' => $tc_consultorio,
        'dob' => $dob,
        'dog' => $dog
    ];

    $otrosespecialistas = Specialist::where('user_id', 'not like', $id)->inRandomOrder()->skip(0)->take(5)->get();

    $otros = [];

    for ($i=0; $i < count($otrosespecialistas); $i++) {  
        $getAvatar = UserUploadImages::where('customer_id', '=', $otrosespecialistas[$i]['user_id'])->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
        $getMetadata = MetadataUsers::distinct('customer_id')->where('customer_id', '=', $otrosespecialistas[$i])->get();

        (count($getAvatar) >= 1 ? $avatarOtros = $getAvatar[0]['image_name'] : $avatarOtros = "generic-user.png");
        
        $line = [
            'user_id' => $otrosespecialistas[$i]['user_id'],
            'degree' => $otrosespecialistas[$i]['degree'],
            'nombre' => $otrosespecialistas[$i]['name'],
            'especialidad' => $otrosespecialistas[$i]['specialty'],
            'avatar' => $avatarOtros
        ];
        array_push($otros, $line);
    }
    
    return view('perfil', compact('data', 'otros'));
})->name('perfil');

Route::get('/doctors', function () {

    $especialistas = Specialist::where('status', '=', 1)->inRandomOrder()->get();

    $data = [];

    for ($i=0; $i < count($especialistas); $i++) {  
        $getAvatar = UserUploadImages::where('customer_id', '=', $especialistas[$i]['user_id'])->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
        
        (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
                
        $line = [
            'user_id' => $especialistas[$i]['user_id'],
            'degree' => $especialistas[$i]['degree'],
            'nombre' => $especialistas[$i]['name'],
            'especialidad' => $especialistas[$i]['specialty'],
            'avatar' => $avatar
        ];
        array_push($data, $line);
    }
    
    return view('doctors', compact('data'));
})->name('doctors');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('services', function () {
    return view('services');
})->name('services');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

/* Route::get('/verify', function () {
    return view('auth.verify');
}); */

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('send', [MailController::class, 'send'])->name('send');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class)->middleware('permission:super-admin');
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('specialist', SpecialistController::class);
    Route::resource('citas', CitasController::class);
    Route::resource('score', ScoreController::class);
    Route::resource('scorecustomer', ScoreCustomerController::class);
    Route::post('loguser', [LogUser::class, 'store'])->name('loguser');
    Route::get('/file-resize', [ResizeController::class, 'index']);
    Route::post('/resize-file', [ResizeController::class, 'resizeImage'])->name('resizeImage');
    Route::get('specialistdata', [UserController::class, 'specialist'])->name('specialistdata');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
