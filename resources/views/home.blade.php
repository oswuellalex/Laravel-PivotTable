@extends('layouts.app')

@section('head')

<!-- PivotTable.js libs from ../dist -->
<link rel="stylesheet" type="text/css" href="{{ asset('dist/pivot.css') }}">

<!-- C3 CSS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css">


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
            <div class="card-header">Guardar Filtro</div>

            <div class="card-body">
                
                    <form id="form_report" method="post" action="{{ route('administrator.report.store') }}">

                        @csrf
                        
                        <div class="form-group">

                            
                            <input id="name_report" class="form-control" type="text" name="name" required>
                            
                        </div>

                        <button class="btn btn-success">Guardar</button>

                    </form>

                
            </div>
        </div>
    
        <div class="card">
            <div class="card-header">Tabla dinamica</div>

            <div class="card-body">
                
                    
                <div id="output"></div>

                
            </div>
        </div>
    
    
</div>
@endsection

@section('js')

<!-- Pivottable -->

<script type="text/javascript" src="{{ asset('dist/pivot.js') }}"></script>

<!-- tips data -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.6.0/tips_data.min.js"></script>

<!-- d3 -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>

<!-- c3 -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js"></script>

<!-- c3 renders -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.14.0/c3_renderers.min.js"></script>

<script type="text/javascript">
    
    
// This example loads the "Canadian Parliament 2012"
    // dataset from a CSV instead of from JSON.

        var config_var;

        config_copy = Papa.parse("{{ $url }}", {
            download: true,
            skipEmptyLines: true,
            complete: function(parsed){

                 redertTable(parsed,config_copy);

                 return config_copy;
            }
        });
        

        function redertTable(parsed,config_copy)
        {
            

            $("#output").pivotUI(parsed.data,{
                renderers: $.extend(
                    $.pivotUtilities.renderers, 
                  $.pivotUtilities.c3_renderers
                ),
                onRefresh: function(config) {
                    
                    var config_copy = JSON.parse(JSON.stringify(config));
                    //delete some values which are functions
                    delete config_copy["aggregators"];
                    delete config_copy["renderers"];
                    //delete some bulky default values
                    delete config_copy["rendererOptions"];
                    delete config_copy["localeStrings"];
                    
                    console.log(config);

                    //setConfig(config_copy);
                    config_var = config_copy;
                    
                }
            });
        }

        function setConfig(config_copy){
            config_var = config_copy;
        } 

    $(document).on('DOMSubtreeModified','#output',function(){

        $( ".pvtUi" ).addClass("table-responsive");

    });

   

    $(document).on('submit','#form_report',function(e){
        
        e.preventDefault();
        
        var name = $('#name_report').val();
        var filter = config_var;
        console.log(name);
        console.log(filter);

          $.ajax({
              type: "POST",
              headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "{{ route('administrator.report.store') }}",
              data: {// change data to this object
                 name : name,
                 filter : filter
              },
              dataType: "text",
              success: function(response)
              {
                console.log(response);
                alert("Guardado Correctamente");
                
              },
              error: function (xhr) 
              {
                alert("Hubo un error");
              }
           });

       
    });


</script>

@endsection
