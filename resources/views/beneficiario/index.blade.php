@extends('layouts.app')

@section('content')
    <div id="app">
        <beneficiario-component  rol="{{ Auth::user()->rol }}"></beneficiario-component>
        
    </div>
@endsection