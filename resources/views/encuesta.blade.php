<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/x-icon" href="https://idex.cc/notificaciones_muro_crm/image/idex_icon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Encuesta IDEX - {{ $data["encuesta"] }}</title>
  </head>
  <body>
    <div class="container">
		<br>
    	<img class="float-lg-left" alt="" src="https://mcusercontent.com/3ec4abd994abed22a4c543d03/images/e1651d54-fff1-442c-98ac-94b0902675b8.png" width="174.83998107910156" width="564" style="max-width:2509px;">
    	<br>
        <br>
        <h1 class="text-center">{{ $data["encuesta"] }}</h1>
        <br>
        <div class="shadow-lg p-4 mb-4 bg-white rounded-lg">
        	<p><strong>¡Hola!.</strong> Tu opinión es muy importante para nosotros ya que de esta manera podremos ofrecerte la atención y servicio que mereces.</p>
            @switch($data["fase"])
                @case(1)
                    <p>Te invito a responder estas breves preguntas respecto al asesor de ventas que te atendió.</p>
                    @break
                @case(2)
                    <p>Te invito a responder estas breves preguntas respecto a la experiencia que has tenido hasta el día de hoy con nosotros.</p>
                    @break

                @case(3)
                    <p>Te invito a responder estas breves preguntas respecto a la experiencia que has tenido hasta el día de hoy con nosotros.</p>
                    @break
                @case(4)
                    <p>Te invito a responder estas breves preguntas respecto al asesor de ventas que te atendió.</p>
                    @break
                @default

            @endswitch
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br>
                    @endforeach
                </div>
            @endif
            <form action="{{route('respuesta.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="id_negociacion" readonly value="{{ $data["id_negociacion"] }}" style="display: none">
                    <input type="text" class="form-control" name="id_encuesta" readonly value="{{ $data["id_encuesta"] }}" style="display: none">
                </div>
                @php
                    $mensajeAsesor = "";
                    $contAsesor = 0;
                    $mensajeAsesorFinalizar = "";
                    $contFinalizar = 0;
                    $mensajeApartado = "";
                    $contApartado = 0;
                    $mensajeExpediente = "";
                    $contExpediente = 0;
                    $mensajeContrato = "";
                    $contContrato = 0;
                    $mensajeSeguimiento = "";
                    $contSeguimiento = 0;
                    $mensajeEscrituracion = "";
                    $contEscrituracion = 0;
                    $mensajeUnidad = "";
                    $contUnidad = 0;
                    $mensajeAdministracion = "";
                    $contAdministracion = 0;
                    $mensajeAtencion = "";
                    $contAtencion = 0;
                    $x = "";
                    $contX = 0;
                @endphp
                @foreach ($informacionPreguntas as $i => $valueI)
                    @foreach ($informacionPreguntas[$i] as $j => $v)
                        @if ($j == 'nombre')
                            @switch($v)
                                @case('ASESOR')
                                    @php
                                        $mensajeAsesor = $mensaje[$v];
                                        $contAsesor++;
                                    @endphp
                                    @break
                                @case('PARA FINALIZAR')
                                    @php
                                        $mensajeAsesorFinalizar = $mensaje[$v];
                                        $contFinalizar++;
                                    @endphp
                                    @break
                                    @case('APARTADO')
                                    @php
                                        $mensajeApartado = $mensaje[$v];
                                        $contApartado++;
                                    @endphp
                                    @break
                                @case('INTEGRACION DE EXPEDIENTE')
                                    @php
                                        $mensajeExpediente = $mensaje[$v];
                                        $contExpediente++;
                                    @endphp
                                    @break
                                    @case('FIRMA DE CONTRATO')
                                    @php
                                        $mensajeContrato = $mensaje[$v];
                                        $contContrato++;
                                    @endphp
                                    @break
                                @case('SEGUIMIENTO')
                                    @php
                                        $mensajeSeguimiento = $mensaje[$v];
                                        $contSeguimiento++;
                                    @endphp
                                    @break
                                    @case('ESCRITURACION')
                                    @php
                                        $mensajeEscrituracion = $mensaje[$v];
                                        $contEscrituracion++;
                                    @endphp
                                    @break
                                @case('ENTREGA DE UNIDAD')
                                    @php
                                        $mensajeUnidad = $mensaje[$v];
                                        $contUnidad++;
                                    @endphp
                                    @break
                                    @case('ADMINISTRACION CONDOMINAL')
                                    @php
                                        $mensajeAdministracion = $mensaje[$v];
                                        $contAdministracion++;
                                    @endphp
                                    @break
                                @case('ATENCION AL PROPIETARIO')
                                    @php
                                        $mensajeAtencion = $mensaje[$v];
                                        $contAtencion++;
                                    @endphp
                                    @break
                                @default

                            @endswitch
                        @endif
                    @endforeach
                @endforeach
                @php
                    $numPreg = 1;
                @endphp
                @if ($contAsesor > 0)
                    <h4>{{$mensajeAsesor}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)

                            @if ($j == 'nombre')
                                @if ($value == "ASESOR")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif

                @if ($contFinalizar > 0)
                    <h4>{{$mensajeAsesorFinalizar}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)
                            @if ($j == 'nombre')
                                @if ($value == "PARA FINALIZAR")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif


                @if ($contApartado > 0)
                    <h4>{{$mensajeApartado}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)
                            @if ($j == 'nombre')
                                @if ($value == "APARTADO")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif

                @if ($contExpediente > 0)
                    <h4>{{$mensajeExpediente}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)
                            @if ($j == 'nombre')
                                @if ($value == "INTEGRACION DE EXPEDIENTE")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif

                @if ($contContrato > 0)
                    <h4>{{$mensajeContrato}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)
                            @if ($j == 'nombre')
                                @if ($value == "FIRMA DE CONTRATO")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif

                @if ($contSeguimiento > 0)
                    <h4>{{$mensajeSeguimiento}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)
                            @if ($j == 'nombre')
                                @if ($value == "PARA FINALIZAR")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif

                @if ($contEscrituracion > 0)
                    <h4>{{$mensajeEscrituracion}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)
                            @if ($j == 'nombre')
                                @if ($value == "PARA FINALIZAR")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif

                @if ($contUnidad > 0)
                    <h4>{{$mensajeUnidad}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)
                            @if ($j == 'nombre')
                                @if ($value == "PARA FINALIZAR")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif

                @if ($contAdministracion > 0)
                    <h4>{{$mensajeAdministracion}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)
                            @if ($j == 'nombre')
                                @if ($value == "PARA FINALIZAR")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif

                @if ($contAtencion > 0)
                    <h4>{{$mensajeAtencion}}</h4>
                    @foreach ($informacionPreguntas as $i => $valueI)
                        @foreach ($informacionPreguntas[$i] as $j => $value)
                            @if ($j == 'nombre')
                                @if ($value == "PARA FINALIZAR")
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <strong>
                                                {{ $numPreg++.".- ".$informacionPreguntas[$i]["descripcion"]}}
                                            </strong>
                                        </label>

                                        <!-- MUESTRA OPCIONES DE RESPUESTA A LAS PREGUNTAS -->
                                        <!-- OPCION MULTIPLE: 1 -> VARIAS OPCIONES, 2 -> SI / NO, 0 -> SOLO COMENTARIOS -->
                                        @if ($informacionPreguntas[$i]["multiple"] == 2)
                                            <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Si">
                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                                @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                    <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                @endif
                                            </div>
                                        @else
                                            @if ($informacionPreguntas[$i]["multiple"] == 0)
                                                {{$informacionPreguntas[$i]['nombre']}}
                                                <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                            @else
                                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                                    <div class="custom-control custom-radio">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" checked value="Muy buena">
                                                            <label class="form-check-label" for="inlineRadio1">Muy buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="Buena">
                                                            <label class="form-check-label" for="inlineRadio2">Buena</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio3" value="Regular">
                                                            <label class="form-check-label" for="inlineRadio3">Regular</label>
                                                        </div><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio4" value="Muy mala">
                                                            <label class="form-check-label" for="inlineRadio4">Muy Mala</label>
                                                        </div>
                                                        @if ($informacionPreguntas[$i]["comentarios_multiple"] == 1)
                                                            <input type="text" class="form-control" id="comentarios_multiple" name="comentarios_multiple{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Comentarios adicionales">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif

                <button type="submit" class="text-center btn btn-outline-success btn-lg">Enviar encuesta</button>
            </form>
        </div>



		<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
		    <tbody class="mcnDividerBlockOuter">
		        <tr>
		            <td class="mcnDividerBlockInner" style="min-width: 100%; padding: 18px;">
		                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top-width: 2px;border-top-style: solid;border-top-color: #505050;">
		                    <tbody><tr>
		                        <td>
		                            <span></span>
		                        </td>
		                    </tr>
		                </tbody></table>
		            </td>
		        </tr>
		    </tbody>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
		    <tbody class="mcnTextBlockOuter">
		        <tr>
		            <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
		                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
		                    <tbody>
		                    	<tr>

			                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">

										<em>Copyright © <?php echo date("Y");?> IDEX, All rights reserved.</em>
			                        </td>
		                    	</tr>
		                	</tbody>
		            	</table>
		            </td>
		        </tr>
		    </tbody>
		</table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
