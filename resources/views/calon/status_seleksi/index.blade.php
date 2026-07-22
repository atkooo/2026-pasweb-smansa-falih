@extends('layouts.admin')

@section('title', 'Status Seleksi - Paskibra')



@section('content')
<div class="mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Hasil Seleksi</h3>
    <p class="text-muted" style="font-size: 0.95rem;">Lihat hasil seleksi untuk setiap tahap yang telah Anda ikuti</p>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">HASIL SELEKSI</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="vertical-align: middle;">
                        <tbody>
                            @foreach($stages as $id => $stage)
                            <tr>
                                <td class="px-4 py-4 border-bottom-0 border-top" style="border-color: #f3f4f6 !important; width: 45%;">
                                    <h6 class="font-weight-bold text-dark mb-0" style="font-size: 0.95rem;">{{ $stage['title'] }}</h6>
                                </td>
                                <td class="px-4 py-4 text-muted border-bottom-0 border-top" style="border-color: #f3f4f6 !important; width: 25%;">
                                    {{ $stage['date'] }}
                                </td>
                                <td class="px-4 py-4 border-bottom-0 border-top text-center" style="border-color: #f3f4f6 !important; width: 15%;">
                                    @if($stage['status'] === 'LOLOS' || $stage['status'] === 'SELESAI' || $stage['status'] === 'LULUS')
                                        <span class="font-weight-bold text-success" style="font-size: 0.9rem;">LULUS</span>
                                    @elseif($stage['status'] === 'TIDAK LOLOS' || $stage['status'] === 'DITOLAK' || $stage['status'] === 'TIDAK_LULUS' || $stage['status'] === 'TIDAK LULUS')
                                        <span class="font-weight-bold text-danger" style="font-size: 0.9rem;">TIDAK LULUS</span>
                                    @elseif($stage['status'] === 'REVISI')
                                        <span class="font-weight-bold text-warning" style="font-size: 0.9rem;">{{ $stage['status'] }}</span>
                                    @elseif(isset($stage['score']) && $stage['score'] !== null)
                                        <span class="font-weight-bold" style="font-size: 0.9rem; color: #ea580c !important;">{{ $stage['score'] }}</span>
                                    @elseif(!$stage['is_scoring'] && !$stage['status'])
                                        <span class="font-weight-bold text-muted" style="font-size: 0.9rem;">Menunggu</span>
                                    @else
                                        <span class="font-weight-bold text-muted" style="font-size: 0.9rem;">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 border-bottom-0 border-top text-right" style="border-color: #f3f4f6 !important; width: 15%;">
                                    <a href="{{ route('status-seleksi.show', $id) }}" class="btn btn-primary btn-sm px-4 rounded-pill font-weight-bold shadow-sm" style="background-color: #3b82f6; border-color: #3b82f6;">Lihat</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
