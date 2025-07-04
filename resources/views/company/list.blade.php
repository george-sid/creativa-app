@extends('layouts.admin')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Companies')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Companies')}}</li>
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
                    <h3 class="card-title">{{__('List of all comapnies')}}</h3>
                    <div class="float-sm-right">
                        <a href="{{route('company.create')}}" class="btn btn-primary">{{__('Create company')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="companiesTable" class="table table-bordered table-hover dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Webiste')}}</th>
                                <th>{{__('Logo')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->webiste }}</td>
                                    <td>
                                        @if ($company->logo)
                                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" style="max-width: 100px; max-height: 100px;">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex">
                                            <a href="{{ route('company.update', ['id' => $company->id]) }}" class="btn btn-sm btn-primary">{{__('Edit')}}</a>
                                            <form action="{{ route('company.destroy', $company->id) }}" method="POST" class="ml-3 delete-company-form" data-id="{{ $company->id }}">
                                                @csrf
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

        document.querySelectorAll('.delete-company-form').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                if (!confirm("{{ __('Delete this company?') }}")) return;

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