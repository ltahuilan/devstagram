@extends('layouts.app')

@section('titulo')
    Home Page
@endsection

@section('contenido')

    {{-- componente --}}
    <x-listar-posts :posts="$posts"/>

@endsection