@extends('layouts.LandingApp')

@section('title', 'Transaksi')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Transaksi</h1>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white divide-y divide-gray-200">
                    <thead>
                        <tr class="text-left text-gray-500 uppercase text-sm font-semibold">
                            <th class="px-6 py-3">Produk</th>
                            <th class="px-6 py-3">Harga</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($transactions as $transaction)
                            <tr class="text-gray-700">
                                <td class="px-6 py-4">
                                    {{ $transaction->product ? $transaction->product->name : 'Produk Tidak Ditemukan' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->product ? 'Rp' . number_format($transaction->product->price, 0, ',', '.') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->status == 'pending')
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    @elseif ($transaction->status == 'success')
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-800 bg-red-100 rounded-full">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $transaction->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    @if ($transaction->status == 'pending')
                                        <form action="{{ route('checkout-process') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $transaction->id }}">
                                            <input type="hidden" name="product_ids[]"
                                                value="{{ $transaction->produk_id }}">
                                            <input type="hidden" name="quantities[]" value="{{ $transaction->quantity }}">
                                            {{-- <button type="submit"
                                                class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                                id="pay-button">
                                                Bayar
                                            </button> --}}
                                        </form>
                                        <button type="submit"
                                            class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                            id="pay-button">
                                            Bayar
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Tempat untuk menampilkan hasil dari Midtrans -->
                <pre id="result-json" class="mt-4 text-sm text-gray-700"></pre>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            var snapToken = '{{ $transaction->snap_token }}';
            if (snapToken) {
                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        window.location.href = '{{ route('checkout-success', $transaction->id) }}';
                    },
                    onPending: function(result) {
                        document.getElementById('result-json').innerHTML = JSON.stringify(result, null, 2);
                    },
                    onError: function(result) {
                        document.getElementById('result-json').innerHTML = JSON.stringify(result, null, 2);
                    }
                });
            } else {
                console.error('Snap Token tidak ditemukan');
            }
        };
    </script>
@endsection
