<div class="form-group">
    <label class="control-label"><h4>Judul</h4></label>
     	<input type="text" name="title" class="form-control" value="{{ old('title', array_get($news, 'title')) }}" {{ $disable === true ? 'readonly' : '' }} >
</div>


<div class="form-group">
    <label class="control-label"><h4>Isi</h4></label>
    <textarea name="content" id="content-form-news" value="{{ old('content', array_get($news, 'content')) }}"" {{ $disable === true ? 'readonly' : '' }}>{{ old('content', array_get($news, 'content')) }}</textarea>
</div>


