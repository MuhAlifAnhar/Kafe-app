@extends('backend.template.main')

@section('title', 'Bahan Baku Masuk')

@section('content')

    {{-- table --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb pb-5">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a href="{{ route('panel.dashboard.index') }}">
                        <i class="fa fa-home text-dark opacity-5" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                        href="{{ route('panel.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm text-dark active pb-3" aria-current="page">Bahan Baku Masuk</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white text-capitalize ps-3">Daftar Bahan Baku Masuk</h6>
                                <a href="{{ route('panel.incoming-raw-material.create') }}"
                                    class="btn btn-sm btn-primary me-3"><i class="fas fa-plus me-1"></i> Tambah</a>
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
                                        {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category</th> --}}
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Waktu Pembalian</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Unit</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($incomingRawMaterials as $materiall)
                                        <tr>
                                            <td class="text-center">
                                                {{ ($incomingRawMaterials->currentPage() - 1) * $incomingRawMaterials->perPage() + $loop->iteration }}
                                            </td>
                                            <td class="text-center">{{ $materiall->material->name }}</td>
                                            <td class="text-center">{{ $materiall->tanggal_pembelian }}</td>
                                            {{-- <td class="text-center">{{ $material->stock }}</td> --}}
                                            <td class="text-center">{{ $materiall->unit }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('panel.incoming-raw-material.edit', $materiall->uuid) }}"
                                                        class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <button class="btn btn-danger" onclick="deleteIncomingRawMaterial(this)"
                                                        data-uuid="{{ $materiall->uuid }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Data Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- pagination --}}
                            <div class="mt-3 justify-content-center" style="margin-left: 20px; margin-right: 20px;">
                                {{ $incomingRawMaterials->links('pagination::bootstrap-5') }}
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
            const deleteIncomingRawMaterial = (e) => {
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
                            url: `/panel/incoming-raw-material/${uuid}`,
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
