@extends('layouts.app')

@section('content')
    <div id="app">
        <catalogo-component  rol="{{ Auth::user()->rol }}"></catalogo-component>
        
    </div>
@endsection