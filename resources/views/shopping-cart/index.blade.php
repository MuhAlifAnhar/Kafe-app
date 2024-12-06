@extends('layouts.LandingApp')

@section('content')
    <section class="py-6">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="flex items-center justify-between py-4">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h3>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700 dark:bg-green-900 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-700 dark:bg-red-900 dark:text-red-300">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table id="cart-table" class="min-w-full divide-y divide-gray-200 bg-white shadow-md dark:bg-gray-800">
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($orders as $order)
                            @php
                                $product = App\Models\Backend\Product::find($order->produk_id);
                                $unitPrice = $product->price ?? 0;
                                $totalPrice = $unitPrice * $order->quantity;
                            @endphp
                            <tr data-product-id="{{ $product->id ?? '' }}" data-price="{{ $unitPrice }}"
                                class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $product->name ?? 'Product Not Found' }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    @if ($product && $product->image)
                                        <img src="{{ asset('images/' . $product->image) }}"
                                            class="w-20 h-20 object-cover rounded-lg" alt="{{ $product->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/100" class="w-20 h-20 object-cover rounded-lg"
                                            alt="No Image">
                                    @endif
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 unit-price">
                                    {{ number_format($unitPrice, 2) }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <form action="{{ route('shopping-cart.update-quantity', $order->id) }}" method="POST"
                                        class="flex items-center space-x-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $order->quantity }}" min="1"
                                            class="w-16 p-1.5 border rounded-md text-center text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600 quantity-input">
                                        <button type="submit"
                                            class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">Update</button>
                                    </form>
                                </td>
                                <td
                                    class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 total-price">
                                    {{ number_format($totalPrice, 2) }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap flex items-center space-x-2">
                                    <form action="{{ route('shopping-cart.remove', $order->produk_id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1.5 text-sm font-medium text-red-600 bg-transparent hover:underline dark:text-red-500">
                                            Remove
                                        </button>
                                    </form>
                                    <form action="{{ route('checkout-process') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_ids[]" value="{{ $order->produk_id }}">
                                        <input type="hidden" name="quantities[]" value="{{ $order->quantity }}">
                                        <button type="submit"
                                            class="px-3 py-1.5 text-sm font-medium text-white bg-primary-700 rounded-md hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Checkout</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-300">No
                                    items in your cart.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                // AJAX for updating quantity
                $('.quantity-form').on('submit', function(e) {
                    e.preventDefault();
                    var $form = $(this);
                    var $row = $form.closest('tr');
                    var productId = $row.data('product-id');
                    var quantity = $form.find('.quantity-input').val();
                    var price = $row.data('price');
                    var url = $form.attr('action');

                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: {
                            _token: $form.find('input[name="_token"]').val(),
                            quantity: quantity
                        },
                        success: function(response) {
                            var totalPrice = price * quantity;
                            $row.find('.total-price').text(totalPrice.toFixed(2));
                            updateTotalPrice();
                        },
                        error: function(xhr) {
                            console.error('Failed to update quantity.');
                        }
                    });
                });

                function updateTotalPrice() {
                    var total = 0;
                    $('#cart-table .total-price').each(function() {
                        total += parseFloat($(this).text()) || 0;
                    });
                    $('#total-price').text(total.toFixed(2));
                }
            });
        </script>
    @endpush
@endsection
