@extends('layouts.master')


@section('title')
    Elenco Allergeni
@endsection

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">slug</th>
                    <th scope="col">description</th>
                    <th scope="col">icon</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($allergenes as $allergen)
                    <tr>
                        <th scope="row">{{ $allergen->id }}</th>
                        <td>{{ $allergen->name }}</td>
                        <td>{{ $allergen->slug }}</td>
                        <td>{{ $allergen->description }}</td>
                        <td>{{ $allergen->icon }}</td>
                        <td>{{ $allergen->created_at }}</td>
                        <td>{{ $allergen->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
