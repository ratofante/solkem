<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generar Cliente - Solkem</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/generar-cliente.js') }}"></script>
</head>
<body>
<div class="logo-container">
        <img src="{{ asset('images/logo-solkem.png') }}" alt="">
</div>
<div class='volver-div'>
    <button type="button" class="btn volver-button" data-bs-dismiss="modal"><a href="{{ url('/admin/clientes') }}" class="volver-button">Volver</a></button>
</div>
<header class="d-flex align-items-center mb-5">
    <div class="mx-3 p-3">
        <h3 class="text-white">Generar nuevo cliente / usuario</h3>
    </div>
</header>
<div class="form-wrapper">
    <form id="gencli-form"
        action="/generar-cliente"
        method="post">
        @csrf

    <div class="mx-auto mx-lg-5 p-4 form-section box-custom">
        <h3>Datos Cliente: </h2>
        <div class="mb-3">
            <label for="cuit" class="form-label text-dark">CUIT :</label>
            <input type="text" class="form-control" id="cuit"
                name="cuit" required
                @isset($data) value="{{ $data['cuit'] }} "@endisset
                aria-describedby="cuit-help" placeholder="">
            <small id="cuit-help" class="form-text text-muted">Usa solo números, sin espacios ni guiones.</small>
        </div>
        <div class="mb-3">
            <label for="razon_social" class="form-label text-dark">Razón Social :</label>
            <input type="text" class="form-control" id="razon_social"
                name="razon_social" required
                @isset($data) value="{{ $data['razon_social'] }} "@endisset aria-describedby="rs-help" placeholder="">
            <small id="rs-help" class="form-text text-muted"></small>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label text-dark">Teléfono :</label>
            <input type="text" class="form-control" id="telefono"
                name="telefono" required
                @isset($data) value="{{ $data['telefono'] }}"@endisset aria-describedby="fono-help" placeholder="">
            <small id="fono-help" class="form-text text-muted"></small>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label text-dark">Dirección</label>
            <input type="text" class="form-control" id="direccion"
            name="direccion" required
            @isset($data) value="{{ $data['direccion'] }} "@endisset aria-describedby="dire-help" placeholder="">
            <small id="dire-help" class="form-text text-muted"></small>
        </div>
    </div>

    <div class="mx-auto mx-lg-5 p-4 form-section box-custom">
        <h3>Datos Usuario: </h3>
        <div class="mb-3">
            <label for="nombre" class="form-label text-dark">Nombre :</label>
            <input type="text" class="form-control" id="nombre"
                name="nombre" required
                @isset($data) value="{{$data['nombre'] }} "@endisset aria-describedby="name-help" placeholder="">
            <small id="name-help" class="form-text text-muted">Nombre del usuario asociado al cliente</small>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label text-dark">Apellido :</label>
            <input type="text" class="form-control" id="apellido"
                name="apellido" required
                @isset($data) value="{{$data['apellido'] }}"@endisset aria-describedby="ape-help" placeholder="">
            <small id="ape-help" class="form-text text-muted">Apellido del usuario asociado al cliente</small>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label text-dark">Correo Electrónico / eMail</label>
            <input type="text" class="form-control" id="email"
                name="email" required
                @isset($data) value="{{ $data['email'] }} "@endisset aria-describedby="mail-help" placeholder="mail@mailing.com">
            <small id="mail-help" class="form-text text-muted"></small>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label text-dark">Contraseña / Password :</label>
            <input type="password" class="form-control" id="password"
                name="password" required
                @isset($data) value="{{ $data['password'] }} "@endisset aria-describedby="pass-help" placeholder="">
            <small id="pass-help" class="form-text text-muted">Mínimo de 8 caracteres, con letras y números.</small>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modelId">
        Crear
        </button>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar nuevo Cliente / Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Seguro que quieres ingresar el cliente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Cliente</button>
                </div>
            </div>
        </div>
    </div>

</form>
</div>

</body>
</html>
