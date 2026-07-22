@extends('layouts.admin')

@section('title', 'Kelola Jadwal Kegiatan - Paskibra')

@section('content')
    <div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Jadwal Kegiatan</h3>
            <p class="text-muted" style="font-size: 0.95rem;">Kelola kalender dan jadwal kegiatan Paskibra.</p>
        </div>
        <button type="button" class="btn btn-primary shadow-sm px-4" data-toggle="modal" data-target="#addJadwalModal"
            style="border-radius: 10px; font-weight: 600;">
            <i class="fas fa-plus mr-2"></i> Tambah Jadwal
        </button>
    </div>



    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
            style="border-radius: 0.5rem;">
            <i class="fas fa-exclamation-triangle mr-2"></i> <strong>Gagal menyimpan jadwal!</strong>
            <ul class="mb-0 mt-1 pl-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-top-0 border-bottom-0 text-muted px-4"
                                style="font-size: 0.85rem; font-weight: 600; width: 5%;">NO</th>
                            <th class="border-top-0 border-bottom-0 text-muted"
                                style="font-size: 0.85rem; font-weight: 600; width: 35%;">NAMA KEGIATAN</th>
                            <th class="border-top-0 border-bottom-0 text-muted"
                                style="font-size: 0.85rem; font-weight: 600; width: 20%;">TANGGAL & WAKTU</th>
                            <th class="border-top-0 border-bottom-0 text-muted"
                                style="font-size: 0.85rem; font-weight: 600; width: 25%;">TEMPAT</th>
                            <th class="border-top-0 border-bottom-0 text-muted text-center"
                                style="font-size: 0.85rem; font-weight: 600; width: 15%;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $index => $jadwal)
                            <tr>
                                <td class="px-4 text-muted font-weight-bold">{{ $jadwals->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center py-2">
                                        <div class="rounded-circle mr-3 bg-primary-soft d-flex align-items-center justify-content-center text-primary"
                                            style="width: 45px; height: 45px; background-color: #e0e7ff;">
                                            <i class="fas fa-calendar-day"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold text-dark">{{ $jadwal->nama_kegiatan }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark font-weight-bold" style="font-size: 0.95rem;">
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->translatedFormat('l, d M Y') }}
                                    </div>
                                    <small class="text-muted"><i class="far fa-clock mr-1"></i>
                                        {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</small>
                                </td>
                                <td>
                                    <div class="text-muted"><i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                        {{ Str::limit($jadwal->tempat, 40) }}</div>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-light text-primary mr-1" data-toggle="modal"
                                        data-target="#editJadwalModal{{ $jadwal->id }}" title="Edit"
                                        style="border-radius: 8px;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" data-toggle="tooltip"
                                            title="Hapus" style="border-radius: 8px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit Jadwal -->
                            <div class="modal fade" id="editJadwalModal{{ $jadwal->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                                        <div class="modal-header bg-light border-0 py-3" style="border-radius: 1rem 1rem 0 0;">
                                            <h5 class="modal-title font-weight-bold text-dark">Edit Jadwal Kegiatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body px-4 py-4 text-left">
                                                <div class="form-group mb-4">
                                                    <label class="font-weight-600 text-muted small text-uppercase">Nama Kegiatan
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="nama_kegiatan" class="form-control"
                                                        value="{{ $jadwal->nama_kegiatan }}" required
                                                        style="border-radius: 0.5rem;" placeholder="Misal: Latihan Rutin PBB">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label
                                                                class="font-weight-600 text-muted small text-uppercase">Tanggal
                                                                <span class="text-danger">*</span></label>
                                                            <input type="date" name="tanggal_kegiatan" class="form-control"
                                                                value="{{ $jadwal->tanggal_kegiatan }}" required
                                                                style="border-radius: 0.5rem;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label class="font-weight-600 text-muted small text-uppercase">Waktu
                                                                <span class="text-danger">*</span></label>
                                                            <input type="time" name="waktu" class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}"
                                                                required style="border-radius: 0.5rem;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-0">
                                                    <label class="font-weight-600 text-muted small text-uppercase">Tempat
                                                        Pelaksanaan <span class="text-danger">*</span></label>
                                                    <input type="text" name="tempat" class="form-control"
                                                        value="{{ $jadwal->tempat }}" required style="border-radius: 0.5rem;"
                                                        placeholder="Misal: Lapangan Utama SMA">
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 bg-light py-3"
                                                style="border-radius: 0 0 1rem 1rem;">
                                                <button type="button" class="btn btn-secondary font-weight-bold px-4"
                                                    data-dismiss="modal" style="border-radius: 0.5rem;">Batal</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold px-4"
                                                    style="border-radius: 0.5rem;"><i class="fas fa-save mr-2"></i> Simpan
                                                    Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted mb-3"><i class="far fa-calendar-times fa-3x"
                                            style="opacity: 0.4;"></i></div>
                                    <h6 class="font-weight-bold text-dark">Belum ada jadwal kegiatan</h6>
                                    <p class="text-muted mb-3">Jadwalkan kegiatan pertama Paskibra sekarang.</p>
                                    <button type="button" class="btn btn-sm btn-primary px-4" data-toggle="modal"
                                        data-target="#addJadwalModal" style="border-radius: 8px;"><i
                                            class="fas fa-plus mr-2"></i>Tambah Jadwal</button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($jadwals->hasPages())
        <div class="d-flex justify-content-center">
            {{ $jadwals->links() }}
        </div>
    @endif

    <!-- Modal Tambah Jadwal -->
    <div class="modal fade" id="addJadwalModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                <div class="modal-header bg-light border-0 py-3" style="border-radius: 1rem 1rem 0 0;">
                    <h5 class="modal-title font-weight-bold text-dark">Tambah Jadwal Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jadwal.store') }}" method="POST">
                    @csrf
                    <div class="modal-body px-4 py-4">
                        <div class="form-group mb-4">
                            <label class="font-weight-600 text-muted small text-uppercase">Nama Kegiatan <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="nama_kegiatan" class="form-control" required
                                style="border-radius: 0.5rem;" placeholder="Misal: Latihan Rutin PBB">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="font-weight-600 text-muted small text-uppercase">Tanggal <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_kegiatan" class="form-control" required
                                        style="border-radius: 0.5rem;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="font-weight-600 text-muted small text-uppercase">Waktu <span
                                            class="text-danger">*</span></label>
                                    <input type="time" name="waktu" class="form-control" required
                                        style="border-radius: 0.5rem;">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label class="font-weight-600 text-muted small text-uppercase">Tempat Pelaksanaan <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="tempat" class="form-control" required style="border-radius: 0.5rem;"
                                placeholder="Misal: Lapangan Utama SMA">
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light py-3" style="border-radius: 0 0 1rem 1rem;">
                        <button type="button" class="btn btn-secondary font-weight-bold px-4" data-dismiss="modal"
                            style="border-radius: 0.5rem;">Batal</button>
                        <button type="submit" class="btn btn-primary font-weight-bold px-4"
                            style="border-radius: 0.5rem;"><i class="fas fa-save mr-2"></i> Simpan Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    @endpush
@endsection