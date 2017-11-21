<div class="form-group">
    <label class="control-label">Kode</label>
    <div class="col-sm-14">
        <input type="text" name="kategori_kode" class="form-control" value="{{ old('kategori_kode', array_get($kategori, 'species_kategori_kode')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nama Kategori</label>
    <div class="col-sm-14">
        <input type="text" name="kategori_nama" class="form-control" value="{{ old('kategori_nama', array_get($kategori, 'species_kategori_name')) }}" required>
    </div>
</div>
