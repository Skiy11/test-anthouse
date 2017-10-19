@extends('layout.template')
@section('content')

    <div class="col">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Номер группы</th>
                <th>Баллы</th>
            </tr>
            </thead>
            <tbody>


            @foreach ($enrollees as $enrollee)
                <tr>
                    <td>{{$enrollee->name}}</td>
                    <td>{{$enrollee->second_name}}</td>
                    <td>{{$enrollee->group}}</td>
                    <td>{{$enrollee->points}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        {{ $enrollees->links() }}
    </div>

@stop
