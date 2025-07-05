<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Paquete;
use App\Models\Destino;
use App\Models\Hotel;

use Carbon\Carbon;

use Dompdf\Dompdf;

class ReporteController extends Controller{

  public function usuario(Request $request){

    $estados = Estado::all();
    $municipios = Municipio::all();
    return view('dashboard.reportes.usuarios',compact('estados','municipios'));

  }

  public function usuario_pdf(Request $request){

    $rol = $request['rol']; 
    $estado = $request['estado']; 
    $municipio = $request['municipio']; 

    //Modicar fechas
    $fechaInicio = Carbon::parse($request['fechaIni']);
    $fechaFin = Carbon::parse($request['fechaFin']);

    $usuarios = User::query();

    if($request['rol']==1 || $request['rol']==2 || $request['rol']==3 || $request['rol']==4){

      $usuarios->where('id_role', $rol);
    }

    if($request['municipio']!=0){

     $usuarios->where('id_municipio', $municipio);  
   }


   if(!empty($request['fechaIni']) && !empty($request['fechaFin'])){

    $usuarios->whereBetween('created_at', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()]);
  }

  //Usuarios filtrados
  $usuariosFiltrados = $usuarios->get();

    //Verificar si hay resultados
  if(count($usuariosFiltrados) > 0){
    //registro de auditoria
    $this->auditoria('usuarios');
    //Calcular fecha
    $fecha = date('d-m-Y');

    // Crear una instancia de Dompdf
    $pdf = new Dompdf();

    // Renderizar la vista Blade en HTML
    $html = view('pdf.reporte_usuario_pdf',compact('usuariosFiltrados','fecha'))->render();

    // Cargar el contenido HTML en Dompdf
    $pdf->loadHtml($html);

    // Opcional: Establecer el tamaño y la orientación del papel
    $pdf->setPaper('A4', 'landscape');

    // Renderizar el PDF
    $pdf->render();

    // Descargar el PDF generado
    return $pdf->stream('reporte_usuarios'.'-'.$fecha.'.pdf');

  }

  else{

    return redirect()->back()->withErrors('No se a encontrado ningún usuario');

  }
}


public function paquete(Request $request){

  $paquete = Paquete::all();
  $estados = Estado::all();
  $municipios = Municipio::all();
  $destinos = Destino::all();


  return view('dashboard.reportes.paquete',compact('paquete','estados','municipios','destinos'));
}

public function paquete_pdf(Request $request){

  $estatus = $request['estatus']; 
  $estado = $request['estado']; 
  $destino = $request['destino']; 


    //Modicar fechas
  $fechaInicio = Carbon::parse($request['fechaIni']);
  $fechaFin = Carbon::parse($request['fechaFin']);

  $paquete = Paquete::query();

  if($request['estatus']==1 || $request['estatus']==2){

    $paquete->where('bloqueado', $estatus);
  }

  if($request['destino']!=0){

    $paquete->where('id_destino', $destino);
  }

  if(!empty($request['fechaIni']) && !empty($request['fechaFin'])){

    $paquete->whereBetween('created_at', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()]);
  }

  $paqueteFiltrados = $paquete->get();

  //Verificar si hay resultados
  if(count($paqueteFiltrados) > 0){
    //registro de auditoria
    $this->auditoria('Paquetes');

    //Calcular fecha
    $fecha = date('d-m-Y');

    //Crear una instancia de Dompdf
    $pdf = new Dompdf();

    // Renderizar la vista Blade en HTML
    $html = view('pdf.reporte_paquete_pdf',compact('paqueteFiltrados','fecha'))->render();

    //Cargar el contenido HTML en Dompdf
    $pdf->loadHtml($html);

    //Opcional: Establecer el tamaño y la orientación del papel
    $pdf->setPaper('A4', 'landscape');

    //Renderizar el PDF
    $pdf->render();

    //Descargar el PDF generado

    return $pdf->stream('reporte_paquetes'.'-'.$fecha.'.pdf');

  }

  else{

    return redirect()->back()->withErrors('No se a encontrado ningún paquete');

  }

}

