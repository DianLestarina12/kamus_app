<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Katas extends Model
{
    use SoftDeletes;
 
    // Urutan tingkatan menentukan urutan baris pada tabel detail kata.
    public const TINGKATAN = [
        'kruna_asi' => ['label' => 'Kruna Alus Singgih', 'singkatan' => 'ASI'],
        'kruna_aso' => ['label' => 'Kruna Alus Sor', 'singkatan' => 'ASO'],
        'kruna_ami' => ['label' => 'Kruna Alus Mider', 'singkatan' => 'AMI'],
        'kruna_mider' => ['label' => 'Kruna Mider', 'singkatan' => null],
        'kruna_andap' => ['label' => 'Kruna Andap', 'singkatan' => null],
        'kruna_kasar' => ['label' => 'Kruna Kasar', 'singkatan' => null],
    ];
 
    protected $fillable = [
        'kruna_asi', 'kruna_aso', 'kruna_ami', 'kruna_mider', 'kruna_andap', 'kruna_kasar', 'bahasa_indonesia',
    ];
 
    protected static function booted(): void
    {
        static::saving(function (self $kata) {
            $kata->sidik = self::hitungSidik($kata->getAttributes());
        });
    }
 
    public static function tingkatanKeys(): array
    {
        return array_keys(self::TINGKATAN);
    }
 
    // Sidik isi baris: dipakai untuk mendeteksi entri yang identik persis (satu kata bisa punya banyak arti).
    public static function hitungSidik(array $nilai): string
    {
        $bagian = array_map(
            fn ($kolom) => mb_strtolower(trim((string) ($nilai[$kolom] ?? ''))),
            [...self::tingkatanKeys(), 'bahasa_indonesia']
        );
 
        return hash('sha256', implode("\x1f", $bagian));
    }
 
    public static function tingkatanLabel(?string $key, bool $withSingkatan = false): ?string
    {
        $tingkatan = self::TINGKATAN[$key] ?? null;
 
        if (! $tingkatan) {
            return null;
        }
 
        return $withSingkatan && $tingkatan['singkatan']
            ? "{$tingkatan['label']} ({$tingkatan['singkatan']})"
            : $tingkatan['label'];
    }
 
    // Bentuk kata utama: dipakai sebagai judul ketika tidak ada tingkatan spesifik yang diminta.
    public function bentukUtama(?string $tingkatan = null): ?string
    {
        if ($tingkatan && filled($this->{$tingkatan} ?? null)) {
            return $this->{$tingkatan};
        }
 
        foreach (self::tingkatanKeys() as $key) {
            if (filled($this->{$key})) {
                return $this->{$key};
            }
        }
 
        return null;
    }
 
    public function sinonim(): BelongsToMany
    {
        return $this->relasi('sinonim');
    }
 
    public function homonim(): BelongsToMany
    {
        return $this->relasi('homonim');
    }
 
    protected function relasi(string $tipe): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'kata_relasi', 'kata_id', 'kata_terkait_id')
            ->withPivot(['id', 'tipe', 'tingkatan'])
            ->wherePivot('tipe', $tipe)
            ->withTimestamps();
    }
}
