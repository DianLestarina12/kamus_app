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
 
    // Data impor memakai "-" sebagai penanda bentuk yang tidak tersedia.
    public static function adaBentuk(?string $nilai): bool
    {
        return filled($nilai) && trim($nilai) !== '-';
    }
 
    // Tingkatan pertama (menurut urutan TINGKATAN) yang punya bentuk kata.
    public function tingkatanUtama(): ?string
    {
        foreach (self::tingkatanKeys() as $key) {
            if (self::adaBentuk($this->{$key})) {
                return $key;
            }
        }
 
        return null;
    }
 
    // Bentuk kata utama: dipakai sebagai judul ketika tidak ada tingkatan spesifik yang diminta.
    public function bentukUtama(?string $tingkatan = null): ?string
    {
        if ($tingkatan && self::adaBentuk($this->{$tingkatan} ?? null)) {
            return $this->{$tingkatan};
        }
 
        $utama = $this->tingkatanUtama();
 
        return $utama ? $this->{$utama} : null;
    }
 
    // Makna-makna dalam arti bahasa Indonesia, mis. "payah, lelah" -> ['payah', 'lelah'].
    public static function daftarArti(?string $arti): array
    {
        $bagian = array_map(fn ($makna) => mb_strtolower(trim($makna)), explode(',', (string) $arti));

        return array_values(array_unique(array_filter($bagian, fn ($makna) => $makna !== '')));
    }

    // Sinonim berbasis arti: kata lain yang punya minimal satu makna bahasa Indonesia yang sama.
    public function sinonimSearti()
    {
        $arti = self::daftarArti($this->bahasa_indonesia);

        if ($arti === []) {
            return collect();
        }

        return self::query()
            ->whereKeyNot($this->getKey())
            ->where(function ($query) use ($arti) {
                foreach ($arti as $makna) {
                    $query->orWhere('bahasa_indonesia', 'like', '%' . addcslashes($makna, '%_\\') . '%');
                }
            })
            ->get()
            ->filter(fn (self $kata) => array_intersect($arti, self::daftarArti($kata->bahasa_indonesia)) !== [])
            ->sortBy(fn (self $kata) => mb_strtolower((string) $kata->bentukUtama()), SORT_NATURAL)
            ->values();
    }

    public function homonim(): BelongsToMany
    {
        return $this->relasi('homonim');
    }
 
    // Bentuk-bentuk dalam satu kolom tingkatan, mis. "adénan, ngadénan" atau "geni/agni".
    public static function daftarBentuk(?string $nilai): array
    {
        $bagian = array_map(fn ($bentuk) => mb_strtolower(trim($bentuk)), preg_split('/[,\/]/', (string) $nilai));

        return array_values(array_unique(array_filter($bagian, fn ($bentuk) => self::adaBentuk($bentuk))));
    }

    // Homonim berbasis bentuk: kata lain yang di tingkatan mana pun punya bentuk yang sama dengan
    // bentuk yang sedang ditampilkan. Satu entri per kata + tingkatan yang cocok.
    public function homonimSebentuk(?string $tingkatan = null)
    {
        $bentukDicari = self::daftarBentuk($this->bentukUtama($tingkatan));

        if ($bentukDicari === []) {
            return collect();
        }

        $katas = self::query()
            ->whereKeyNot($this->getKey())
            ->where(function ($query) use ($bentukDicari) {
                foreach (self::tingkatanKeys() as $kolom) {
                    foreach ($bentukDicari as $bentuk) {
                        $query->orWhere($kolom, 'like', '%' . addcslashes($bentuk, '%_\\') . '%');
                    }
                }
            })
            ->get();

        $hasil = [];

        foreach ($katas as $kata) {
            foreach (self::tingkatanKeys() as $kolom) {
                if (array_intersect($bentukDicari, self::daftarBentuk($kata->{$kolom})) !== []) {
                    $hasil[] = ['kata' => $kata, 'bentuk' => $kata->{$kolom}, 'tingkatan' => $kolom];
                }
            }
        }

        return collect($hasil)
            ->sortBy(fn ($item) => mb_strtolower($item['bentuk'] . ' ' . $item['kata']->bahasa_indonesia), SORT_NATURAL)
            ->values();
    }

    protected function relasi(string $tipe): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'kata_relasi', 'kata_id', 'kata_terkait_id')
            ->withPivot(['id', 'tipe', 'tingkatan'])
            ->wherePivot('tipe', $tipe)
            ->withTimestamps();
    }
}
