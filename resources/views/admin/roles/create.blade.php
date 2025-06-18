@extends('admin.master_layout.main')

@section('title', 'Thêm Quyền Mới')

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm Quyền Mới</h3>
        </div>
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="role_name">Tên Quyền</label>
                    <input type="text" name="role_name" id="role_name"
                        class="form-control @error('role_name') is-invalid @enderror" value="{{ old('role_name') }}"
                        required>
                    @error('role_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm Quyền</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
@endsection
