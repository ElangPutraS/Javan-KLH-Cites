<div class="form-group">
    <h3>Form User</h3>
</div>
<div class="form-group">
    <label class="control-label">Nama</label>
    <div class="col-sm-14">
        <input type="text" name="nama_user" class="form-control" value="{{ old('nama_user', array_get($user, 'name')) }}" disabled>
    </div>
</div>
<div class="form-group">
    <label class="control-label">Email</label>
    <div class="col-sm-14">
        <input type="text" name="email_user" class="form-control" value="{{ old('email_user', array_get($user, 'email')) }}" disabled>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Role</label>
    <div class="col-sm-14">
        <select name="role_name" id="role_name" class="form-control select2" required>
            <option value="">--Pilih Role--</option>
            @foreach($role as $key => $role_name)
                <option value="{{ $key }}" {{ $key == old('role_name', array_get($user->roles->first(), 'id')) ? 'selected' : '' }}>{{ $role_name }}</option>
            @endforeach
        </select>
    </div>
</div>