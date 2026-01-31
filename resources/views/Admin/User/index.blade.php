@extends('Admin.Layout.master')

@section('title', 'Tài khoản khách hàng')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mt-2 text-white text-uppercase">Danh sách tài khoản khách hàng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Tình Trạng</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(v, k) in list">
                                    <tr>
                                        <th class="text-center align-middle">@{{ k + 1 }}</th>
                                        <td class="align-middle">@{{ v.name }}</td>
                                        <td class="align-middle">@{{ v.email ?? 'Không có' }}</td>
                                        <td class="align-middle text-center">@{{ v.phone }}</td>
                                        <td class="text-center align-middle">
                                            <button v-on:click="changeStatus(v)" class="btn btn-success text-white"
                                                v-if="v.is_active == 1">Đang
                                                hoạt động</button>
                                            <button v-on:click="changeStatus(v)" class="btn btn-danger text-white" v-else>Đã
                                                khóa</button>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button v-on:click="del = Object.assign({}, v)" class="btn btn-danger text-white"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                Xóa tài khoản
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

        <!-- Modal Xóa danh mục con-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white text-uppercase" id="exampleModalLabel">Xác nhận xóa tài khoản
                            khách hàng
                            <b>@{{ del.name }}</b>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i> Cảnh báo!</strong> Bạn có chắc chắn muốn xóa
                            tài khoản khách hàng <b>@{{ del.name }}</b> này không?
                            <br>
                            <span>Hành động này <b>không thể hoàn tác</b>. Nếu bạn đồng ý, hãy nhấn <b>Xác nhận</b> bên
                                dưới.</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" v-on:click="deleteUser()">Xác nhận</button>
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
                list: [],
                del: {},
            },
            created() {
                this.loadData();
            },
            methods: {
                loadData() {
                    axios
                        .post('/admin/user/data')
                        .then((res) => {
                            this.list = res.data.data;
                        })
                        .catch((err) => {
                            $.each(err.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                changeStatus(v) {
                    var payload = {
                        id: v.id
                    }
                    axios
                        .post('/admin/user/change', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((err) => {
                            $.each(err.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                deleteUser() {
                    axios
                        .post('/admin/user/delete', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                $('#deleteModal').modal('hide');
                                this.del = {};
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((err) => {
                            $.each(err.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
            }
        });
    </script>
@endsection
