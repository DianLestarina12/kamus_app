<?php

namespace Tests\Feature;

use App\Models\Katas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KuisTest extends TestCase
{
    use RefreshDatabase;

    private function isiKata(int $jumlah): void
    {
        $tingkatan = ['kruna_asi', 'kruna_aso', 'kruna_ami', 'kruna_mider', 'kruna_andap', 'kruna_kasar'];

        for ($i = 0; $i < $jumlah; $i++) {
            $kolom = $tingkatan[$i % count($tingkatan)];
            $data = array_fill_keys($tingkatan, '-');
            $data[$kolom] = "kata{$i}";
            $data['bahasa_indonesia'] = "arti{$i}";
            Katas::create($data);
        }
    }

    public function test_halaman_pembuka_tampil(): void
    {
        $this->get('/kuis')->assertOk()->assertSee('Kuis Evaluasi');
    }

    public function test_tanpa_data_kata_kembali_ke_pembuka_dengan_pesan(): void
    {
        $this->post('/kuis')->assertRedirect(route('kuis.index'));
        $this->get('/kuis')->assertSee('Belum ada kata yang bisa dijadikan soal kuis.');
    }

    public function test_soal_dibuat_dengan_empat_pilihan_dan_kunci_tidak_ada_di_halaman(): void
    {
        $this->isiKata(20);

        $this->post('/kuis')->assertRedirect(route('kuis.soal'));

        $html = $this->get('/kuis/soal')->assertOk()->getContent();

        $this->assertSame(10, substr_count($html, 'class="kuis-soal'));
        $this->assertSame(40, substr_count($html, 'class="kuis-pilihan"'));
    }

    public function test_skor_dihitung_di_server(): void
    {
        $this->isiKata(20);
        $this->post('/kuis');

        $soal = session('kuis');
        $this->assertCount(10, $soal);

        // 7 benar, 3 salah (satu tidak dijawab).
        $jawaban = [];
        foreach ($soal as $nomor => $item) {
            if ($nomor < 7) {
                $jawaban[$nomor] = $item['benar'];
            } elseif ($nomor < 9) {
                $jawaban[$nomor] = collect(['kruna_asi', 'kruna_aso', 'kruna_ami', 'kruna_mider', 'kruna_andap', 'kruna_kasar'])
                    ->first(fn ($k) => $k !== $item['benar']);
            }
        }

        $this->post('/kuis/selesai', ['jawaban' => $jawaban])
            ->assertRedirect(route('kuis.hasil'));

        $this->get('/kuis/hasil')
            ->assertOk()
            ->assertSee('KUIS SELESAI!')
            ->assertSee('<span class="kuis-statistik-nilai">70</span>', false)
            ->assertSee('<span class="kuis-statistik-nilai">7</span>', false)
            ->assertSee('<span class="kuis-statistik-nilai">3</span>', false);
    }

    public function test_halaman_soal_tanpa_sesi_kembali_ke_pembuka(): void
    {
        $this->get('/kuis/soal')->assertRedirect(route('kuis.index'));
        $this->post('/kuis/selesai')->assertRedirect(route('kuis.index'));
        $this->get('/kuis/hasil')->assertRedirect(route('kuis.index'));
    }
}
