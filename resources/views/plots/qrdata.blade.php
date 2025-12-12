@extends('admin.layout.layout')

@section('title', 'Plot Details') 

@section('content')
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="font-weight-bold text-dark text-center">Plot Details</h1>
                </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="card">
                <div class="table-responsive">
                    <table id="tableList" class="table table-bordered nowrap datatable table-custom w-100 m-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sector</th>
                                <th>Street Number</th>
                                <th>Plot Number</th>
                                <th>Reg No</th>
                                <th>Plot Size</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $PlotsData->sector }}</td>
                                <td>{{ $PlotsData->street_number }}</td>
                                <td>{{ $PlotsData->plot_number }}</td>
                                <td>{{ $PlotsData->reg_no }}</td>
                                <td>{{ $PlotsData->plot_size }}</td>
                                <td>{{ number_format($PlotsData->plot_price, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

