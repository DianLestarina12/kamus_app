<?php

namespace Tests\Feature;

use App\Models\Soals;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KuisTest extends TestCase
{
    use RefreshDatabase;

    private function isiSoal(int $jumlah): void
    {
        for ($i = 0; $i < $jumlah; $i++) {
            Soals::create([
                'soal' => "Pertanyaan {$i}?",
                'jawaban' => "Pilihan {$i} benar",
                'opsi1' => "Pilihan {$i} salah 1",
                'opsi2' => "Pilihan {$i} benar",
                'opsi3' => "Pilihan {$i} salah 2",
                'opsi4' => "Pilihan {$i} salah 3",
            ]);
        }
    }

    public function test_halaman_pembuka_tampil(): void
    {
        $this->get('/kuis')->assertOk()->assertSee('Kuis Evaluasi');
    }

    public function test_tanpa_data_kata_kembali_ke_pembuka_dengan_pesan(): void
    {
        $this->post('/kuis')->assertRedirect(route('kuis.index'));
        $this->get('/kuis')->assertSee('Belum ada soal kuis. Tambahkan soal terlebih dahulu.');
    }

    public function test_soal_dibuat_dengan_empat_pilihan_dan_kunci_tidak_ada_di_halaman(): void
    {
        $this->isiSoal(20);

        $this->post('/kuis')->assertRedirect(route('kuis.soal'));

        $html = $this->get('/kuis/soal')->assertOk()->getContent();

        $this->assertSame(10, substr_count($html, 'class="kuis-soal'));
        $this->assertSame(40, substr_count($html, 'class="kuis-pilihan"'));
    }

    public function test_soal_diambil_dari_daftar_soal_yang_sudah_dibuat(): void
    {
        Soals::create([
            'soal' => 'Kruna apa yang sama sekali tidak memiliki bentuk lain?',
            'jawaban' => 'Kruna Mider',
            'opsi1' => 'Kruna Mider',
            'opsi2' => 'Kruna Andap',
            'opsi3' => 'Kruna Kasar',
            'opsi4' => 'Kruna Alus Sor (ASO)',
        ]);

        $this->post('/kuis')->assertRedirect(route('kuis.soal'));

        $this->get('/kuis/soal')
            ->assertOk()
            ->assertSee('Kruna apa yang sama sekali tidak memiliki bentuk lain?')
            ->assertSee('Kruna Alus Sor (ASO)');
    }

    public function test_skor_dihitung_di_server(): void
    {
        $this->isiSoal(20);
        $this->post('/kuis');

        $soal = session('kuis');
        $this->assertCount(10, $soal);

        // 7 benar, 2 salah, 1 tidak dijawab.
        $jawaban = [];
        foreach ($soal as $nomor => $item) {
            if ($nomor < 7) {
                $jawaban[$nomor] = $item['benar'];
            } elseif ($nomor < 9) {
                $jawaban[$nomor] = collect(['opsi1', 'opsi2', 'opsi3', 'opsi4'])
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
