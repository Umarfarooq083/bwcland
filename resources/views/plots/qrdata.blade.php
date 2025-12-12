@extends('admin.layout.layout')

@section('title', 'Plot Details') 

@section('content')
    <style>
        .table td, .table th {
            border-color: #343a40;
        }
        .table th {
            font-weight: 700;
            color: #000000;
        }
    </style>

    <div class="container">
        <div class="text-center mt-2">
            <img src="{{ url('admin/assets/images/bwc.png') }}" alt="BWC Logo" height="60">
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-bordered w-100">
                <colgroup>
                    <col span="1" style="width: 150px;">
                    <col span="1" style="width: 150px;">
                </colgroup>
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th colspan="2">Booking Form Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Sector</th>
                        <td>{{ $PlotsData->sector }}</td>
                    </tr>
                    <tr>
                        <th>Street Number</th>
                        <td>{{ $PlotsData->street_number }}</td>
                    </tr>
                    <tr>
                        <th>Plot Number</th>
                        <td>{{ $PlotsData->plot_number }}</td>
                    <tr>
                        <th>Reg No</th>
                        <td>{{ $PlotsData->reg_no }}</td>
                    </tr>
                    <tr>
                        <th>Plot Size</th>
                        <td>{{ $PlotsData->plot_size }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ number_format($PlotsData->plot_price, 2) }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <a href="https://downtown.blueworldcity.com/DTA1/" class="btn btn-primary btn-sm">View Map</a>
            </div>
        </div>
    </div>
@endsection

