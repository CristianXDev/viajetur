@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | MIS RESERVAS</title>

@endsection

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0"><i class="fas fa-plane"></i> MIS RESERVAS</h4>
                    </div>
                </div>
            </div>
        </div>

        <!--SEARCH
        <div class="container mb-4">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nombre...">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Tipo...">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Destino...">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" placeholder="Fecha...">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Personas...">
                    </div>
                </div>
            </div>
        </div>
    -->


    <!--TABLE-->
    <div class="container">
        <div class="table-responsive">
            <table class="table table-light table-hover text-center">
                <thead class="bg-purple text-dark">
                    <tr>
                        <th class="col-md-2">Nombre Del Paquete</th>
                        <th class="col-md-2">Fecha De La Reserva</th>
                        <th class="col-md-2">Fecha Del Pago</th>
                        <th class="col-md-1">Estatus De La Compra</th>
                        <th class="col-md-1">Pagado</th>
                        <th class="col-md-2">Factura</th>
                        <th class="col-md-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                 @if (isset($proformas) && count($proformas) > 0)
                 @foreach ($proformas as $proforma)
                 <tr>
                    <th class="col-md-2">{{ strtoupper($proforma->paquete->nombre) }}</th>
                    <th class="col-md-2">{{$proforma->fecha_reserva}}</th>
                    <th class="col-md-2">{{$proforma->fecha_pago}}</th>
                    <th class="col-md-1">
                        @switch($proforma->estatus)

                        @case (1)

                        <span class="text-success">Pagado</span>

                        @break

                        @case (2)

                        <span class="text-warning">Pendiente</span>

                        @break

                        @case (3)

                        <span class="text-danger">Rechazado</span>

                        @break

                        @endswitch
                    </th>
                    <th class="col-md-1">{{$proforma->paquete->precio}}$</th>
                    <th class="col-md-2">
                        <a href="{{ route('factura',[$proforma->id]) }}"><i class="btn btn-primary fas fa-eye"></i></a>
                        <a href="{{ route('factura_pdf',[$proforma->id]) }}"><i class="btn btn-danger fas fa-file-pdf"></i></a>
                    </th>
                    <th class="col-md-2">
                        <div class="row d-flex justify-content-center">
                            <form action="{{ route('approved_mis_reservas') }}" method="POST" class="mx-1">

                                <input type="hidden" name="id" value="{{ $proforma->id }}">
                                <input type="hidden" name="estatus" value="1">

                                <button class="btn btn-success"><i class="fas fa-check"></i></button>

                                @csrf
                            </form>

                            <form action="{{ route('disapproved_mis_reservas') }}" method="POST">

                                <input type="hidden" name="id" value="{{ $proforma->id }}">
                                <input type="hidden" name="estatus" value="3">

                                <button class="btn btn-danger"><i class="fas fa-times"></i></button>

                                @csrf
                            </form>
                        </div>
                    </th>
                </tr>
                @endforeach 
                @else
                <tr>
                    <td class="col-md-1">No existen datos disponibles</td>
                    <td class="col-md-1">No existen datos disponibles</td>
                    <td class="col-md-1">No existen datos disponibles</td>
                    <td class="col-md-1">No existen datos disponibles</td>
                    <td class="col-md-1">No existen datos disponibles</td>
                    <td class="col-md-1">No existe aciones disponibles</td>
                    <td class="col-md-1">No existe aciones disponibles</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

        <!--PAGINATE
        <div class="container-fluid pb-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    -->
</div>
</div>

@endsection