@extends('Admin.Layout.master')
@section('title', 'Blog')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h5 class="mt-2 text-white text-uppercase">Danh sách thông báo</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                                        <td> @{{ value.id_doi_tuong }} @{{ value.noi_dung }}</td>
                                        <td class="text-center" v-html="date_format_full(value.created_at)"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
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
            },
        });
    </script>
@endsection
