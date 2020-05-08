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
    <br>
    <div class="container">
        <img class="float-lg-right" src="" alt="">
        <br>
        <br>
        <br>
        <h1 class="text-center">Encuesta IDEX - {{ $data["encuesta"] }}</h1>
        <br>
        <div class="shadow-lg p-4 mb-4 bg-white rounded-lg">
            <form action="{{route('respuesta.store')}}" method="POST">
                @csrf
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
                                    <div class="custom-control custom-radio">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">NO SE</label>
                                        </div>
                                    </div>
                                @endif
                                @if ($informacionPreguntas[$i]["multiple"] == 0)
                                    <input type="text" class="form-control" id="respuesta" name="respuesta" placeholder="Escirbe tu respuesta">
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
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