public function hotel(Request $request){

  $hoteles = Hotel::all();
  $estados = Estado::all();
  $destinos = Destino::all();

  return view('dashboard.reportes.hotel',compact('estados','destinos','hoteles'));

}

public function hotel_pdf(Request $request){

  $estatus = $request['estatus']; 
  $estado = $request['estado']; 
  $destino = $request['destino']; 
  $proveedor = $request['proveedor']; 

  //Modicar fechas
  $fechaInicio = Carbon::parse($request['fechaIni']);
  $fechaFin = Carbon::parse($request['fechaFin']);

  $hotel = Hotel::query();

  if($request['estatus']==1 || $request['estatus']==2){

    $hotel->where('bloqueado', $estatus);
  }

  if($request['destino']!=0){

    $hotel->where('id_destino', $destino);
  }

  if($request['proveedor']!=0){

    $hotel->where('id_user', $proveedor);
  }

  if(!empty($request['fechaIni']) && !empty($request['fechaFin'])){

    $hotel->whereBetween('created_at', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()]);
  }
  $hotelFiltrados = $hotel->get();

  //Verificar si hay resultados
  if(count($hotelFiltrados) > 0){
    //registro de auditoria
    $this->auditoria('Hoteles');

    //Calcular fecha
    $fecha = date('d-m-Y');

    //Crear una instancia de Dompdf
    $pdf = new Dompdf();

    // Renderizar la vista Blade en HTML
    $html = view('pdf.reporte_hoteles_pdf',compact('hotelFiltrados','fecha'))->render();

    //Cargar el contenido HTML en Dompdf
    $pdf->loadHtml($html);

    //Opcional: Establecer el tamaño y la orientación del papel
    $pdf->setPaper('A4', 'landscape');

    //Renderizar el PDF
    $pdf->render();

    //Descargar el PDF generado

    return $pdf->stream('reporte_hoteles'.'-'.$fecha.'.pdf');

  }

  else{

    return redirect()->back()->withErrors('No se a encontrado ningún hotel');

  }

}

public function destino(Request $request){

  $estados = Estado::all();
  return view('dashboard.reportes.destino',compact('estados'));
}


public function destino_pdf(Request $request){

  $estado = $request['estado']; 

  //Modicar fechas
  $fechaInicio = Carbon::parse($request['fechaIni']);
  $fechaFin = Carbon::parse($request['fechaFin']);

  $destino = Destino::query();

  if($request['estado']!=0){

    $destino->where('id_estado', $estado);
  }

  if(!empty($request['fechaIni']) && !empty($request['fechaFin'])){

    $destino->whereBetween('created_at', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()]);
  }

  $destinoFiltrados = $destino->get();

 //Verificar si hay resultados
  if(count($destinoFiltrados)>0){
    //registro de auditoria
    $this->auditoria('Destinos');
    //Calcular fecha
    $fecha = date('d-m-Y');

    //Crear una instancia de Dompdf
    $pdf = new Dompdf();

    // Renderizar la vista Blade en HTML
    $html = view('pdf.reporte_destino_pdf',compact('destinoFiltrados','fecha'))->render();

    //Cargar el contenido HTML en Dompdf
    $pdf->loadHtml($html);

    //Opcional: Establecer el tamaño y la orientación del papel
    $pdf->setPaper('A4', 'landscape');

    //Renderizar el PDF
    $pdf->render();

    //Descargar el PDF generado

    return $pdf->stream('reporte_destino'.'-'.$fecha.'.pdf');

  }

  else{

    return redirect()->back()->withErrors('No se a encontrado ningún hotel');

    }
  }

  private function auditoria($clase)
  {
    /*----------------registro de auditorias--------------------------------------*/
      $auditoria['id_user'] = Auth()->user()->id;
      $auditoria['descripcion'] = 'El usuario solicto el reporte de '.$clase;
      $fecha = Carbon::now();
      $auditoria['created_at'] = $fecha;
      Auditoria::insert($auditoria);
    /*-----------------------------------------------------------------------------*/
  }
}
