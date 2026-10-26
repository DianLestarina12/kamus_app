<?php

namespace Tests\Feature;

use App\Models\Soals;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoalTest extends TestCase
{
    use RefreshDatabase;

    private function dataSoal(array $ubah = []): array
    {
        return array_merge([
            'soal' => 'Kruna apa yang sama sekali tidak memiliki bentuk lain?',
            'opsi1' => 'Kruna Mider',
            'opsi2' => 'Kruna Alus Mider (AMI)',
            'opsi3' => 'Kruna Alus Madya (AMA)',
            'opsi4' => 'Kruna Andap',
            'jawaban' => 'Kruna Mider',
        ], $ubah);
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get('/soal')->assertRedirect(route('login'));
        $this->post('/soal', $this->dataSoal())->assertRedirect(route('login'));
        $this->assertDatabaseCount('soals', 0);
    }

    public function test_admin_bisa_menambah_soal(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('soal.store'), $this->dataSoal())
            ->assertRedirect(route('soal.index'));

        $this->assertDatabaseHas('soals', ['soal' => $this->dataSoal()['soal'], 'jawaban' => 'Kruna Mider']);
    }

    public function test_jawaban_harus_sama_dengan_salah_satu_opsi(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('soal.store'), $this->dataSoal(['jawaban' => 'Bukan pilihan']))
            ->assertSessionHasErrors(['jawaban']);

        $this->assertDatabaseCount('soals', 0);
    }

    public function test_admin_bisa_mengedit_soal(): void
    {
        $this->actingAs(User::factory()->create());
        $soal = Soals::create($this->dataSoal());

        $this->put(route('soal.update', $soal->id), $this->dataSoal([
            'soal' => 'Soal yang sudah diubah',
            'jawaban' => 'Kruna Andap',
        ]))->assertRedirect(route('soal.index'));

        $this->assertDatabaseHas('soals', ['id' => $soal->id, 'soal' => 'Soal yang sudah diubah', 'jawaban' => 'Kruna Andap']);
    }

    public function test_admin_bisa_menghapus_soal(): void
    {
        $this->actingAs(User::factory()->create());
        $soal = Soals::create($this->dataSoal());

        $this->delete(route('soal.destroy', $soal->id))->assertRedirect(route('soal.index'));

        $this->assertDatabaseMissing('soals', ['id' => $soal->id]);
    }

    public function test_daftar_soal_menampilkan_soal_yang_ada(): void
    {
        $this->actingAs(User::factory()->create());
        Soals::create($this->dataSoal());

        $this->get(route('soal.index'))
            ->assertOk()
            ->assertSee('Kruna apa yang sama sekali tidak memiliki bentuk lain?');
    }
}
