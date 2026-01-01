@extends('layouts.user.app') {{-- Gunakan layout landing page --}}

@section('title', 'Detail Produk - ' . $product->nama)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $product->foto) }}" class="img-fluid rounded"
                        alt="{{ $product->nama }}">
                </div>
            </div>

            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">{{ $product->nama }}</li>
                    </ol>
                </nav>

                <h2 class="fw-bold mb-3">{{ $product->nama }}</h2>
                <h3 class="text-primary mb-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</h3>

                <div class="mb-4">
                    <h5 class="fw-bold">Deskripsi:</h5>
                    <p class="text-muted">{{ $product->deskripsi }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold">Stok Tersedia:</h5>
                    <span class="badge {{ $product->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                        {{ $product->stok }} unit
                    </span>
                </div>

                {{-- Tombol Transaksi Modul 11 --}}
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="btn btn-primary btn-lg px-4 me-md-2 {{ $product->stok <= 0 ? 'disabled' : '' }}">
                            <i class="bx bx-cart-add"></i> Tambah ke Keranjang
                        </button>
                    </form>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg px-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
