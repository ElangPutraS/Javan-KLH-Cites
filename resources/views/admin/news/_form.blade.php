<div class="form-group">
    <label class="control-label"><h4>Judul</h4></label>
    @if ($disable)
     	<input type="text" name="title" class="form-control" value="{{ old('title', array_get($news, 'title')) }}" readonly>
    @else
    	<input type="text" name="title" class="form-control" value="{{ old('title', array_get($news, 'title')) }}">
    @endif

</div>


<div class="form-group">
    <label class="control-label"><h4>Isi</h4></label>
     @if ($disable)
    <textarea name="content" class="form-control" value="{{ old('content', array_get($news, 'content')) }}" readonly="">{{ old('content', array_get($news, 'content')) }}</textarea>
    @else
    <textarea name="content" class="form-control" value="{{ old('content', array_get($news, 'content')) }}">{{ old('content', array_get($news, 'content')) }}</textarea>
    @endif
    
</div>




