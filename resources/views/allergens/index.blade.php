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
                        <td>
                            @if ($allergen->icon)
                                <img class="img-fluid v-25" src="{{ asset('storage/' . $allergen->icon) }}"
                                    alt="immagine che rappresenta {{ $allergen->name }}" width="40">
                            @endif
                        </td>
                        <td class="d-flex">
                            <a class="btn btn-info" href="{{ route('allergens.show', $allergen) }}">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a class="btn btn-warning" href="{{ route('allergens.edit', $allergen) }}">
                                <i class="bi bi-pencil"></i>
                            </a>

                            @auth
                                @if (auth()->user()->role === 'admin')
                                    <form action="{{ route('allergens.destroy', $allergen) }}" method="POST"
                                        onsubmit="return confirm('Sei sicuro di voler eliminare questo allergene?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-danger" disabled>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endif
                            @endauth


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
