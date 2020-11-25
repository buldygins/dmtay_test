@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($companies as $company)
                <div class="col-3 m-3">
                    <h4>{!! $company->name !!}</h4>
                    <span>Кол-во вакансий на сайте: {{$company->vacancies->count()}}</span><br>
                </div>
            @endforeach
        </div>
        <div class="form-group row mb-0">
            <div class=" offset-md-1">
                <a href="{{route('company.create')}}" class="btn btn-primary">
                    {{ __('Make a company') }}
                </a>
            </div>
        </div>
    </div>
@endsection
