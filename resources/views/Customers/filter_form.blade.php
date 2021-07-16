{!! Form::model(request()->all(), ['route' => 'clientes.index', 'method' => 'GET', 'class' => 'form-inline']) !!}

{!! Form::label('client_data', ' Dato del cliente ', ['class' => 'mr-sm-2']) !!}
{!! Form::text('client_data', null, [
    'placeholder' => 'Ingresa el id, nombre o apellido',
    'class' => 'form-control mr-sm-2 col-md-4']);
!!}

<button type="submit" class="btn btn-primary mr-sm-2">
    <i class="fas fa-search"></i> Filtrar
</button>
<a href="{{ route('clientes.index') }}" class="btn btn-dark">
    <i class="fas fa-sync-alt"></i> Reiniciar
</a>
{!! Form::close() !!}<br>
