@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Создание вакансии') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('vacancy.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Название') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Компания') }}</label>

                                <div class="col-md-6">
                                    <select id="company_id" class="form-control" name="company_id" required>
                                        <option value="" selected disabled hidden>Choose here</option>
                                    </select>

                                    @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}</label>
                                <div class="col-md-6">
                                    <input id="description" type="text"
                                           class="form-control @error('description') is-invalid @enderror"
                                           name="description"
                                           value="{{ old('description') }}" required max="300">
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary submit">
                                        {{ __('Создать вакансию') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            function option(index, value, params = '') {
                return '<option value="' + index + '" ' + params + '>' + value + '</option>'
            }
            var company_select = $("#company_id");
            var companies;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "get",
                url: "/api/company/all",
                success: function (result) {
                    $.each(result, function () {
                        companies = result;
                        company_select.append(option(this.id, this.name, 'vpd=' + this.vac_per_day));
                    })
                },
                error: function () {
                    company_select.append(option('', 'На сайте пока нет компаний', 'disabled selected hidden'))
                },
            });
            company_select.change(function () {
                if (company_select.find('option:selected').attr('vpd') == 3) {
                    $('.submit').prop('disabled', true);
                    alert('Эта компания достигла лимита вакансий в день!');
                } else {
                    $('.submit').prop('disabled', false);
                }
            })
        })
    </script>
@endsection
