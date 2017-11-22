<div class="form-group">
    <label class="control-label">Kode</label>
    <div class="col-sm-14">

        <input type="text" name="category_code" class="form-control" value="{{ old('category_code', array_get($categories, 'species_category_code')) }}" required>



    </div>
</div>

<div class="form-group">
    <label class="control-label">Nama Kategori</label>
    <div class="col-sm-14">

        <input type="text" name="category_name" class="form-control" value="{{ old('category_name', array_get($categories, 'species_category_name')) }}" required>

    </div>
</div>
