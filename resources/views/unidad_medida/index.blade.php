@extends('layouts.app')

@section('content')
    <div id="app">
        <unidad-component rol="{{ Auth::user()->rol }}"></unidad-component>
        
    </div>
@endsection