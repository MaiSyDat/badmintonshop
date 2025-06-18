@extends('admin.master_layout.main')

@section('title', 'Sửa Quyền')

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Sửa Quyền: {{ $role->role_name }}</h3>
        </div>
        <form action="{{ route('admin.roles.update', $role->role_id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Bắt buộc phải có để gửi request PUT/PATCH --}}
            <div class="card-body">
                <div class="form-group">
                    <label for="role_name">Tên Quyền</label>
                    <input type="text" name="role_name" id="role_name"
                        class="form-control @error('role_name') is-invalid @enderror"
                        value="{{ old('role_name', $role->role_name) }}" required>
                    @error('role_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhật Quyền</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
@endsection
