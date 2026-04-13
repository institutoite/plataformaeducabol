@extends('adminlte::page')

@section('title', 'Educabol')

@section('content_header')
    <h1>Solicitudes de compra de cursos</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estudiante</th>
                        <th>Email</th>
                        <th>Curso</th>
                        <th>Fecha</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($purchaseRequests as $purchaseRequest)
                        <tr>
                            <td>{{ $purchaseRequest->id }}</td>
                            <td>{{ $purchaseRequest->user->name }}</td>
                            <td>{{ $purchaseRequest->user->email }}</td>
                            <td>{{ $purchaseRequest->course->title }}</td>
                            <td>{{ $purchaseRequest->created_at->format('d/m/Y H:i') }}</td>
                            <td width="10px">
                                <form action="{{ route('admin.course-purchase-requests.approve', $purchaseRequest) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm" type="submit">Aprobar</button>
                                </form>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.course-purchase-requests.reject', $purchaseRequest) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">Rechazar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No hay solicitudes pendientes por aprobar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($purchaseRequests->hasPages())
            <div class="card-footer">
                {{ $purchaseRequests->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
