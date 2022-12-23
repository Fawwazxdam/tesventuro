<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('laporan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // MENU
        $tahun = $request->tahun;
        $url = "http://tes-web.landa.id/intermediate/menu";
        $content = file_get_contents($url);
        $data = json_decode($content);

        // TRANSAKSI
        $url2 = "http://tes-web.landa.id/intermediate/transaksi?tahun=" . $tahun;
        $content2 = file_get_contents($url2);
        $data2 = json_decode($content2);
        $t = 0;

        // PER MENU PER BULAN
        foreach ($data as $menu) {
            $menu->menu;
            for ($i = 1; $i <= 12; $i++) {
                $hasil[$menu->menu][$i] = 0;
            }
        }
        foreach ($data2 as $tanggal) {
            // $tanggal->tanggal;
            $bulan = date('n', strtotime($tanggal->tanggal));
            $hasil[$tanggal->menu][$bulan] += $tanggal->total;
        }
        
        // PER KATEGORI PER BULAN
        foreach ($data as $kategori1) {
            foreach ($data2 as $kategori2) {
                if ($kategori1->kategori == 'makanan') {
                        for ($i = 1; $i <= 12; $i++) {
                            $hkategf[$i] = 0;
                    }
                } elseif ($kategori1->kategori == 'minuman') {
                        for ($i = 1; $i <= 12; $i++) {
                            $hkategd[$i] = 0;
                        }
                }
            }
        }
        foreach ($data2 as $kategori2) {
            foreach ($data as $kategori1) {
                if ($kategori1->kategori == 'makanan') {
                    if ($kategori1->menu == $kategori2->menu) {
                        $bulann = date('n', strtotime($kategori2->tanggal));
                        $hkategf[$bulann] += $kategori2->total;
                    }
                } elseif ($kategori1->kategori == 'minuman') {
                    if ($kategori1->menu == $kategori2->menu) {
                        $bulann = date('n', strtotime($kategori2->tanggal));
                        $hkategd[$bulann] += $kategori2->total;
                    }
                }
            }
        }

        // TOTAL PER KATEGORI
        $tfood = 0;
        $tdrink = 0;
        foreach ($data as $tkategori1) {
            foreach ($data2 as $tkategori2) {
                if ($tkategori1->menu == $tkategori2->menu) {
                    if ($tkategori1->kategori == 'makanan') {
                        $tfood += $tkategori2->total;
                    }
                }
            }
        }
        foreach ($data as $tkategori4) {
            foreach ($data2 as $tkategori3) {
                if ($tkategori4->menu == $tkategori3->menu) {
                    if ($tkategori4->kategori == 'minuman') {
                        $tdrink += $tkategori3->total;
                    }
                }
            }
        }

        // PER MENU
        foreach ($data as $permenu) {
            $jumlah[$permenu->menu] = 0;
        }
        foreach ($data2 as $permenuu) {
            $jumlah[$permenuu->menu] += $permenuu->total;
        }

        // PERBULAN
        foreach ($data2 as $perbulaan) {
            for ($i = 1; $i <= 12; $i++) {
                $ttlbulan[$i] = 0;
            }
        }
        foreach ($data2 as $perbulan) {
            $day = date('n', strtotime($perbulan->tanggal));
            $ttlbulan[$day] += $perbulan->total;
        }

        // TOTAAL
        foreach ($data2 as $total) {
            $t += $total->total;
        }
        // $toot = array_sum($hasil);
        // dd($hasil);

        // echo $a;
        // echo $data2->menu;

        return view('laporan', compact('data', 'data2','tahun', 'hasil', 'jumlah', 'ttlbulan', 't','hkategf','hkategd','tfood','tdrink'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
