@extends('layout.app')
@section('content')
    <div class="container">
        <table class="container table table-hover table table-borderled">
            <thead>
            <tr>
                <th scope="col-2">Название вакансии</th>
                <th scope="col-6">Описание</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vacancies as $vacancy)
                <tr>
                    <td href="{{route('vacancy.show', $vacancy->id)}}">{{$vacancy->name}}</td>
                    <td>{{substr( $vacancy->description, 0, strpos($vacancy->description, ' ', strlen($vacancy->description)/2))}}...</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="form-group row mb-0">
            <div class=" offset-md-1">
                <a href="{{route('vacancy.create')}}" class="btn btn-primary">
                    {{ __('Make a vacancy') }}
                </a>
            </div>
        </div>
    </div>
@endsection
