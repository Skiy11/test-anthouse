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
        @else
            <div class="alert alert-success">
                <p>Cпасибо, данные сохранены, вы можете их отредактировать или просмотреть список абитуриентов</p>
            </div>
        @endif

        <form id="registration-form" method="post" action="{{ route('registration') }}">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" class="form-control {{ (count($errors) > 0 && $errors->has('name')) ? 'is-invalid' : '' }}" name="name" placeholder="Имя">
                </div>
            </div>
            <div class="form-group row">
                <label for="secondName" class="col-sm-2 col-form-label">Фамилия</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" class="form-control {{ (count($errors) > 0 && $errors->has('secondName')) ? 'is-invalid' : '' }}" name="secondName" placeholder="Фамилия">
                </div>
            </div>

            <div class="form-row">
                <legend class="col-form-legend col-sm-2">Пол</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="male">
                            Мужской
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="female">
                            Женский
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="group" class="col-sm-2 col-form-label">Номер группы</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" class="form-control {{ (count($errors) > 0 && $errors->has('group')) ? 'is-invalid' : '' }}" name="group" placeholder="Номер группы">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10 col-md-6">
                    <input type="email" class="form-control {{ (count($errors) > 0 && $errors->has('email')) ? 'is-invalid' : '' }}" name="email" placeholder="Email">
                </div>
            </div>

            <div class="form-group row">
                <label for="points" class="col-sm-2 col-form-label">Сумма баллов на ВНО </label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" class="form-control {{ (count($errors) > 0 && $errors->has('points')) ? 'is-invalid' : '' }}" name="points" placeholder="Сумма баллов на ВНО">
                </div>
            </div>

            <div class="form-group row">
                <label for="location" class="col-2 col-form-label">Проживание</label>
                <div class="col-6">
                    <select class="form-control {{ (count($errors) > 0 && $errors->has('location')) ? 'is-invalid' : '' }}" name="location">
                        <option value=""></option>
                        <option value="Местный">Местный</option>
                        <option value="Иногородний">Иногородний</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="dob" class="col-2 col-form-label">Дата рождения</label>
                <div class="col-6">
                    <input class="form-control {{ (count($errors) > 0 && $errors->has('dob')) ? 'is-invalid' : '' }}" type="date" value="" name="dob">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>

@stop
