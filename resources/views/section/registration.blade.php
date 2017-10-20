@extends('layout.template')
@section('content')

    <div class="col">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            @if ($registerEnrollee['cookie'])
                <div class="alert alert-success">
                    <p>Cпасибо, данные сохранены, вы можете их отредактировать или просмотреть список абитуриентов</p>
                </div>
            @endif

        <form id="registration-form" method="post" action="{{ route('registration') }}">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           class="form-control {{ (count($errors) > 0 && $errors->has('name')) ? 'is-invalid' : '' }}"
                           name="name"
                           placeholder="Имя"
                            value="{{$registerEnrollee['name'] ?: ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="second_name" class="col-sm-2 col-form-label">Фамилия</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           class="form-control {{ (count($errors) > 0 && $errors->has('second_name')) ? 'is-invalid' : '' }}"
                           name="second_name"
                           placeholder="Фамилия"
                           value="{{$registerEnrollee['second_name'] ?: ''}}">
                </div>
            </div>

            <div class="form-row">
                <legend class="col-form-legend col-sm-2">Пол</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input"
                                   type="radio"
                                   name="sex"
                                   id="male"
                                   value="male"
                                    {{($registerEnrollee && $registerEnrollee['sex'] == 'male') ? 'checked' : ''}}>
                            Мужской
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input"
                                   type="radio"
                                   name="sex"
                                   id="female"
                                   value="female"
                                    {{($registerEnrollee && $registerEnrollee['sex'] == 'Женский') ? 'female' : ''}}>
                            Женский
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="group" class="col-sm-2 col-form-label">Номер группы</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           class="form-control {{ (count($errors) > 0 && $errors->has('group')) ? 'is-invalid' : '' }}"
                           name="group"
                           placeholder="Номер группы"
                           value="{{$registerEnrollee['group'] ?: ''}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10 col-md-6">
                    <input type="email"
                           class="form-control {{ (count($errors) > 0 && $errors->has('email')) ? 'is-invalid' : '' }}"
                           name="email"
                           placeholder="Email"
                           value="{{$registerEnrollee['email'] ?: ''}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="points" class="col-sm-2 col-form-label">Сумма баллов на ВНО </label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           class="form-control {{ (count($errors) > 0 && $errors->has('points')) ? 'is-invalid' : '' }}"
                           name="points"
                           placeholder="Сумма баллов на ВНО"
                           value="{{$registerEnrollee['points'] ?: ''}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="location" class="col-2 col-form-label">Проживание</label>
                <div class="col-6">
                    <select class="form-control {{ (count($errors) > 0 && $errors->has('location')) ? 'is-invalid' : '' }}" name="location">
                        <option value=""></option>
                        <option value="Местный" {{($registerEnrollee && $registerEnrollee['location'] == 'Местный') ? 'selected' : ''}}>Местный</option>
                        <option value="Иногородний" {{($registerEnrollee && $registerEnrollee['location'] == 'Иногородний') ? 'selected' : ''}}>Иногородний</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="dob" class="col-2 col-form-label">Дата рождения</label>
                <div class="col-6">
                    <input class="form-control {{ (count($errors) > 0 && $errors->has('dob')) ? 'is-invalid' : '' }}"
                           type="date"
                           name="dob"
                           value="{{$registerEnrollee['dob'] ?: '' }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{$registerEnrollee['cookie'] ? 'Обновить данные' : 'Зарегистрироваться'}}</button>
        </form>
    </div>

@stop
