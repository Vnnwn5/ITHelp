@component('Components.main')
    @slot('title')
        {{ !empty($customer) ? 'Editar ' : 'Crear ' }} Cliente
    @endslot

    @if(!empty($customer))
        {!! Form::model($customer, ['route' => ['clientes.update', $customer->id], 'method' => 'put']) !!}
    @else
        {!! Form::open(['route' => 'clientes.store', 'method' => 'post']) !!}
    @endif


    <div class="form-group">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, [
            'placeholder' => 'Ingresa el nombre del cliente',
            'class' => 'form-control '.(!empty($errors->first('name')) ? 'is-invalid' : '')]);
        !!}
        @error('name')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('last_name', 'Apellido') !!}
        {!! Form::text('last_name', null, [
            'placeholder' => 'Ingresa el apellido del cliente',
            'class' => 'form-control '.(!empty($errors->first('last_name')) ? 'is-invalid' : '')]);
        !!}
        @error('last_name')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('id_number', 'Número de identificación') !!}
        {!! Form::text('id_number', null, [
            'placeholder' => 'Ingresa número de identificación del cliente',
            'class' => 'form-control '.(!empty($errors->first('id_number')) ? 'is-invalid' : '')]);
        !!}
        @error('id_number')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Dirección de correo electrónico') !!}
        {!! Form::email('email', null, [
            'placeholder' => 'Ingresa dirección de correo electrónico',
            'class' => 'form-control '.(!empty($errors->first('email')) ? 'is-invalid' : '')]);
        !!}
        @error('email')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('address', 'Dirección') !!}
        {!! Form::textarea('address', null, [
            'placeholder' => 'Ingresa la dirección del cliente',
            'class' => 'form-control '.(!empty($errors->first('address')) ? 'is-invalid' : '')]);
        !!}
        @error('address')
        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('phone', 'Número telefónico') !!}
        {!! Form::text('phone', null, [
            'placeholder' => 'Ingresa número telefónico del cliente',
            'class' => 'form-control '.(!empty($errors->first('phone')) ? 'is-invalid' : '')]);
        !!}
        @error('phone')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> {{ !empty($customer) ? 'Actualizar ' : 'Guardar ' }}
        </button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
            <i class="fas fa-undo"></i> Ir al listado
        </a>
    </div>
    {!! Form::close() !!}
@endcomponent
