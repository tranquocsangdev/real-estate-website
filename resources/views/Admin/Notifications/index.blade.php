@extends('Admin.Layout.master')
@section('title', 'Blog')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h5 class="mt-2 text-white text-uppercase">Danh sách lịch sử hoạt động</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center text-uppercase">
                                    <th>#</th>
                                    <th>Loại</th>
                                    <th>Nội dung</th>
                                    <th style="width: 200px;">Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, index) in list_notifications">
                                    <tr class="align-middle">
                                        <th class="text-center">@{{ index + 1 }}</th>
                                        <td class="text-center align-middle" style="width: 300px;">
                                            <span class="badge bg-primary" v-if="value.type == 1">Khách hàng đăng ký</span>
                                            <span class="badge bg-success" v-if="value.type == 2">Khách hàng xem tin
                                                tức</span>
                                            <span class="badge bg-info" v-if="value.type == 3">Khách hàng xem bài
                                                viết</span>
                                            <span class="badge bg-warning" v-if="value.type == 4">Khách hàng xem danh
                                                mục</span>
                                            <span class="badge bg-danger" v-if="value.type == 5">Admin đăng nhập</span>
                                        </td>
                                        <td> <b>@{{ value.tieu_de }}</b> - <span
                                                class="text-muted">@{{ value.noi_dung }}</span></td>
                                        <td class="text-center" v-html="date_format_full(value.created_at)"></td>
                                        <td class="text-center">
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteNotificationModal">
                                                <i class="fa-solid fa-trash-can-arrow-up me-0"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Xóa tin tức -->
        <div class="modal fade" id="deleteNotificationModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteNotificationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white text-uppercase" id="deleteNotificationModalLabel">Xác nhận xóa lịch sử hoạt động
                            <b>@{{ del.tieu_de }}</b>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i> Cảnh báo!</strong> Bạn có chắc chắn muốn xóa
                            lịch sử hoạt động <b>@{{ del.tieu_de }}</b> này không?
                            <br>
                            <span>Hành động này <b>không thể hoàn tác</b>. Nếu bạn đồng ý, hãy nhấn <b>Xác nhận</b> bên
                                dưới.</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" v-on:click="deleteNotification()">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                list_notifications: [],
                del: {},
            },
            mounted() {
                this.getDataNotificationAll();
            },
            methods: {
                getDataNotificationAll() {
                    axios
                        .get('/admin/notifications/data-all')
                        .then((res) => {
                            this.list_notifications = res.data.data;
                        })
                        .catch((err) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                deleteNotification() {
                    axios
                        .post('/admin/notifications/delete', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.getDataNotificationAll();
                                $('#deleteNotificationModal').modal('hide');
                            } else {
                                toastr.error(res.data.message, 'Error');
                                $('#deleteNotificationModal').modal('hide');
                            }
                        })
                        .catch((err) => {
                            $.each(err.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                }
            },
        });
    </script>
@endsection
