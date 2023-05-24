@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
@if (Auth::user()->role == 'Admin' || Auth::user()->role == 'BK')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Grafik Pelanggaran Siswa Per Tahun Ajaran</h5>
                    </div>
                </div>
                <div id="chart2"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Pelanggaran Terakhir</h5>
                </div>
                <ul class="timeline-widget mb-0 position-relative mb-n5">
                    @forelse ($items as $item)
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">
                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d/m/Y') }}</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1">{{ $item->kelas_siswa->siswa->nama }}</div>
                    </li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Pelanggaran Terakhir</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Nama</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Kelas</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Pelanggaran</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Petugas</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $item->kelas_siswa->siswa->nama }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">{{ $item->kelas_siswa->kelas->jenjang }}
                                        {{ $item->kelas_siswa->kelas->kelas }}</h6>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0 fs-4">
                                        <button type="button" class="btn btn-primary rounded-3 btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $item->id }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-eye" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                    </path>
                                                </svg>
                                            </span>
                                        </button>
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">{{ $item->petugas->nama }}</h6>
                                </td>
                                <div class="modal fade" id="exampleModal2{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pelanggaran {{ $item->kelas_siswa->siswa->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Jenis Pelanggaran</h6>
                                                        <p>{{ $item->pelanggaran->pelanggaran }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Skor Pelanggaran</h6>
                                                        <p>{{ $item->pelanggaran->skor }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Pelanggaran Terakhir</h5>
                </div>
                @if ($items)
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nisn }}</td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-center">
                                    @if ($item->jenis_kelamin == 'L')
                                    <span class="badge bg-primary rounded-3 fw-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-man"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 16v5"></path>
                                            <path d="M14 16v5"></path>
                                            <path d="M9 9h6l-1 7h-4z"></path>
                                            <path d="M5 11c1.333 -1.333 2.667 -2 4 -2"></path>
                                            <path d="M19 11c-1.333 -1.333 -2.667 -2 -4 -2"></path>
                                            <path d="M12 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        </svg>
                                    </span>
                                    @else
                                    <span class="badge bg-warning rounded-3 fw-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-woman" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 16v5"></path>
                                            <path d="M14 16v5"></path>
                                            <path d="M8 16h8l-2 -7h-4z"></path>
                                            <path d="M5 11c1.667 -1.333 3.333 -2 5 -2"></path>
                                            <path d="M19 11c-1.667 -1.333 -3.333 -2 -5 -2"></path>
                                            <path d="M12 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        </svg>
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="7">-- Data Kosong --</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Daftar Pelanggaran</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Nama</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Pelanggaran</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Petugas</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items2 as $item)
                            <tr>
                                <td class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $item->kelas_siswa->siswa->nama }}</h6>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0 fs-4">
                                        <button type="button" class="btn btn-primary rounded-3 btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-eye" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                    </path>
                                                </svg>
                                            </span>
                                        </button>
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">{{ $item->petugas->nama }}</h6>
                                </td>
                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pelanggaran {{ $item->kelas_siswa->siswa->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Jenis Pelanggaran</h6>
                                                        <p>{{ $item->pelanggaran->pelanggaran }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Skor Pelanggaran</h6>
                                                        <p>{{ $item->pelanggaran->skor }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="7">-- Data Kosong --</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('addon-script')
<script>
    var chart2 = {
        series: [{
            name: "Jumlah Pelanggaran",
            data: [
                @forelse($tahunAjaran as $item)
                    {{ App\Helper\Helper::getPelanggaran($item->id) }},
                @empty

                @endforelse
            ]
        }, ],

        chart: {
            type: "bar",
            height: 345,
            offsetX: -15,
            toolbar: {
                show: true
            },
            foreColor: "#adb0bb",
            fontFamily: 'inherit',
            sparkline: {
                enabled: false
            },
        },


        colors: ["#5D87FF", "#49BEFF"],


        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "35%",
                borderRadius: [6],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
            },
        },
        markers: {
            size: 0
        },

        dataLabels: {
            enabled: false,
        },


        legend: {
            show: false,
        },


        grid: {
            borderColor: "rgba(0,0,0,0.1)",
            strokeDashArray: 3,
            xaxis: {
                lines: {
                    show: false,
                },
            },
        },

        xaxis: {
            type: "category",
            categories: [
                @forelse($tahunAjaran as $item)
                "{{ $item->tahun_ajaran }}",
                @empty

                @endforelse
            ],
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color"
                },
            },
        },


        yaxis: {
            show: true,
            min: 0,
            max: 10,
            tickAmount: 4,
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color",
                },
            },
        },
        stroke: {
            show: true,
            width: 3,
            lineCap: "butt",
            colors: ["transparent"],
        },


        tooltip: {
            theme: "light"
        },

        responsive: [{
            breakpoint: 600,
            options: {
                plotOptions: {
                    bar: {
                        borderRadius: 3,
                    }
                },
            }
        }]


    };

    var chart2 = new ApexCharts(document.querySelector("#chart2"), chart2);
    chart2.render();

</script>
@endpush
