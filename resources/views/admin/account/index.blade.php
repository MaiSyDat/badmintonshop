@extends('admin.master_layout.main')
@section('title')
    Quản lý tài khoản
@endsection
@section('main')
    <div class="col-md-12 main-content p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Quản lý người dùng</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quản lý người dùng</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.account.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Thêm người dùng
            </a>
        </div>

        <div class="search-section">
            <form action="{{ route('admin.account.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tìm kiếm</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="Tìm theo tên, email..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động
                            </option>
                            {{-- <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ duyệt</option> --}}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Chức vụ</label>
                        <select class="form-select" name="role_id">
                            <option value="">Tất cả chức vụ</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}"
                                    {{ request('role_id') == $role->role_id ? 'selected' : '' }}>
                                    {{ $role->role_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="bi bi-funnel me-2"></i>Lọc
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh sách người dùng</h5>
                <span class="badge bg-secondary">Tổng: {{ $users->total() }} người dùng</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">STT</th>
                                <th width="15%">Tên</th>
                                <th width="20%">Email</th>
                                <th width="20%">Địa chỉ</th>
                                <th width="10%">Trạng thái</th>
                                <th width="15%">Chức vụ</th>
                                <th width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $key }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @php
                                                $avatarPath = $user->avatar
                                                    ? asset('storage/' . $user->avatar)
                                                    : asset('path/to/default_avatar.png');
                                                $initials = '';
                                                if ($user->full_name) {
                                                    $nameParts = explode(' ', $user->full_name);
                                                    foreach ($nameParts as $part) {
                                                        $initials .= strtoupper(substr($part, 0, 1));
                                                    }
                                                } else {
                                                    $initials = strtoupper(substr($user->username, 0, 2));
                                                }
                                                $initials = substr($initials, 0, 2);
                                            @endphp

                                            @if ($user->avatar)
                                                <img src="{{ $avatarPath }}" alt="Avatar"
                                                    class="user-avatar me-3 rounded-circle"
                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="user-avatar me-3 rounded-circle d-flex align-items-center justify-content-center bg-primary text-white"
                                                    style="width: 40px; height: 40px; font-size: 14px;">
                                                    {{ $initials }}
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $user->full_name ?? $user->username }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address ?? 'N/A' }}</td>
                                    <td>
                                        @if ($user->is_active)
                                            <span class="badge bg-success status-badge">Hoạt động</span>
                                        @else
                                            <span class="badge bg-danger status-badge">Không hoạt động</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $user->role->role_name === 'Admin' ? 'primary' : ($user->role->role_name === 'Staff' ? 'info' : 'secondary') }}">
                                            {{ $user->role->role_name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="table-actions">
                                        <a href="{{ route('admin.account.edit', $user->user_id) }}"
                                            class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>

                                        {{-- FORM XÓA --}}
                                        <form action="{{ route('admin.account.destroy', $user->user_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                        {{-- KẾT THÚC FORM XÓA --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Không có người dùng nào được tìm thấy.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Hiển thị {{ $users->firstItem() }} - {{ $users->lastItem() }} trong tổng số {{ $users->total() }} kết quả
            </div>
            <nav aria-label="Phân trang">
                {{ $users->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>
@endsection
