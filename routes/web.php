<?php

//Dependencia de las de rutas

use App\Http\Controllers\AuditoriaController;
use Illuminate\Support\Facades\Route;

//Controlador de autentificación y protección de rutas
use Illuminate\Support\Facades\Auth;

//== DEPENDENCIAS DE LAS RUTAS ==

//Controlador del registro
use App\Http\Controllers\RegisterController;
//Controlador del login
use App\Http\Controllers\LoginController;
//Controlador del perfil de los usuarios
use App\Http\Controllers\ProfileController;
//Controlador de recuperación de contraseña
use App\Http\Controllers\ForgotController;
//Controlador para restablecer la contraseña
use App\Http\Controllers\ChangePasswordController;
//Controlador de verificación de correo electronico
use App\Http\Controllers\MailVerificationController;
//Controlador del index 
use App\Http\Controllers\HomeController;
//Controlador del logout
use App\Http\Controllers\LogoutController;
//Controlador de los detinos turisticos
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\EstadoController;
//Controlador de los hoteles
use App\Http\Controllers\HotelController;
//Controlador de los pagos por paypal
use App\Http\Controllers\PaymentController;
//Controlador de los pagos por transferencia
use App\Http\Controllers\TransferenciaController;
//Controlador de proformas y facturas
use App\Http\Controllers\ProformaController;
//Controlador de paquetes finales y pago
use App\Http\Controllers\PackageController;
//controlador de las proformas
use App\Http\Controllers\ReservaController;
//controlador principal
use App\Http\Controllers\PaquetesController;
//filtro de atributos
use App\Http\Controllers\FormController;
//controlador de los municipios
use App\Http\Controllers\MunicipioController;
//controlador de los roles
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
//Controlado de reportes
use App\Http\Controllers\ReporteController;
//Controlado de estadisticas
use App\Http\Controllers\EstadisticasController;
//Controlado de busqueda de paquetes
use App\Http\Controllers\FindPackageController;
//Controlado de busqueda de paquetes
use App\Http\Controllers\SuscribeMailController;
//Controlado de busqueda de paquetes
use App\Http\Controllers\DashboardController;
//Controlado de paquetes destacados
use App\Http\Controllers\DestacadoController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\ProveedorController;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//== RUTAS BASICAS DE NAVEGACIÓN [HOME] ==


   //INDEX - [GET]
Route::get('/',[HomeController::class, 'index'])->name('index');

   //DESTINATION - [GET]
Route::get('/destination',[HomeController::class, 'destination'])->name('destination');

   //TOUR - [GET]
Route::get('/tour',[HomeController::class, 'tour'])->name('tour');

   //OFERTAS - [GET]
Route::get('/offer',[HomeController::class, 'offer'])->name('offer');

   //SERVICIOS - [GET]
Route::get('/service',[HomeController::class, 'service'])->name('service');

   //ACERCA DE - [GET]
Route::get('/about',[HomeController::class, 'about'])->name('about');


//== GRUPO DE RUTAS [REQUIERE QUE EL USUARIO NO ESTE AUTENTIFICADO]
Route::middleware('guest')->group(function(){


//== LOGIN ==

   //Registro - [GET]
   Route::get('/register',[RegisterController::class, 'show'])->name('register');

   //Registro - [POST]
   Route::post('/register', [RegisterController::class, 'register']);

   //Login - [GET]
   Route::get('/login',[LoginController::class, 'show'])->name('login');

   //Login - [POST]
   Route::post('/login', [LoginController::class, 'login']);


//== FORGOT ==
   
   //Forgot - [GET]
   Route::get('/forgotPassword',[ForgotController::class, 'index'])->name('forgot');
   
   //Forgot - [POST]
   Route::post('forgotPassword/mail',[ForgotController::class, 'forgot'])->name('forgotPass');

//== CHANGE PASSWORD ==

   //Change Passoword - [GET]
   Route::get('/changePassword',[ChangePasswordController::class, 'index'])->name('ChangePassword');

   //Change Passoword - [POST]
   Route::post('/validateChangePassword',[ChangePasswordController::class, 'changePassword'])->name('validateChangePassword');

//== VERIFICATE EMAIL ==

   //Forgot - [GET]
   Route::get('/confirmed_email',[MailVerificationController::class, 'verificate']); 

});



