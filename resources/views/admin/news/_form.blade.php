<div class="form-group">
    <h2 class="card-title">Data Informasi</h2>
</div>

<div class="form-group">
    <label class="control-label">Judul</label>
     	<input type="text" name="title" class="form-control" value="{{ old('title', array_get($news, 'title')) }}" >
</div>


<div class="form-group">
    <label class="control-label">Isi</label>
    <textarea name="content" id="content-form-news" value="{{ old('content', array_get($news, 'content')) }}"}>{{ old('content', array_get($news, 'content')) }}</textarea>
</div>


