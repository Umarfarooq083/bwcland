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
                    <h3 class="text-lg font-semibold mb-4">Plot Detail</h3>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>QR Code </th>
                            </tr>
                        </thead>
                        <tbody>
                           @php 
                           $plotUrl = route('plot.qrcode', ['id'=>$encryptedId]);
                           @endphp
                                <tr>
                                   
                                    <td>{!! QrCode::size(200)->style('square')->generate($plotUrl) !!}<td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .table {
    width: 23%;
    margin-bottom: 1rem;
    color: #212529;
}
</style>