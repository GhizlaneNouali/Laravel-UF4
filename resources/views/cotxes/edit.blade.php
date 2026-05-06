@extends('layouts.app')

@section('content')

<h2>✏️ Editar cotxe</h2>

<form method="POST" action="{{ route('cotxes.update', $cotxe) }}">
@csrf
@method('PUT')

<input type="text" name="model" value="{{ $cotxe->model }}" class="form-control mb-2">

<input type="number" name="any" value="{{ $cotxe->any }}" class="form-control mb-2">

<textarea name="descripcio" class="form-control mb-2">{{ $cotxe->descripcio }}</textarea>

<input type="text" name="imatge_principal" value="{{ $cotxe->imatge_principal }}" class="form-control mb-2">

<button class="btn btn-success">Guardar</button>

</form>

@endsection