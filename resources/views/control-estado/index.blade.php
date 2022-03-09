<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambiar Estado - Solkem</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
<div class="w-75 m-auto">
    <header class="container mt-3">
        <h2>Actualizar Estado</h2>
    </header>
<div class="container m-auto">
    <div class="mb-3 row">
        <div class="card border border-primary bg-light m-3" style="width: 18rem;">
            <div class="card-header pl-3 pt-3 pb-1">
                <h5>Información del pedido:</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>n° Orden :</b> {{ $data['nroOrden'] }}</li>
                <li class="list-group-item"><b>Detalles:</b> {{ $data['detalles'] }}</li>
                <li class="list-group-item"><b>Social Cliente:</b> {{ $data['razon_social'] }}</li>
            </ul>
        </div>
        <div class="card border border-primary bg-light m-3" style="width: 18rem;">
            <div class="card-header pl-3 pt-3 pb-1">
                <h5>Fecha y Estado:</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Orden generada el:</b> {{ $data['created_at'] }}</li>
                <li class="list-group-item">
                    <b>Estado del pedido:</b>
                    @if ($data['estado_id'] === 1)
                    Incompleto, falta entrega
                    @elseif ($data['estado_id'] === 2)
                        Completo, el {{ $data['updated_at'] }}
                    @else
                        Entrega parcial. Fecha: {{ $data['updated_at'] }}
                    @endif
                </li>
                <li class="list-group-item mb-3">
                    @if ($data['paraEntrega'] !== null)
                        Envío a dirección
                    @else
                        Retiro en Sucursal - {{ $data['nombre'] }}
                    @endif

                    {{ $data['paraEntrega'] }} - @if ($data['fechaHora'] !== null)
                        {{ $data['fechaHora'] }}
                    @else
                        Turno no asignado
                    @endif{{ $data['fechaHora'] }}
                </li>
            </ul>
        </div>
    </div>

    <form id="estado-form" action="/cambio-estado" method="POST">
        @csrf
        <input type="text" name="id" value="{{ $data['id'] }}" hidden> {{ $data['id'] }}
        <input type="text" name="orden_id" value="{{ $data['orden_id'] }}" hidden>
        <input type="text" name="usuario_id" value="{{ $data['usuario_id'] }}" hidden>
        <div class="mb-3 row">
            <label for="detalles" class="col-sm-1-12 col-form-label text-dark mr-3">Modificar Detalles :</label>
            <textarea type="text|password|email|number|submit|date|datetime|datetime-local|month|color|range|search|tel|time|url|week" class="form-control text-dark" style="max-width:400px" name="detalles" id="detalles" placeholder="{{ $data['detalles'] }}"></textarea>

        </div>
        <div class="mb-3 row">
          <label for="estado" class="col-sm-1-12 col-form-label text-dark mr-3">Estado del pedido</label>
            <select class="form-control" style="max-width:400px" name="estado" id="estado" form="estado-form">
                <option value="incompleto">Incompleto</option>
                <option value="parcial">Parcial</option>
                <option value="completo">Completo</option>
            </select>
        </div>
        <div class="mb-3 row">

            <!-- Button trigger modal -->
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Actualizar Estado
                </button>
            </div>
            <div class="mt-3">
                <button type="button">
                    <a href="{{ url('/admin/turnos') }}" class="">Volver</a>
                </button>
            </div>
        </div>

            <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que quieres realizar los cambios?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                        <button id="submit-cambio-estado" type="submit" class="btn btn-primary">Actualizar Estado</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


</div>
</div>





</body>
</html>








