@extends('admin.master_layout.main')
@section('title')
    Trang thống kê
@endsection

@section('main')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Hàng 1: Doanh thu & Đơn hàng -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/css/admin/img/icons/unicons/chart-success.png') }}"
                                        alt="chart success" class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Tổng doanh thu</span>
                            <h3 class="card-title mb-2">{{ number_format($totalRevenue, 0, ',', '.') }}VNĐ</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/css/admin/img/icons/unicons/wallet-info.png') }}"
                                        alt="wallet" class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <span>Tổng đơn hàng</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $totalOrders }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Hàng 2: Người dùng & Sản phẩm -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/css/admin/img/icons/unicons/paypal.png') }}" alt="paypal"
                                        class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <span class="d-block mb-1">Người dùng</span>
                            <h3 class="card-title text-nowrap mb-2">{{ $totalUsers }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/css/admin/img/icons/unicons/cc-primary.png') }}"
                                        alt="credit" class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Sản phẩm</span>
                            <h3 class="card-title mb-2">{{ $totalProducts }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Hàng 3: Sản phẩm nổi bật (chiếm full width) -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Sản phẩm nổi bật</h5>
                                        <span class="badge bg-label-warning rounded-pill">Top reviews</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        @if ($topProduct)
                                            <small class="text-success fw-semibold">
                                                <i class="bx bx-star"></i> {{ $topProduct->reviews_count }} đánh giá
                                            </small>
                                            <h3 class="mb-0">{{ $topProduct->product_name }}</h3>
                                        @else
                                            <small>Không có sản phẩm</small>
                                        @endif
                                    </div>
                                </div>
                                <div id="profileReportChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- / Content -->
        <div class="content-backdrop fade"></div>
    </div>
@endsection
