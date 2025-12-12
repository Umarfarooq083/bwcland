<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Plots
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Plots Listing</h3>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Sector</th>
                                <th>Street Number</th>
                                <th>Plot Number</th>
                                <th>Reg No</th>
                                <th>Plot Size</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plots as $plot)
                                <tr>
                                    <td>{{ $plot->sector }}</td>
                                    <td>{{ $plot->street_number }}</td>
                                    <td>{{ $plot->plot_number }}</td>
                                    <td>{{ $plot->reg_no }}</td>
                                    <td>{{ $plot->plot_size }}</td>
                                    <td>{{ number_format($plot->plot_price, 2) }}</td>
                                   
                                    <td>
                                        <a href="{{ route('plot.show',['id'=>$plot->id] ) }}" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">No plots found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
