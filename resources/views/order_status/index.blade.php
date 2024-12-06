@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Order Status</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Status Pesanan</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title mb-0">Status Pesanan</h4>
                                @if (session('success'))
                                    <div class="alert alert-success ms-auto" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger ms-auto" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                {{-- Ganti tombol sesuai kebutuhan --}}
                                {{-- <a class="btn btn-outline-danger ms-auto" href="{{ route('order_status.exportPDF') }}">
                                <i class="far fa-file-pdf"></i> Export PDF
                            </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>User</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Pengiriman</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>User</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Pengiriman</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->user ? $transaction->user->name : 'Unknown' }}</td>
                                                <td>{{ $transaction->product ? $transaction->product->name : 'Unknown' }}
                                                </td>
                                                <td>{{ 'Rp' . number_format($transaction->price, 0, ',', '.') }}</td>
                                                <td>{{ $transaction->quantity }}</td>
                                                <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                                <td>
                                                    @if ($transaction->status == 'pending')
                                                        <span
                                                            class="badge bg-warning text-white">{{ ucfirst($transaction->status) }}</span>
                                                    @elseif ($transaction->status == 'completed')
                                                        <span
                                                            class="badge bg-danger">{{ ucfirst($transaction->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-success">{{ ucfirst($transaction->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('order_status.create', $transaction->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <select name="status_pesanan" class="form-select"
                                                            onchange="this.form.submit()">
                                                            <option value="not_shipped"
                                                                {{ isset($transaction->orderStatus) && $transaction->orderStatus->status_pesanan == 'not_shipped' ? 'selected' : '' }}>
                                                                Not Shipped</option>
                                                            <option value="shipped"
                                                                {{ isset($transaction->orderStatus) && $transaction->orderStatus->status_pesanan == 'shipped' ? 'selected' : '' }}>
                                                                Shipped</option>
                                                        </select>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada status pesanan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
