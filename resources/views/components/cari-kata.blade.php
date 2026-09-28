@props(['nilai' => '', 'placeholder' => 'Cari Kata'])
 
<form method="GET" action="{{ route('kamus.cari') }}" {{ $attributes->merge(['class' => 'form-cari']) }}>
    <div class="input-cari">
        <input type="text" name="q" value="{{ $nilai }}" placeholder="{{ $placeholder }}" autocomplete="off" required>
        <i class="bi bi-search"></i>
    </div>
    <button type="submit" class="btn btn-cari">Cari</button>
</form>
