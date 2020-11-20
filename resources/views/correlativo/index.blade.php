@extends('layouts.app')

@section('content')
    <div id="app">
        <correlativo-component rol="{{ Auth::user()->rol }}"></correlativo-component>        
    </div>    
@endsection