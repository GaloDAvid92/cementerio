@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between align-items-center">{{ __('Bovedas') }}

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModalScrollable">
                            Nueva Boveda
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Crear Boveda</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="frmBoveda">
                                        <div class="modal-body">
                                            <b>Nombre: </b> <input class="form-control" type="text" name="nombre"
                                                id="txtNombre">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <b>Filas: </b> <input class="form-control" type="number" name="filas"
                                                        id="txtFilas">
                                                </div>
                                                <div class="col-sm-6">
                                                    <b>Columnas: </b> <input class="form-control" type="number"
                                                        name="columnas" id="txtColumnas">
                                                </div>
                                            </div>
                                            <b>Estado: </b> <select class="form-control" name="estado" id="selEstado">
                                                <option value="Disponible">Disponible</option>
                                                <option value="Vendida">Vendida</option>
                                                <option value="Arrendada">Arrendada</option>
                                                <option value="Donada">Donada</option>
                                                <option value="A Plazos">A Plazos</option>
                                            </select>
                                        </div>
                                    </form>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                            <button id="btnBoveda" onclick="guardarBoveda()" class="btn btn-primary">Guardar</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="divBovedas" class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>
    showBovedas();

    function showBovedas(){
    $.ajax({
        type: 'GET',
        url: '/api/boveda',
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function(callback) {
            console.log(callback);
            callback.forEach(element => {
                console.log(element);
                var clase = "";
                if (element.estado == 'Disponible') {
                    clase = "bg-light";
                }
                if (element.estado == 'Vendida') {
                    clase = "text-white bg-dark";
                }
                if (element.estado == 'Arrendada') {
                    clase = "text-white bg-success";
                }
                if (element.estado == 'Donada') {
                    clase = "text-white bg-primary";
                }
                if (element.estado == 'A Plazos') {
                    clase = "bg-warning";
                }
                $("#divBovedas").append(
                    `<div class="card ` + clase + ` mb-3" style="max-width: 18rem;">
                        <div class="card-header">` + element.nombre + `</div>
                        <div class="card-body">
                        <h5 class="card-title">` + element.estado + `</h5>
                        <p class="card-text">
                            <b>Filas: </b>` + element.filas + `<br>
                            <b>Columnas: </b>` + element.columnas + `<br>
                        </p>
                        </div>
                    </div>`
                );
            });
        },
        error: function() {
            $(this).html("error!");
        }
    });
    }

    function guardarBoveda() 
    {
        var form = $("#frmBoveda");
        var url = "/api/boveda";

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data) {
                console.log(data); // show response from the php script.
                location.reload();
            },
            error: function() {
                alert("Revise que todos los datos se escriban correctamente y que el nombre sea unico");
            }
        });
    }
</script>
