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
                                        <div class="flex">
                                        <a href="{{ route('employee.update', ['id' => $employee->id]) }}" class="btn btn-sm btn-primary">{{__('Edit')}}</a>
                                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" class="ml-3 delete-employee-form" data-id="{{ $employee->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                        </div>
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
    let datatable
    document.addEventListener('DOMContentLoaded', function () {
        datatable = new DataTable('#companiesTable', {
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            destroy:true,
            pageLength: 10,
            pagingType: 'numbers',
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/{{ app()->getLocale() === 'el' ? 'el' : 'en-GB' }}.json"
            }
        });

        document.querySelectorAll('.delete-employee-form').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                if (!confirm("{{ __('Delete this employee?') }}")) return;

                const url = form.getAttribute('action');
                const csrf = form.querySelector('input[name="_token"]').value;
                const companyId = this.getAttribute('data-id');

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        id: companyId
                    })
                })
                .then(async response => {
                    const text = await response.text();
                    if (!response.ok) throw new Error(text || 'Request failed');

                    try {
                        return JSON.parse(text);
                    } catch {
                        throw new Error('Invalid JSON response');
                    }
                })
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success(data.message);
                        const row = form.closest('tr');
                        datatable.rows(row).remove().draw(false);
                    } else {
                        toastr.error(data.message || 'Something went wrong');
                    }
                })
                .catch(error => {
                    toastr.error("{{ __('Something went wrong. Contact with the administrator') }}");
                });
            });
        });
    });
</script>

@endsection