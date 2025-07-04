@extends('layouts.admin')
@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{__('Dashboard')}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard')}}">{{__('Home')}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Dashboard')}} </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{$employeesCount}}</h3>
                        <p>{{__('Employees')}}</p>
                    </div>
                    <i class="small-box-icon fas fa-users"></i>
                    <a href="{{route('employee.list')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"> 
                        {{__('More')}}
                        <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{$companiesCount}}</h3>
                        <p>{{__('Companies')}}</p>
                    </div>
                    <i class="small-box-icon fa-solid fa-briefcase"></i>
                    <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"> 
                        {{__('More')}}
                        <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection