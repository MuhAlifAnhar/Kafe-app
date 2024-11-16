@extends('backend.template.main')

@section('title', 'Edit Bahan Baku Masuk')

@section('content')
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
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                        href="{{ route('panel.raw-material.index') }}">Bahan Baku Masuk</a></li>
                <li class="breadcrumb-item text-sm text-dark active pb-3" aria-current="page">Edit Bahan Baku Masuk</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white text-capitalize ps-3">Edit Bahan Baku Masuk</h6>
                            </div>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body px-0 pb-2">
                        <form action="{{ route('panel.incoming-raw-material.update', $incomingRawMaterial->uuid) }}"
                            method="post" class="p-3">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="material_id" class="form-label">Bahan Baku</label>
                                        <select name="material_id" id="material_id"
                                            class="form-select border ps-2 pe-4 @error('material_id') is-invalid @enderror">
                                            <option value="" disabled selected> == Choose Bahan Baku ==</option>
                                            @foreach ($materials as $material)
                                                <option value="{{ $material->id }}"
                                                    {{ $material->id == $incomingRawMaterial->material_id ? 'selected' : '' }}>
                                                    {{ $material->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('material_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                                        <input type="date"
                                            class="form-control border px-3 @error('tanggal_pembelian') is-invalid @enderror"
                                            value="{{ old('tanggal_pembelian', $incomingRawMaterial->tanggal_pembelian) }}"
                                            name="tanggal_pembelian" id="tanggal_pembelian"
                                            placeholder="Masukkan tanggal pembelian">

                                        @error('tanggal_pembelian')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="form-select border ps-2 pe-4 @error('category_id') is-invalid @enderror">
                                            <option value="" disabled selected> == Choose Category ==</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="unit" class="form-label">Unit</label>
                                        <input type="text"
                                            class="form-control border px-3 @error('unit') is-invalid @enderror"
                                            value="{{ old('unit', $incomingRawMaterial->unit) }}" name="unit"
                                            id="unit">

                                        @error('unit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number"
                                            class="form-control border px-3 @error('stock') is-invalid @enderror"
                                            value="{{ old('stock') }}" name="stock" id="stock"
                                            placeholder="Enter stock">

                                        @error('stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="unit" class="form-label">Unit</label>
                                        <input type="text"
                                            class="form-control border px-3 @error('unit') is-invalid @enderror"
                                            value="{{ old('unit') }}" name="unit" id="unit"
                                            placeholder="Enter unit">

                                        @error('unit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                            </div>

                            <div class="float-end">
                                <a href="{{ route('panel.incoming-raw-material.index') }}"
                                    class="btn btn-secondary me-2">Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
