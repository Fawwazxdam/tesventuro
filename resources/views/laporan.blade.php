<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Venturo - Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        {{-- <h1>Hello, world!</h1> --}}

        <div class="card mt-3">
            <div class="card-header">
                Venturo - Laporan Penjulan Tahunan per Menu.
            </div>
            <div class="card-body">
                <form action="{{ route('laporan.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-2">
                            <select name="tahun" id="" class="form-select">
                                <option value="" selected disabled>Pilih Tahun</option>
                                <option value="2021"@isset($tahun){{ $tahun == 2021? 'selected' : '' }}@endisset>2021</option>
                                <option value="2022"@isset($tahun){{ $tahun == 2022? 'selected' : '' }}@endisset>2022</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- @if (isset($data) && isset($data2)) --}}


            @isset($data)
            <div class="table-responsive mt-5">
                <table class="table table-hover table-bordered" style="margin: 0; font-size: 12px">
                    <thead>
                        <tr class="table-dark">
                            <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                            <th colspan="12" style="text-align: center;">Periode Pada {{$tahun}}
                            </th>
                            <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                        </tr>
                        <tr class="table-dark">
                            <th style="text-align: center;width: 75px;">Jan</th>
                            <th style="text-align: center;width: 75px;">Feb</th>
                            <th style="text-align: center;width: 75px;">Mar</th>
                            <th style="text-align: center;width: 75px;">Apr</th>
                            <th style="text-align: center;width: 75px;">Mei</th>
                            <th style="text-align: center;width: 75px;">Jun</th>
                            <th style="text-align: center;width: 75px;">Jul</th>
                            <th style="text-align: center;width: 75px;">Ags</th>
                            <th style="text-align: center;width: 75px;">Sep</th>
                            <th style="text-align: center;width: 75px;">Okt</th>
                            <th style="text-align: center;width: 75px;">Nov</th>
                            <th style="text-align: center;width: 75px;">Des</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-secondary"><b>Makanan</b></td>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <td class="table-secondary"><b>{{ $hkategf[$i] }}</b></td>
                                    @endfor
                                    <td class="table-secondary"><b>{{$tfood}}</b></td>
                                </tr>
                                @foreach ($data as $isi)
                            <tr>
                                @if ($isi->kategori == 'makanan')
                                    <td>{{ $isi->menu }}</td>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <td>{{ $hasil[$isi->menu][$i] }}</td>
                                    @endfor
                                    <td>{{ $jumlah[$isi->menu] }}</td>
                                    @endif
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="table-secondary"><b>Minuman</b></td>
                                    @for ($i = 1; $i <= 12; $i++)
                                    <td class="table-secondary"><b>{{ $hkategd[$i] }}</b></td>
                                    @endfor
                                    <td class="table-secondary"><b>{{$tdrink}}</b></td>
                                </tr>
                        @foreach ($data as $isi)
                            <tr>
                                @if ($isi->kategori == 'minuman')
                                    <td>{{ $isi->menu }}</td>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <td>{{ $hasil[$isi->menu][$i] }}</td>
                                    @endfor
                                    <td>{{ $jumlah[$isi->menu] }}</td>
                                @endif
                            </tr>
                        @endforeach
                        <tr class="table-dark">
                            <td><b>Total</b></td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td>{{ $ttlbulan[$i] }}</td>
                            @endfor
                            <td>{{ $t }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endisset
        {{-- @endif --}}
    </div>
    <footer class="text-center mt-5">
        <p><i> By Adam Fawwaz 2022 </i></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
