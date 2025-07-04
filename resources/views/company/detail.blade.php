@extends('layouts.admin')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="flex">
                    <a href="{{route('company.list')}}" class="btn btn-primary" style="margin-right:6px">{{__('Back')}}</a>
                    <h1>{{__('Company')}}</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Company')}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card card-info card-outline mb-4 mx-4">
    <form class="needs-validation" id="companyForm" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row g-3">
                <x-Forma.text name="id" type="hidden" :value="$company?->id" />

                <x-Forma.text sm="12" md="12" lg="6" name="name" :value="$company?->name" 
                    placeholder="{{__('Enter name')}}" title="{{__('Name')}}" required/>

                <x-Forma.text sm="12" md="12" lg="6" name="email" :value="$company?->email" 
                    placeholder="{{__('Enter email')}}" title="{{__('Email')}}" type="email"/>

                <x-Forma.text sm="12" md="12" lg="6" name="website" :value="$company?->website" 
                    placeholder="{{__('Enter website')}}" title="{{__('Website')}}"/>

                <x-Forma.fileUpload sm="12" md="12" lg="6" name="logo" placeholder="{{__('Upload logo')}}" 
                    title="{{__('Logo')}}"/>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-info btn-save" type="submit">{{$company?->id ? __('Save') : __('Create')}}</button>
        </div>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('companyForm');

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

        fetch("{{ route('company.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
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
                    '{{ __("Company named: :name successfully saved", ["name" => ":name"]) }}'
                        .replace(':name', responseData.name)
                );

                setTimeout(() => {
                    window.location.href = '/companies/' + responseData.id;
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