@extends('layouts.LandingApp')

@section('title', 'Checkout')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
            <div class="text-center">
                @if ($product)
                    <p class="text-lg mb-4">
                        Anda akan melakukan pembelian produk <strong>{{ $product->name }}</strong> dengan harga
                        <strong>Rp{{ number_format($product->price, 0, ',', '.') }}</strong>
                    </p>
                    <p class="text-lg mb-4">
                        Jumlah: <strong>{{ $transaction->quantity }}</strong>
                    </p>
                    <p class="text-lg mb-6">
                        Total: <strong>Rp{{ number_format($totalPrice, 0, ',', '.') }}</strong>
                    </p>
                @else
                    <p class="text-lg text-red-500 mb-6">Produk tidak ditemukan.</p>
                @endif

                <button type="button"
                    class="mt-3 w-full bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    id="pay-button">
                    Bayar Sekarang
                </button>

                <!-- Tempat untuk menampilkan hasil dari Midtrans -->
                {{-- <pre id="result-json" class="mt-4 text-sm text-gray-700"></pre> --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            var snapToken = '{{ $transaction->snap_token ?? '' }}'; // Use null coalescing to avoid undefined error
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
                alert('Snap Token tidak ditemukan. Silakan coba lagi atau hubungi dukungan.');
                console.error('Snap Token tidak ditemukan');
            }
        };
    </script>
@endsection
