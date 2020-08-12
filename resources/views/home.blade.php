@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido {{ Auth::user()->name }}</div>

                <div class="card-body">
                    <div class="row justify-content-center">

                        <img src="{{ asset('images/GSM1.png') }}" class=" img-fluid" alt="Responsive image" width="377" height="204" ><br>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
