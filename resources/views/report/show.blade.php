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


        
        Papa.parse("{{ $url }}", {
            download: true,
            skipEmptyLines: true,
            complete: function(parsed){

                 redertTable(parsed);
            }
        });
        

        function redertTable(parsed)
        {
            

            $("#output").pivotUI(parsed.data,{
                renderers: $.extend(
                    $.pivotUtilities.renderers, 
                  $.pivotUtilities.c3_renderers
                )
            });

            $.getJSON("{{ $urljson }}", function( data) {
              
              $("#output").pivotUI(parsed.data, data, true);

            });

            
        }

    $(document).on('DOMSubtreeModified','#output',function(){

        $( ".pvtUi" ).addClass("table-responsive");

    });

   

  


</script>

@endsection
