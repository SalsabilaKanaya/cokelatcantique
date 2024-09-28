@extends('user.layouts.app')

@section('title', 'Edit Profil - Cokelat Cantique')


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/edit_profil.css')}}">
@endpush

@section('content')

    <!--Main Content-->
    <section class="main-content">
        <div class="content">
            <h1>Update Profil Saya</h1>
            <div class="profile">
                <form action="{{ route('user.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="Masukkan Nama">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="phone" class="form-label">No Hp</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" placeholder="08xxxxxx">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="Masukkan Email" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="">Pilih Gender</option>
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="datebirth" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="datebirth" id="datebirth" value="{{ $user->datebirth }}" placeholder="Masukkan Tanggal Lahir" required>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('updateButton').addEventListener('click', function(event) {
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