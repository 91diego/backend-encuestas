<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Encuesta IDEX - {{ $data["encuesta"] }}</title>
  </head>
  <body>
    <div class="container">
        <img class="float-lg-right" src="" alt="">
        <br>
        <h1 class="text-center">Encuesta IDEX - {{ $data["encuesta"] }}</h1>
        <br>
        <div class="shadow-lg p-4 mb-4 bg-white rounded-lg">
            @switch($data["fase"])
                @case("Primer Contacto")
                    <h4>¡Hola!</h4>
                    <p>Tu opinión es muy importante para nosotros ya que de esta manera podremos ofrecerte la atención y servicio que mereces.</p>
                    <p>Te invito a responder estas breves preguntas respecto al asesor de ventas que te atendió.</p>
                    @break
                @case(2)
                    
                    @break
                @default
                    
            @endswitch
            <form action="{{route('respuesta.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="id_negociacion" readonly value="{{ $data["id_negociacion"] }}" style="display: none">
                </div>
                @foreach ($informacionPreguntas as $i => $valueI)
                    @foreach ($informacionPreguntas[$i] as $j => $value)
                        @if ($j == 'descripcion')
                            <div class="form-group">
                                <label for="exampleInputPassword1">
                                    <strong>
                                        {{ $informacionPreguntas[$i]["numero"].".- ".$informacionPreguntas[$i]["descripcion"]}}
                                    </strong>
                                </label>
    
                                <!-- VALID SI ES OPCION MULTIPLE -->
                                @if ($informacionPreguntas[$i]["multiple"] == 1)
                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                    <div class="custom-control custom-radio">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio1" value="Si">
                                            <label class="form-check-label" for="inlineRadio1">Si</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="respuesta_multiple{{ $informacionPreguntas[$i]['numero'] }}" id="inlineRadio2" value="No">
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </div>
                                @endif
                                @if ($informacionPreguntas[$i]["multiple"] == 0)
                                    <input type="text" class="form-control" id="respuesta" name="id{{ $informacionPreguntas[$i]['numero'] }}" value="{{ $informacionPreguntas[$i]['id'] }}" readonly style="display: none">
                                    <input type="text" class="form-control" id="respuesta" name="respuesta{{ $informacionPreguntas[$i]['numero'] }}" placeholder="Escribe tu respuesta">
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endforeach
                <button type="submit" class="text-center btn btn-outline-success btn-lg">Enviar encuesta</button>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>