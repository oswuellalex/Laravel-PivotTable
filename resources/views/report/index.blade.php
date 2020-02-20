@extends('layouts.app')

@section('head')


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

    .pivot-ui {
      width: 100%;
      background-color: red;
    }
</style>

@endsection



@section('content')
<div class="container-fluid">
    
        <div class="card">
            <div class="card-header">Reportes</div>

            <div class="card-body">
                
                    
                <table id="table_web" class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">name</th>
                      <th scope="col">show</th>
                      <th scope="col">delete</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   @forelse($reports as $report)

                      <tr>
                        <th scope="row">{{ $report->id }}</th>
                        <td>{{ $report->name }}</td>
                        <td>
                          <a class="btn btn-success" href="{{ route('administrator.report.show',$report->id) }}">
                            <span class="fa fa-eye"></span>
                          </a>
                        </td>
                        <td>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_{{ $report->id }}">
                            <span class="fa fa-trash"></span>
                          </button>

                          </a>
                        </td>
                      </tr>

                      @include('report.modal')

                   @empty

                   @endforelse
                  
                  </tbody>
                </table>

                
            </div>
        </div>
    
    
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function() {
        $('#table_web').DataTable({
          "language":
          {
            "sProcessing":     "Procesando...",
                          "sLengthMenu":     "Mostrar _MENU_ registros",
                          "sZeroRecords":    "No se encontraron resultados",
                          "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                          "sInfoPostFix":    "",
                          "sSearch":         "Buscar:",
                          "sUrl":            "",
                          "sInfoThousands":  ",",
                          "sLoadingRecords": "Cargando...",
                          "oPaginate": {
                              "sFirst":    "Primero",
                              "sLast":     "Último",
                              "sNext":     "Siguiente",
                              "sPrevious": "Anterior"
                          },
                          "oAria": {
                              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                          },
                          "buttons": {
                              "copy": "Copiar",
                              "colvis": "Visibilidad"
                          }
          }
        });
    } );
</script>
@endsection


