@extends('layouts.app')

@section('content')
    <div class="page-inner">
        <h3 class="fw-bold mb-3">Payment</h3>

        <div id="payment-container">
            <!-- Menampilkan tombol pembayaran Midtrans -->
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    var snapToken = "{{ $snapToken }}";
                    window.snap.pay(snapToken, {
                        onSuccess: function(result) {
                            console.log('Payment success:', result);
                            // Kirim data hasil pembayaran ke backend untuk verifikasi
                            window.location.href =
                                "{{ route('shopping-cart.process-payment', ['id' => $orderId]) }}?snap_token=" +
                                snapToken;
                        },
                        onPending: function(result) {
                            console.log('Payment pending:', result);
                            // Informasikan pengguna bahwa pembayaran masih pending
                            alert('Payment is pending, please wait.');
                        },
                        onError: function(result) {
                            console.log('Payment error:', result);
                            // Informasikan pengguna jika terjadi kesalahan
                            alert('Payment failed: ' + result.status_message);
                        }
                    });
                });
            </script>
        </div>
    </div>
@endsection
