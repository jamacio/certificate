@extends('layouts.app')

@section('title', 'Certificados')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="/certificates" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" />
        <button type="submit">Upload</button>
    </form>

    <table>
        <tr>
            <th>Nome Certificados</th>
            <th>Visualizar</th>
            <th>Remover</th>
        </tr>
        @foreach ($certificates as $certificate)
        <tr>
            <td>{{ $certificate->image }}</td>
            <td>
                @if (strpos($certificate->image, '.pdf') !== false)
                <iframe src="{{ url('uploads/' . $certificate->image) }}"></iframe>
                @else
                <img src="{{ url('uploads/' . $certificate->image) }}" alt="Certificado" />
                @endif
            </td>
            <td>
                <form action="/certificates/remove" method="post">
                    <input type="hidden" name="remove-file" value="{{ $certificate->id }}" />
                    <button type="submit">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection