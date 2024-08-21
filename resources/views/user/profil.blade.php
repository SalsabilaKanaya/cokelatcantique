@extends('user.layouts.app')

@section('title', 'Jenis Cokelat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profil.css')}}">
@endpush

@section('content')
   <!--Main Content-->
    <section class="main-content">
        <div class="container">
            <h2>Profil Saya</h2>
            <!-- Tabs Navigation -->
            <ul class="nav nav-underline justify-content-center" id="profileTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Profil</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="alamat-tab" data-bs-toggle="tab" data-bs-target="#alamat" type="button" role="tab" aria-controls="alamat" aria-selected="false">Alamat</button>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="profileTabContent">
                <!-- Profil Tab -->
                <div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                    <div class="profile">
                        <div class="profile-details">
                            <div class="detail-item">
                                <p class="title">Nama</p>
                                <p>{{ $user->name ?? '-' }}</p>
                            </div>
                            <div class="detail-item">
                                <p class="title">No Hp</p>
                                <p>{{ $user->phone ?? '-' }}</p>
                            </div>
                            <div class="detail-item">
                                <p class="title">Email</p>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="detail-item">
                                <p class="title">Jenis Kelamin</p>
                                <p>{{ $user->gender ?? '-' }}</p>
                            </div>
                            <div class="detail-item">
                                <p class="title">Tanggal Lahir</p>
                                <p>{{ $user->datebirth ?? '-' }}</p>
                            </div>
                        </div>
                        <a href="{{ route('user.profil.edit') }}" class="btn btn-edit">Edit Profile</a>
                    </div>
                </div>

                <!-- Alamat Tab -->
                <div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                    <div class="alamat">
                        @if ($user->userAddress)
                            <div class="alamat-details">
                                <div class="detail-item">
                                    <p class="title">Nama</p>
                                    <p>{{ $user->userAddress->name }}</p>
                                </div>
                                <div class="detail-item">
                                    <p class="title">No Hp</p>
                                    <p>{{ $user->userAddress->phone }}</p>
                                </div>
                                <div class="detail-item">
                                    <p class="title">Province</p>
                                    <p>{{ $user->userAddress->province_name }}</p>
                                </div>
                                <div class="detail-item">
                                    <p class="title">City</p>
                                    <p>{{ $user->userAddress->city_name }}</p>
                                </div>                                                             
                                <div class="detail-item">
                                    <p class="title">Alamat Lengkap</p>
                                    <p>{{ $user->userAddress->address }}</p>
                                </div>
                            </div>
                        @else
                            <div class="no-address">
                                <img src="{{ asset('img/address.jpg') }}" alt="No address" class="no-address-img">
                                <p class="no-address-text">Alamat belum ada</p>
                            </div>
                        @endif
                        <a href="{{ route('user.address.editAddress') }}" class="btn btn-edit">Edit Alamat</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
