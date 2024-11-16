@extends('backend.template.main')

@section('title', 'Products')

@section('content')
    {{-- table --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white text-capitalize ps-3">Product List</h6>
                                <a href="{{ route('panel.product.create') }}" class="btn btn-sm btn-primary me-3"><i
                                        class="fas fa-plus me-1"></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    @session('success')
                        <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endsession
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            style="width: 50px;">No</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Stock</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Image
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td class="text-center">
                                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                            </td>
                                            <td class="text-center">{{ $product->name }}</td>
                                            <td class="text-center">{{ $product->description }}</td>
                                            <td class="text-center">{{ $product->price }}</td>
                                            <td class="text-center">{{ $product->stock }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}" width="50">
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('panel.product.edit', $product->uuid) }}"
                                                        class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger" onclick="deleteProduct(this)"
                                                        data-uuid="{{ $product->uuid }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Data Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- pagination --}}
                            <div class="mt-3 justify-content-center" style="margin-left: 20px; margin-right: 20px;">
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const deleteProduct = (e) => {
                let uuid = e.getAttribute('data-uuid')
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: `/panel/product/${uuid}`,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: data.message,
                                    icon: "success",
                                    timer: 2500,
                                    showConfirmButton: false
                                });
                                window.location.reload();
                            },
                            error: function(data) {
                                Swal.fire({
                                    title: "Failed!",
                                    text: "Your data has not been deleted.",
                                    icon: "error"
                                });
                                console.log(data);
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
