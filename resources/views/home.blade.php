@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container container-lg">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <h1 class="display-3">Проверка адресов</h1>
                <p class="lead">Введите адрес</p>
                <form id="address-form" action="{{ route('addresses.store', false) }}" method="post" class="d-flex justify-content-center">
                    {{ csrf_field() }}
                    <input id="address" name="address" type="text" class="form-control form-control-lg">
                    <input id="full_address" name="full_address" type="text" style="display:none;">
                    <input id="federal_district" name="federal_district" type="text" style="display:none;">
                    <input id="region_with_type" name="region_with_type" type="text" style="display:none;">
                    <input id="area_with_type" name="area_with_type" type="text" style="display:none;">
                    <input id="city_with_type" name="city_with_type" type="text" style="display:none;">
                    <input id="city_district_with_type" name="city_district_with_type" type="text" style="display:none;">
                    <input id="settlement_with_type" name="settlement_with_type" type="text" style="display:none;">
                    <input id="street_with_type" name="street_with_type" type="text" style="display:none;">
                    <input id="house_type_full" name="house_type_full" type="text" style="display:none;">
                    <input id="house" name="house" type="text" style="display:none;">
                    <button type="submit" class="btn btn-lg btn-primary ml-3 px-6">Проверить</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection