@component('Components.main')
    @slot('title')
        Editando mi contrasenia
    @endslot

    {!! Form::model(auth()->user(), ['route' => 'profile.update', 'method' => 'put', 'files'=> true]) !!}

    <div class="form-group">
        {!! Form::label('old_password', 'Contrasenia actual') !!}
        {!! Form::password('password', [
            'placeholder' => 'Ingresa la contrasenia actual',
            'class' => 'form-control '.(!empty($errors->first('old_password')) ? 'is-invalid' : '')]);
        !!}
        @error('old_password')
        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('password', ' Nueva contrasenia') !!}
        {!! Form::password('password', [
            'placeholder' => 'Ingresa la nueva password',
            'class' => 'form-control '.(!empty($errors->first('password')) ? 'is-invalid' : '')]);
        !!}
        @error('password')
        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirmar nueva contrasenia') !!}
        {!! Form::password('password_confirmation',  [
            'placeholder' => 'Confirme la nueva  password',
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
            <i class="fas fa-save"></i> Actualizar
        </button>
        <a href="{{ route('profile.index') }}" class="btn btn-secondary">
            <i class="fas fa-undo"></i> Regresar
        </a>
    </div>
    {!! Form::close() !!}
@endcomponent
