@component('Components.main')
    @slot('title')
        {{ !empty($technician) ? 'Editar ' : 'Crear ' }} Tecnico
    @endslot

    @if(!empty($technician))
        {!! Form::model($technician, ['route' => ['tecnicos.update', $technician->id], 'method' => 'put', 'files'=> true]) !!}
    @else
        {!! Form::open(['route' => 'tecnicos.store', 'method' => 'post', 'files'=> true]) !!}
    @endif


    <div class="form-group">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, [
            'placeholder' => 'Ingresa el nombre del tecnico',
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
            'placeholder' => 'Ingresa el apellido del tecnico',
            'class' => 'form-control '.(!empty($errors->first('last_name')) ? 'is-invalid' : '')]);
        !!}
        @error('last_name')
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
        {!! Form::label('avatar_label', 'Avatar') !!}
        <div class="custom-file">
            {!! Form::file('avatar', ['id' => 'avatar','class' => 'custom-file-input '. ( (!empty($errors->first('avatar')) || session()->has('file_error')) ? 'is-invalid' : '')]) !!}
            {!! Form::label('avatar', 'Elige un archivo (jpg, jpeg, png, gif)', ['class' => 'custom-file-label']) !!}
            @error('avatar')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if(session()->has('file_error'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ session('file_error') }}</strong>
                </span>
                @enderror
        </div>
    </div>


    <div class="form-group">
        {!! Form::label('password', 'contrasenia') !!}
        {!! Form::password('password', [
            'placeholder' => 'Ingresa el password',
            'class' => 'form-control '.(!empty($errors->first('password')) ? 'is-invalid' : '')]);
        !!}
        @error('password')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirmar contrasenia') !!}
        {!! Form::password('password_confirmation',  [
            'placeholder' => 'Confirme el password',
            'class' => 'form-control '.(!empty($errors->first('password_confirmation')) ? 'is-invalid' : '')]);
        !!}
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> {{ !empty($technician) ? 'Actualizar ' : 'Guardar ' }}
        </button>
        <a href="{{ route('tecnicos.index') }}" class="btn btn-secondary">
            <i class="fas fa-undo"></i> Ir al listado
        </a>
    </div>
    {!! Form::close() !!}
@endcomponent
