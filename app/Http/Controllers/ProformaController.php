<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Proforma;
use App\Models\Proforma_hotel;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Dompdf\Dompdf;

class ProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function user(){
        $id = Auth()->user()->id;
        $proformas = Proforma::where('id',$id);
        return view('payment.factura',compact('proformas'));
    }

    public function admin($id){
        $proforma = Proforma::find($id);
        return view('payment.factura', compact('proforma'));
    }

    public function admin_hotel($id){
        $proforma = Proforma_hotel::find($id);
        return view('payment.factura_hotel', compact('proforma'));
    }

    public function proveedor(){
        $id = Auth()->user()->id;
        $proformas = Proforma::where('id',$id);
        return view('payment.factura',compact('proformas'));
    }

    public function approved(Request $request){

        //Capturar el id de la proforma
        $id = $request->id;

        $estatus = $request->estatus;

        //Traer la proforma del id que me estan pasando
        $proforma = Proforma::where('id',$id)->update(['estatus'=>$estatus]);

        return redirect('/dashboard/mis_reservas')->with('success','Proforma aprobada');
    }

    public function disapproved(Request $request){

        //Capturar el id de la proforma
        $id = $request->id;

        $estatus = $request->estatus;

        //Traer la proforma del id que me estan pasando
        $proforma = Proforma::where('id',$id)->update(['estatus'=>$estatus]);

        return redirect('/dashboard/mis_reservas')->with('success','Proforma rechazada');

    }

    public function pdf(Request $request,$id){

        $proforma = Proforma::find($id);
        $user = User::find(Auth()->user()->id);

    // Crear una instancia de Dompdf
        $pdf = new Dompdf();

        /*Renderizar la vista Blade en HTML*/
        $html = view('pdf.factura_pdf',compact('proforma','user'))->render();
        

    // Cargar el contenido HTML en Dompdf
        $pdf->loadHtml($html);

    // Opcional: Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'landscape');

    // Renderizar el PDF
        $pdf->render();

    //Calcular fecha
        $fecha = date('d-m-Y');

    // Descargar el PDF generado

        return $pdf->stream('factura'.'-'.$user->nombre.'-'.$user->apellido.'-'.$fecha.'.pdf');

    }

    public function pdf_hotel(Request $request,$id){

        $proforma = Proforma_hotel::find($id);
        $user = User::find(Auth()->user()->id);

    // Crear una instancia de Dompdf
        $pdf = new Dompdf();

        /*Renderizar la vista Blade en HTML*/
        $html = view('pdf.factura_hotel_pdf',compact('proforma','user'))->render();
        

    // Cargar el contenido HTML en Dompdf
        $pdf->loadHtml($html);

    // Opcional: Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'landscape');

    // Renderizar el PDF
        $pdf->render();

    //Calcular fecha
        $fecha = date('d-m-Y');

    // Descargar el PDF generado

        return $pdf->stream('factura_hotel'.'-'.$user->nombre.'-'.$user->apellido.'-'.$fecha.'.pdf');

    }

}
