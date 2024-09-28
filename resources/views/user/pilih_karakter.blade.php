@extends('user.layouts.app')

@section('title', 'Pilih Karakter - Cokelat Cantique')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/pilih_karakter.css') }}">
@endpush

@section('content')
   <!-- MAIN -->
    @if(Auth::check())
        <meta name="kustomisasi-cokelat-url" content="{{ route('user.kustomisasi_cokelat') }}">
        <meta name="total-karakter" content="{{ session()->get('total_karakter', 0) }}">
        <meta name="selected-karakter" content="{{ json_encode(session()->get('selected_karakter', [])) }}">
        <section class="main-content">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-12">
                        <a href="javascript:history.back()" class="btn button-back"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 header">
                        <h2>Pilih Karakter</h2>
                        <p>Pilihlah karakter sesuai dengan jenis cokelat yang dipilih dan sampai proggress bar 100%</p>
                    </div>
                </div>
                <div class="row mt-3 d-flex">
                    @php
                        $kategoriLabels = [
                            'huruf' => 'Huruf',
                            'kartun' => 'Kartun',
                            'makanan' => 'Makanan',
                            'hari raya' => 'Hari Raya',
                            'orang' => 'Orang',
                        ];

                        $selectedKategori = request('kategori');
                        $selectedLabel = $selectedKategori ? $kategoriLabels[$selectedKategori] ?? 'All' : 'All';
                        $totalKarakter = session()->get('total_karakter', 0); // Total karakter dari sesi
                        $selectedKarakter = session()->get('selected_karakter', []);
                        $selectedJumlah = array_sum(array_column($selectedKarakter, 'jumlah')); // Jumlah karakter yang sudah dipilih
                        $progress = $totalKarakter > 0 ? ($selectedJumlah / $totalKarakter) * 100 : 0; // Menghitung persentase progress
                    @endphp
                    <div class="col-md-8">
                        <div class="produk-filter">
                            <div class="dropdown">
                                <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $selectedLabel }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('user.pilih_karakter') }}">All</a></li>
                                    @foreach($kategoriLabels as $key => $label)
                                        <li><a class="dropdown-item" href="{{ route('user.pilih_karakter', ['kategori' => $key]) }}">{{ $label }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="progress-container mt-3">
                            <div class="progress" role="progressbar" aria-label="Example with label 40px high" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" id="progress-bar" style="width: {{ $progress }}%">{{ number_format($progress, 0) }}%</div>
                            </div>
                        </div>
                        <div class="row mt-3 produk d-flex justify-content-between">
                            @foreach ($karakterCokelat as $cokelat)
                                @php
                                    $isDisabled = $progress >= 100 ? 'disabled' : '';
                                @endphp
                                <div class="col-md-3 produk-card">
                                    <div class="card">
                                        <img src="{{ asset($cokelat->foto)}}" class="card-img-top" alt="{{ $cokelat->nama }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $cokelat->nama }}</h5>
                                            @php
                                                $kategoriLabels = [
                                                    'huruf' => 'Huruf',
                                                    'kartun' => 'Kartun',
                                                    'makanan' => 'Makanan',
                                                    'hari raya' => 'Hari Raya',
                                                    'orang' => 'Orang',
                                                ];
                                                $namaKategori = $kategoriLabels[$cokelat->kategori] ?? 'Kategori Tidak Dikenal';
                                            @endphp
                                            <p class="card-text">{{ $namaKategori }}</p>
                                            <a class="btn button-pilih {{ $isDisabled }}" href="#" role="button" data-id="{{ $cokelat->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" {{ $isDisabled ? 'disabled' : '' }}>Pilih Karakter</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="rekap-pilihan">
                            <h5>Pilihan Anda</h5>
                            <div class="jenis-pilihan">
                                @if($selectedCokelat)
                                    <p class="text">{{ $selectedCokelat->nama }}</p>
                                    <p class="harga">{{ 'Rp ' . number_format($selectedCokelat->harga, 0, ',', '.') }}</p>
                                @else
                                    <p class="text">Tidak ada jenis cokelat yang dipilih.</p>
                                @endif
                            </div>
                            <div class="karakter-pilihan">
                                @if(session()->has('selected_karakter'))
                                    @php
                                        $selectedKarakter = session('selected_karakter');
                                    @endphp
                                    @foreach($selectedKarakter as $karakterId => $detail)
                                        @php
                                            $karakter = \App\Models\KarakterCokelat::find($karakterId);
                                            $namaKarakter = $karakter ? $karakter->nama : 'Karakter Tidak Dikenal';
                                        @endphp
                                        <div class="text-jumlah d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="text">{{ $namaKarakter }}</p>
                                                <p class="jumlah">{{ $detail['jumlah'] }}</p>
                                            </div>
                                            <form action="{{ route('user.hapus_karakter', $karakterId) }}" method="POST" class="ms-2 delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm  btn-delete" title="Hapus" data-id="{{ $karakterId }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <p class="catatan">{{ $detail['catatan'] }}</p>
                                    @endforeach
                                @else
                                    <p class="text">Tidak ada karakter yang dipilih.</p>
                                @endif
                            </div>
                            <div class="total-harga">
                                <p>Total</p>
                                <p class="harga"> 
                                    @if($selectedCokelat)
                                        {{ 'Rp ' . number_format($selectedCokelat->harga, 0, ',', '.') }}
                                    @else
                                        Rp 0
                                    @endif
                                </p>
                            </div>
                            <div class="button d-flex justify-content-between">
                                <form action="{{ route('user.add_to_cart') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn button-keranjang {{ $isDisabled }}" role="button" {{ $isDisabled ? 'disabled' : '' }}>Keranjang</button>
                                </form>
                                <form action="{{ route('user.process_order') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn button-pesan {{ $isDisabled }}" data-id="{{ $cokelat->id }}" {{ $isDisabled ? 'disabled' : '' }}>Pesan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Catatan Karakter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-start mb-3">
                            <img src="{{ asset($cokelat->foto)}}" alt="{{ $cokelat->nama }}" id="modal-foto" class="img-fluid">
                            <div class="ms-3">
                                <h5 class="modal-nama" id="modal-nama">{{ $cokelat->nama }}</h5>
                                <div class="wrapper quantity mb-3">
                                    <span class="minus">-</span>
                                    <span class="num">1</span>
                                    <span class="plus">+</span>
                                </div>
                            </div>
                        </div>
                        <form>
                            <div class="mb-3 catatan">
                                <label for="deskripsi" class="form-label catatan-title">Catatan Kustomisasi</label>
                                <p class="note">Masukkan catatan kustomisasi seperti warna, tulisan, dan yang lainnya sesuai dengan keinginan.</p>
                                <p class="note mt-0">Contoh: Saya ingin karakter pororo saja, Saya ingin warna karakternya biru, dll.</p>
                                <textarea class="form-control" id="deskripsi" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-simpan">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <script>
            window.location.href = "{{ route('user.login') }}";
        </script>
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/user/popup_karakter.js')}}"></script>
    <script src="{{ asset('js/user/pilih_karakter.js')}}"></script>
@endpush