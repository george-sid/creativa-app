@extends('layouts.admin')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="flex">
                    <a href="{{route('employee.list')}}" class="btn btn-primary" style="margin-right:6px">{{__('Back')}}</a>
                    <h1>{{__('Employee')}}</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Employee')}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card card-info card-outline mb-4 mx-4">
    <form class="needs-validation" id="employeeForm">
        <div class="card-body">
            <div class="row g-3">
                <x-Forma.text name="id" type="hidden" :value="$employee?->id" />
                <x-Forma.text sm="12" md="12" lg="6" name="first_name" :value="$employee?->first_name" 
                    placeholder="{{__('Enter first name')}}" title="{{__('First name')}}" required/>

                <x-Forma.text sm="12" md="12" lg="6" name="last_name" :value="$employee?->last_name" 
                    placeholder="{{__('Enter last name')}}" title="{{__('Last name')}}" required/>

                <x-Forma.text sm="12" md="12" lg="6" name="email" :value="$employee?->email" 
                    placeholder="{{__('Enter email')}}" title="{{__('Email')}}" type="email"/>

                <x-Forma.text sm="12" md="12" lg="6" name="phone" :value="$employee?->phone" 
                    placeholder="{{__('Enter phone')}}" title="{{__('Phone')}}" />

                <x-Forma.select sm="12" md="12" lg="6" name="company_id" :value="$employee?->company_id" 
                    :query="App\Models\Company::all()" title="{{__('Company')}}" getValue="id" getLabel="name"/>

            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-info btn-save" type="submit">{{$employee?->id ? __('Save') : __('Create')}}</button>
        </div>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('employeeForm');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        const data = {};

        formData.forEach((value, key) => {
            data[key] = value;
        });

        // Clear previous errors
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback').forEach(el => el.innerHTML = '');

        fetch("{{ route('employee.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(async response => {
            const responseData = await response.json();

            if (!response.ok) {
                if (responseData.errors) {
                    // Add errors to fields with errors
                    Object.entries(responseData.errors).forEach(([key, messages]) => {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input) {
                            input.classList.add('is-invalid');
                            const feedback = input.closest('div').querySelector('.invalid-feedback');
                            if (feedback) {
                                feedback.innerHTML = messages.join('<br>');
                            }
                        }
                    });

                    // Clear errors on inputs without errors
                    form.querySelectorAll('input, select, textarea').forEach(input => {
                        if (!responseData.errors.hasOwnProperty(input.name)) {
                            input.classList.remove('is-invalid');
                            const feedback = input.closest('div').querySelector('.invalid-feedback');
                            if (feedback) {
                                feedback.innerHTML = '';
                            }
                        }
                    });
                }
            } else {
                window.toastr.success(
                    '{{ __("Employee named: :first :last successfully saved", ["first" => ":firstName", "last" => ":lastName"]) }}'
                        .replace(':firstName', responseData.first_name)
                        .replace(':lastName', responseData.last_name)
                );

                setTimeout(() => {
                    window.location.href = '/employees/' + responseData.id;
                }, 3000);
            }
        })
        .catch(error => {
            console.error('Unexpected error:', error);
            window.toastr.error('{{ __("Something went wrong. Contact with the administrator") }}');
        });
    });
});


</script>

@endsection