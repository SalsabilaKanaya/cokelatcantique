@extends('user.layouts.app')

@section('title', 'Edit Alamat - Cokelat Cantique')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/edit_alamat.css')}}">
@endpush

@section('content')

    <!--Main Content-->
    <section class="main-content">
        <div class="content">
            <h1>Edit Alamat Saya</h1>
            <div class="profile">
                <form action="{{ route('user.address_update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->userAddress->name ?? '' }}" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="col">
                            <label for="phone" class="form-label">No Hp</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->userAddress->phone ?? '' }}" placeholder="08xxxxxx">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="province" class="form-label">Province</label>
                            <select class="form-control" name="province_id" id="province" required>
                                <option value="">Pilih Province</option>
                                <!-- Provinsi akan dimuat dengan JavaScript -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="city" class="form-label">City</label>
                            <select class="form-control" name="city_id" id="city" required>
                                <option value="">Pilih City</option>
                                <!-- Kota akan dimuat dengan JavaScript -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <p class="address-note">Masukkan nama jalan, gedung, no rumah dengan lengkap</p>
                            <textarea class="form-control" name="address" id="address" placeholder="Masukkan alamat lengkap" required>{{ $user->userAddress->address ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="javascript:history.back()" type="button" class="btn btn-danger" id="cancelButton">Cancel</a>
                        <button type="submit" class="btn btn-submit" id="updateButton">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
@endsection

@push('scripts')
    <script src="{{ asset('js/user/profil.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('updateButton').addEventListener('click', function() {
                event.preventDefault(); // Mencegah pengiriman form secara default
                Swal.fire({
                    title: 'Apakah data sudah benar?',
                    text: "Pastikan semua data sudah benar sebelum melanjutkan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, sudah benar!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Mengirim form setelah konfirmasi
                        this.closest('form').submit(); // Menggunakan this untuk mengirim form yang sesuai
                    }
                });
            });
        });
    </script>
@endpush