
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Plot Detail</h3>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
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

