@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mt-5 mb-3">Адреса</h1>

    @forelse ($addresses_by_regions as $region => $addresses)

    <h2>{{ $region }}, количество адресов: {{ count($addresses) }}.</h2>

        <table class="table mt-2">
            <thead>
                <tr>
                    <th>Регион</th>
                    <th>Район</th>
                    <th>Город или поселение</th>
                    <th>Городской район</th>
                    <th>Улица</th>
                    <th>Дом</th>
                    <th>Полный адрес</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($addresses as $address)
                <tr>
                    <td>{{ $address->region_with_type }}</td>
                    <td>{{ $address->area_with_type }}</td>
                    <td>{{ $address->city_with_type ?? $address->settlement_with_type}}</td>
                    <td>{{ $address->city_district_with_type }}</td>
                    <td>{{ $address->street_with_type }}</td>
                    <td>{{ $address->house_type_full }} {{ $address->house }}</td>
                    <td>{{ $address->full_address }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @empty
        <p>No data</p>
    @endforelse
</div>
@endsection