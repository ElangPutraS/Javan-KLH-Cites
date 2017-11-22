<div class="form-group">
    <label class="control-label"><h4>Kategori</h4></label>
    <input type="text" name="kategori" class="form-control" value="{{ old('kategori', array_get($news, 'kategori')) }}">
   
</div>


<div class="form-group">
    <label class="control-label"><h4>Judul</h4></label>
     <input type="text" name="judul" class="form-control" value="{{ old('judul', array_get($news, 'judul')) }}">

</div>


<div class="form-group">
    <label class="control-label"><h4>Isi</h4></label>
    <textarea name="isi" class="form-control" value="{{ old('isi', array_get($news, 'isi')) }}">{{ old('isi', array_get($news, 'isi')) }}</textarea>
    
</div>




