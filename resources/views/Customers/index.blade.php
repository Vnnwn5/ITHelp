@component('Components.main')
    @slot('title')
        Listado de Clientes
        <a href="{{ route('clientes.create') }}" class="btn btn-secondary float-right">
            <i class="fas fa-plus"></i> Crear Cliente
        </a>
    @endslot

@include('Customers.filter_form')
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col"># de identificación</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($customers as $customer)
                <tr id="target{{$customer->id}}">
                    <th scope="row">{{ $customer->id_number }}</th>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->last_name }}</td>
                    <td>
                        <a href="{{ route('clientes.show', [$customer]) }}" class="btn btn-outline-primary"><i class="fas fa-info-circle"></i> Ver más</a>
                        <a href="{{ route('clientes.edit', [$customer]) }}" class="btn btn-outline-dark"><i class="fas fa-edit"></i> Editar</a>
                        @can('check-admin')
                        <a href="{{ route('clientes.destroy', [$customer]) }}" class="btn btn-outline-danger" @click="getElementData" data-id={{ $customer->id }} data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Eliminar</a>
                        @endcan
                    </td>
                </tr>
            @empty
                <h3>No existen clientes almacenados en el sistema.</h3>
            @endforelse
            </tbody>
        </table>
    </div>>


    <section class="d-flex justify-content-center">
        {{ $customers->appends(request()->only('client_data'))->links() }}
    </section>
@endcomponent

