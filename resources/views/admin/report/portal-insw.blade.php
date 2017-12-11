@extends('dashboard.layouts.base')

@section('content')
    <div class="row">
        <section class="content col-sm-12">
            <div class="content__inner">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Portal INSW</h2>
                        <small class="card-subtitle">List SATS-LN/Permohonan Terbit</small>
                    </div>

                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover table-striped">
                                <thead align="center">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Permohonan</th>
                                    <th>Masa Berlaku</th>
                                    <th>Penerima</th>
                                    <th>Periode</th>
                                    <th>Pelabuhan Ekspor</th>
                                    <th>Pelabuhan Tujuan</th>
                                    <th>Jenis Permohonan</th>
                                    <th>Jumlah Spesies</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($tradePermit as $tradePermits)
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td align="center">{{ $tradePermits->trade_permit_code }}</td>
                                        <td align="center"><small>{{ date('l, d F Y', strtotime($tradePermits->valid_until)) }}</small></td>
                                        <td align="center">{{ $tradePermits->consignee }}</td>
                                        <td align="center">{{ $tradePermits->period }}</td>
                                        <td align="center">{{ $tradePermits->portExpor->port_name }}</td>
                                        <td align="center">{{ $tradePermits->portDest->port_name }}</td>
                                        <td align="center">{{ $tradePermits->purposeType->purpose_type_name }}</td>
                                        <td align="center">{{ $tradePermits->tradeSpecies->count() }}</td>
                                        <td align="center">
                                            <a class="btn btn-success btn-sm" href="{{ route('admin.report.sendInsw', ['tradePermitId' => $tradePermits->id]) }}" target="_blank"><i class="zmdi zmdi-mail-send"></i> Kirim</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">Tidak ada data SATS-LN/Permohonan</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('body.script')

@endpush
