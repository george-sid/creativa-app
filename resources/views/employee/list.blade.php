@extends('layouts.admin')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Employees')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Employees')}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__('List of all employees')}}</h3>
                    <div class="float-sm-right">
                        <a href="{{route('employee.create')}}" class="btn btn-primary">{{__('Create employee')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="companiesTable" class="table table-bordered table-hover dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th>{{__('First name')}}</th>
                                <th>{{__('Last name')}}</th>
                                <th>{{__('Company')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Phone')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->company?->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">{{__('Edit')}}</a>
                                        <form action="#" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this company?')">{{__('Delete')}}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        new DataTable('#companiesTable', {
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 10,
            pagingType: 'numbers',
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/{{ app()->getLocale() === 'el' ? 'el' : 'en-GB' }}.json"
            }
        });
    });
</script>

@endsection