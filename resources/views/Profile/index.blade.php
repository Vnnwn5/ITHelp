@component('Components.main')
    @slot('title')
        Mis datos
    @endslot
    <div class="table-responsive"><table class="table table-bordered table-hover">
            <tbody>
            <tr>
                <th>Avatar</th>
                <td>
                    @if(auth()->user()->avatar == 'default')
                        <img src="{{ asset('/storage/default.jpg') }}" alt="Avatar" class="img-thumbnail" width="70" height="70">
                    @else
                        <img src="{{ asset('/storage/avatars/'.auth()->user()->avatar) }}" alt="Avatar" class="img-thumbnail" width="70" height="70">
                    @endif
                </td>
            </tr>
            <tr>
                <th>Nombre</th>
                <td>{{ auth()->user()->name }}</td>
            </tr>
            <tr>
                <th>Apellido</th>
                <td>{{ auth()->user()->last_name }}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{{ auth()->user()->email }}</td>
            </tr>

            </tbody>
        </table>
    </div>

    <a href="{{ url('/') }}" class="btn btn-secondary">
        <i class="fas fa-undo"></i> Ir al inicio
    </a>
    <a href="{{ route('profile.edit_personal_data') }}" class="btn btn-warning">
        <i class="fas fa-edit"></i> Editar datos personales
    </a>
    <a href="{{ route('profile.edit_password') }}" class="btn btn-warning">
        <i class="fas fa-lock"></i> Editar contrasenia
    </a>
@endcomponent
