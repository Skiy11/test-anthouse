@extends('layout.template')
@section('content')

    <div class="col">
        <form id="registration-form" method="post" action="{{ route('send') }}">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" class="form-control" id="name" placeholder="Имя">
                </div>
            </div>
            <div class="form-group row">
                <label for="secondName" class="col-sm-2 col-form-label">Фамилия</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" class="form-control" id="secondName" placeholder="Фамилия">
                </div>
            </div>

            <div class="form-row">
                <legend class="col-form-legend col-sm-2">Пол</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="male" checked>
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
                    <input type="text" class="form-control" id="group" placeholder="Номер группы">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10 col-md-6">
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
            </div>

            <div class="form-group row">
                <label for="VNO" class="col-sm-2 col-form-label">Сумма баллов на ВНО </label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" class="form-control" id="VNO" placeholder="Сумма баллов на ВНО">
                </div>
            </div>

            <div class="form-group">
                <label for="location">Проживание</label>
                <select class="form-control" id="location">
                    <option>Местный</option>
                    <option>Иногородний</option>
                </select>
            </div>

            <div class="form-group row">
                <label for="dob" class="col-2 col-form-label">Дата рождения</label>
                <div class="col-10">
                    <input class="form-control" type="date" value="2011-08-19" id="dob">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>

@stop
