@extends('layouts.master')


@section('title')
    Elenco Allergeni
@endsection

@section('content')
    <div>
        <a class="btn btn-primary" href="{{ route('allergens.create') }}">Aggiungi Allergene</a>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">slug</th>
                    <th scope="col">description</th>
                    <th scope="col">icon</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($allergens as $allergen)
                    <tr>
                        <th scope="row">{{ $allergen->id }}</th>
                        <td>{{ $allergen->name }}</td>
                        <td>{{ $allergen->slug }}</td>
                        <td>{{ $allergen->description }}</td>
                        <td><img src="{{ $allergen->icon }}" alt="{{ $allergen->name }}"></td>
                        <td class="d-flex">
                            <a class="btn btn-info" href="{{ route('allergens.show', $allergen) }}">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a class="btn btn-warning" href="{{ route('allergens.edit', $allergen) }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('allergens.destroy', $allergen) }}" method="POST"
                                onsubmit="return confirm('Sei sicuro di voler eliminare questo allergene?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