//== GRUPO DE RUTAS [REQUIERE QUE EL USUARIO ESTE AUTENTIFICADO]
Route::middleware('auth')->group(function(){


//== DASHBOARD ==



   //== DASHBOARD ==
  Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard'); 


//== LOGOUT ==
  Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');   


//== PROFILE ==

  Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

  Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile-edit');

  Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile-update');

/*
  Route::get('/profile/delete', [ProfileController::class, 'trash'])->name('profile-trash');

  Route::post('/profile/delete', [ProfileController::class, 'delete'])->name('profile-delete');
*/

  Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile-password');

  Route::post('/profile/changePassword', [ProfileController::class, 'changePassword'])->name('profile-changePassword');

  Route::patch('/profile/foto/{id}' ,[ProfileController::class, 'cambiarFoto']);

  Route::post('', []);
//====== CARTAS ======//

   //== DESTINO ==
  Route::get('/card/destino', [DestinoController::class,'card'])->name('cardDestino');

   //== HOTELES ==
  Route::get('/card/hoteles', [HotelController::class, 'card'])->name('cardHoteles');

   //== CRUDS ==

   //Destinos
  Route::resource('/destino', DestinoController::class);

   //Hoteles
  Route::resource('/hotel', HotelController::class);
  Route::patch('hotel/{id}/bloquear', [HotelController::class, "bloquear"]);
   #fotos del hotel
  Route::post('hotel/foto',[FotoController::class, 'agregarFotoHotel']);
  Route::patch('hotel/foto/{id}',[FotoController::class, 'borrarFotoHotel']);

  Route::post('hotel/video',[FotoController::class, 'agregarVideoHotel']);
  Route::patch('hotel/video/{id}',[FotoController::class, 'borrarVideoHotel']);
   //Estado
  Route::resource('/estado', EstadoController::class);

   //Municipio
  Route::resource('/municipio', MunicipioController::class);

   //Role
  Route::resource('/role',RoleController::class);

   //Paquete
  Route::resource('/paquete',PaquetesController::class);
  Route::patch('paquete/{id}/bloquear', [PaquetesController::class, "bloquear"]);
   #fotos del paquete
  Route::post('paquete/foto',[FotoController::class, 'agregarFotoPaquete']);
  Route::patch('paquete/foto/{id}',[FotoController::class, 'borrarFotoPaquete']);

  Route::post('paquete/video',[FotoController::class, 'agregarVideoPaquete']);
  Route::patch('paquete/video/{id}',[FotoController::class, 'borrarVideoPaquete']);
   //administrar usuarios
  Route::resource('/usuario',UserController::class);

   //bloquear usuario
  Route::patch('user/{id}/bloquear', [UserController::class, "bloquear"]);

   //solicitudes pendientes
  Route::post('/usuario/solicitud', [UserController::class, "solicitud"]);

   //cambiar rol del usuario
  Route::patch('user/{id}/cambiarRole', [UserController::class, "cambiarRole"]);

  Route::post('proveedor/agregar', [ProveedorController::class, 'agregar']);
   //destacar y borrar paquetes para el usuario
  Route::get('destacados', [DestacadoController::class, "index"]);

  Route::patch('destacar/{id}/destacar', [DestacadoController::class, "destacar"]);

   //ruta para ver las auditorias
  Route::get('auditorias',[AuditoriaController::class, "index"])->name('auditorias');

  Route::patch('auditorias',[AuditoriaController::class, "filtrar"])->name('auditorias-filtro');
   //== PAYMENT ==

   //== SHOW PACKAGE - DASHBOARD ==
  Route::get('dashboard/show/{package}/{id}',[PackageController::class,'show'])->name('dashboard-package-show');

   //== SHOW PACKAGE - DASHBOARD ==
  Route::get('dashboard/show/hotel/{hotel}/{id}',[PackageController::class,'show_hotel'])->name('dashboard-hotel-show');

      //== PROFORMA PACKAGE - DASHBOARD ==
  Route::get('dashboard/proforma/{package}/{id}',[PaymentController::class,'proforma'])->name('dashboard-package-proforma');

      //== PAYMENT PACKAGE - DASHBOARD ==
  Route::get('dashboard/payment/{package}/{id}',[PaymentController::class,'payment'])->name('dashboard-package-payment');

  Route::get('dashboard/payment/hotel/{hotel}/{id}',[PaymentController::class,'payment_hotel'])->name('dashboard-payment-hotel');

        //== PROFORMA HOTEL - DASHBOARD ==
  Route::get('dashboard/proforma/hotel/{hotel}/{id}',[PaymentController::class,'proforma_hotel'])->name('dashboard-hotel-proforma');

      //== PAYMENT HOTEL - DASHBOARD ==
  Route::get('dashboard/payment/{hotel}/{id}',[PaymentController::class,'payment_hotel'])->name('dashboard-hotel-payment');

      //== PAY PACKAGE - DASHBOARD ==
  Route::post('pay',[PaymentController::class,'pay'])->name('pay');

  Route::post('pay_hotel',[PaymentController::class,'pay_hotel'])->name('pay_hotel');

      //== APPROVED PACKAGE - DASHBOARD ==
  Route::get('dashboard/approved/{id}',[PaymentController::class,'approved'])->name('approved');

  Route::get('dashboard/approved/hotel/{id}',[PaymentController::class,'approved_hotel'])->name('approved_hotel');

      //== FACTURA PACKAGE - DASHBOARD ==
  Route::get('dashboard/factura/{id}',[ProformaController::class,'admin'])->name('factura');

  Route::get('dashboard/factura/hotel/{id}',[ProformaController::class,'admin_hotel'])->name('factura_hotel');

      /* TRANSFERENCIA - DASHBOARD
   Route::post('dashboard/transferencia/',[TransferenciaController::class,'payment'])->name('transferencia');

      //== TRANSFERENCIA [PAY] - DASHBOARD ==
   Route::post('dashboard/transferencia/pay',[TransferenciaController::class,'pay'])->name('transferencia_pay');
   
   */
   
      //== RESERVAS ==
   Route::get('dashboard/mis_reservas',[ReservaController::class,'paquete'])->name('mis_reservas');

   Route::get('dashboard/mis_reservas/hoteles',[ReservaController::class,'hotel'])->name('mis_reservas_hoteles');

      //== RECERVAS [APPROVED] ==
   Route::post('dashboard/mis_reservas/approved',[ProformaController::class,'approved'])->name('approved_mis_reservas');

      //== RECERVAS [APPROVED] ==
   Route::post('dashboard/mis_reservas/disapproved',[ProformaController::class,'disapproved'])->name('disapproved_mis_reservas');


      //== PDF ==
   Route::get('dashboard/factura/pdf/{id}',[ProformaController::class,'pdf'])->name('factura_pdf');

   Route::get('dashboard/factura/hotel/pdf/{id}',[ProformaController::class,'pdf_hotel'])->name('factura_pdf_hotel');

   //==  REPORTES ==
   
   #Usuarios
   Route::get('dashboard/reporte/usuario',[ReporteController::class,'usuario'])->name('reporte_usuario');

   Route::post('dashboard/reporte/usuario/pdf',[ReporteController::class,'usuario_pdf'])->name('reporte_usuario_pdf');

    #Paquete
   Route::get('dashboard/reporte/paquete',[ReporteController::class,'paquete'])->name('reporte_paquete');

   Route::post('dashboard/reporte/paquete/pdf',[ReporteController::class,'paquete_pdf'])->name('reporte_paquete_pdf');

    #Hotel
   Route::get('dashboard/reporte/hotel',[ReporteController::class,'hotel'])->name('reporte_hotel');

   Route::post('dashboard/reporte/hotel/pdf',[ReporteController::class,'hotel_pdf'])->name('reporte_hotel_pdf');

    #Destino
   Route::get('dashboard/reporte/destino',[ReporteController::class,'destino'])->name('reporte_destino');

   Route::post('dashboard/reporte/destino/pdf',[ReporteController::class,'destino_pdf'])->name('reporte_destino_pdf');


    //== ESTADISTICAS ==
    #Paquetes
   Route::get('dashboard/estadisticas/paquete',[EstadisticasController::class,'paquete'])->name('estadisticas_paquete');

    #Hoteles
   Route::get('dashboard/estadisticas/hotel',[EstadisticasController::class,'hotel'])->name('estadisticas_hotel');

    #Usuarios
   Route::get('dashboard/usuario',[EstadisticasController::class,'user'])->name('estadisticas_usuario');  

   #DESTINOS
   Route::get('dashboard/destino',[EstadisticasController::class,'destino'])->name('estadisticas_destino');   

   #CUSTOM PAQUETES
   Route::post('dashboard/estadisticas/paquete/generado',[EstadisticasController::class,'paquete_grafica_fecha'])->name('estadisticas_paquetes_generado');  

   #CUSTOM DESTINO
   Route::post('dashboard/estadisticas/destino/generado',[EstadisticasController::class,'destino_grafica_fecha'])->name('estadisticas_destinos_generado');  

   #CUSTOM HOTELES
   Route::post('dashboard/estadisticas/hotel/generado',[EstadisticasController::class,'hoteles_grafica_fecha'])->name('estadisticas_hoteles_generado');  
});

   //== SHOW PACKAGE - HOME ==
Route::get('/show/{package}/{id}',[HomeController::class,'show'])->name('package-show');

   //== SEARCH PACKAGE ==
Route::post('/find/package',[FindPackageController::class,'find'])->name('find_package'); 

Route::get('/find/package/{id}',[FindPackageController::class,'destinate_find'])->name('find_destinate_package'); 

   //== EMAIL SUSCRIBE - HOME ==
Route::post('/suscribe/mail',[SuscribeMailController::class,'suscribe'])->name('suscribe-mail'); 

//== ERRORES ==
Route::any('{any}',function(){
   return view('error.404');
})->name('404');
