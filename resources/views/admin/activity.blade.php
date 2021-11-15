@extends('admin.layouts.app')

@section('content')

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">URL</th>
        <th scope="col">Views</th>
        <th scope="col">Last Visit</th>
    </tr>
    </thead>
    <tbody>
    @foreach($visits as $visit)
        <tr>
            <th scope="row">{{ $visit['id'] }}</th>
            <td>{{ $visit['url'] }}</td>
            <td>{{ $visit['views'] }}</td>
            <td>{{ $visit['last_visit'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $visits->links() }}
@stop
