@component('Components.main')
    @slot('title')
        Listado de Tecnicos
        <a href="{{ route('tecnicos.create') }}" class="btn btn-secondary float-right">
            <i class="fas fa-plus"></i> Crear Tecnico
        </a>
    @endslot

    @include('Technicians.filter_form')
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Avatar</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($technicians as $technician)
                <tr id="target{{$technician->id}}">
                    <th>
                        @if($technician->avatar == 'default')
                            <img src="{{ asset('/storage/default.jpg') }}" alt="Avatar" class="img-thumbnail" width="50" height="50">
                        @else
                            <img src="{{ asset('/storage/avatars/'.$technician->avatar) }}" alt="Avatar" class="img-thumbnail" width="50" height="50">
                        @endif
                    </th>
                        <td>{{ $technician->name }}</td>
                        <td>{{ $technician->last_name }}</td>
                        <td>{{ $technician->email }}</td>
                        <td>
                        <a href="{{ route('tecnicos.show', [$technician]) }}" class="btn btn-outline-primary"><i class="fas fa-info-circle"></i> Ver más</a>
                        <a href="{{ route('tecnicos.edit', [$technician]) }}" class="btn btn-outline-dark"><i class="fas fa-edit"></i> Editar</a>
                        <a href="{{ route('tecnicos.destroy', [$technician]) }}" class="btn btn-outline-danger" @click="getElementData" data-id={{ $technician->id }} data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Eliminar</a>
                    </td>
                </tr>
            @empty
                <h3>No existen tecnicos almacenados en el sistema.</h3>
            @endforelse
            </tbody>
        </table>
    </div>


    <section class="d-flex justify-content-center">
        {{ $technicians->appends(request()->only('tech_data'))->links() }}
    </section>
@endcomponent

