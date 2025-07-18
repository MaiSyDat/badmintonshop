@extends('admin.master_layout.main')

@section('title', 'Quản lý đánh giá')

@section('main')
    <div class="container mt-4">
        <h2 class="mb-4">Quản lý đánh giá sản phẩm</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($reviews->isEmpty())
            <div class="alert alert-info">Chưa có đánh giá nào.</div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>Người dùng</th>
                        <th>Sao</th>
                        <th>Bình luận</th>
                        <th>Phản hồi</th>
                        <th>Phê duyệt</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $index => $review)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $review->product->product_name ?? 'N/A' }}</td>
                            <td>{{ $review->user->full_name ?? 'Ẩn danh' }}</td>
                            <td>{{ $review->rating }}/5</td>
                            <td>{{ $review->comment }}</td>
                            <td>{{ $review->reply ?? 'Chưa phản hồi' }}</td>
                            <td>
                                @if ($review->is_approved)
                                    <span class="badge badge-success">Đã duyệt</span>
                                @else
                                    <span class="badge badge-warning">Chưa duyệt</span>
                                @endif
                            </td>
                            <td>
                                <!-- Nút phản hồi -->
                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#replyModal{{ $review->id }}">
                                    Phản hồi
                                </button>
                            </td>
                        </tr>

                        <!-- Modal phản hồi -->
                        <div class="modal fade" id="replyModal{{ $review->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="replyModalLabel{{ $review->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('admin.reviews.reply', ['review' => $review->review_id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="replyModalLabel{{ $review->id }}">Phản hồi đánh
                                                giá</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea name="reply" class="form-control" rows="4" placeholder="Nhập phản hồi">{{ $review->reply }}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Gửi phản hồi</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Hủy</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
