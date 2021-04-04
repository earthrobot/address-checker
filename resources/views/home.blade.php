@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container container-lg">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <h1 class="display-3">Проверка адресов</h1>
                <p class="lead">Введите адрес</p>
                <form action="{{ route('addresses.store', false) }}" method="post" class="d-flex justify-content-center">
                    {{ csrf_field() }}
                    <input id="address" name="address" type="text" class="form-control form-control-lg">
                    <button type="submit" class="btn btn-lg btn-primary ml-3 px-6">Проверить</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection