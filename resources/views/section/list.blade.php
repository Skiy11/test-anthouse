@extends('layout.template')
@section('content')

    <div class="col">
        @if (isset($searchQuery))
            <p><a href="{{ url('/') }}">Показать всех абитуриентов</a></p>
            <p>Показаны только абитуриенты, найденные по запросу - {{ $searchQuery }}</p>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <th><a href="{{ route('sorting', ['field' => 'name', 'sort' => isset($getSort) ? $getSort : 'asc']) }}">Имя</a></th>
                <th><a href="{{ route('sorting', ['field' => 'second_name', 'sort' => isset($getSort) ? $getSort : 'asc']) }}">Фамилия</a></th>
                <th><a href="{{ route('sorting', ['field' => 'group', 'sort' => isset($getSort) ? $getSort : 'asc']) }}">Номер группы</a></th>
                <th><a href="{{ route('sorting', ['field' => 'points', 'sort' => isset($getSort) ? $getSort : 'asc']) }}">Баллы</a></th>
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
