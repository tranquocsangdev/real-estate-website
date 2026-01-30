@extends('Admin.Layout.master')

@section('title', 'Tài khoản admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white text-uppercase">Danh sách tài khoản admin</h5>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createModal"> Thêm mới
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Avatar</th>
                                    <th>Tình Trạng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(v, k) in list">
                                    <tr>
                                        <th class="text-center align-middle">@{{ k + 1 }}</th>
                                        <td class="align-middle">@{{ v.name }}</td>
                                        <td class="align-middle">@{{ v.email }}</td>
                                        <td class="text-center align-middle">
                                            <img :src="v.avatar" alt="Avatar" class="user-img">
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-success text-white" v-if="v.is_open == 1"
                                                v-on:click="changeStatus(v)">Đang hoạt động</button>
                                            <button class="btn btn-danger text-white" v-else
                                                v-on:click="changeStatus(v)">Đã khóa</button>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button v-on:click="update = Object.assign({}, v)"
                                                class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#updateModal">
                                                <i class="fa-solid fa-pencil ms-1"></i>
                                            </button>
                                            <button v-on:click="del = Object.assign({}, v)" class="btn btn-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                <i class="fa-regular fa-trash-can ms-1"></i>
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
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Thêm mới admin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="">Họ tên</label>
                        <input type="text" class="form-control" v-model="create.name">
                    </div>
                    <div class="mb-2">
                        <label class="">Email</label>
                        <input type="text" class="form-control" v-model="create.email">
                    </div>
                    <div class="mb-2">
                        <label class="">Password</label>
                        <input type="text" class="form-control" v-model="create.password">
                    </div>
                    <div class="mb-2">
                        <label class="">Nhập lại Pasword</label>
                        <input type="text" class="form-control" v-model="create.re_password">
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <label class="form-label">Ảnh đại diện (<span class="text-danger">*</span>)</label>
                            <input type="file" class="form-control" accept="image/*"
                                v-on:change="handleAvatar($event)" />
                            <small class="text-muted fst-italic d-block mt-2">
                                * Ảnh đại diện sẽ được hiển thị là avatar của tài khoản. Vui lòng chọn ảnh có kích thước phù
                                hợp để hiển thị đẹp mắt.
                            </small>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label d-block text-center">Ảnh xem trước</label>
                            <div class="border rounded bg-light d-flex justify-content-center align-items-center"
                                style="height: 120px;">
                                <img :src="preview" class="img-fluid rounded-circle"
                                    style="width: 100px; height: 100px;" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="createAdmin()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Cập nhật danh mục
                        <b>@{{ update.name }}</b>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="">Họ tên</label>
                        <input type="text" class="form-control" v-model="update.name">
                    </div>
                    <div class="mb-2">
                        <label class="">Email</label>
                        <input type="text" class="form-control" v-model="update.email">
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <label class="form-label">Ảnh đại diện (<span class="text-danger">*</span>)</label>
                            <input type="file" class="form-control" accept="image/*"
                                v-on:change="handleUpdateAvatar($event)" />
                            <small class="text-muted fst-italic d-block mt-2">
                                * Ảnh đại diện sẽ được hiển thị là avatar của tài khoản. Vui lòng chọn ảnh có kích thước phù
                                hợp để hiển thị đẹp mắt.
                            </small>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label d-block text-center">Ảnh xem trước</label>
                            <div class="border rounded bg-light d-flex justify-content-center align-items-center"
                                style="height: 120px;">
                                <img :src="update.avatar" class="img-fluid rounded-circle"
                                    style="width: 100px; height: 100px;" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="updateAdmin()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Del -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Xác nhận xóa tài khoản admin
                        <b>@{{ del.name }}</b>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Cảnh báo!</strong> Bạn có chắc chắn muốn xóa
                        tài khoản admin <b>@{{ del.name }}</b> này không?
                        <br>
                        <span>Hành động này <b>không thể hoàn tác</b>. Nếu bạn đồng ý, hãy nhấn <b>Xác nhận</b> bên
                            dưới.</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="deleteAdmin()">Xác nhận</button>
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
                create: {},
                update: {},
                del: {},
                preview: ''
            },
            created() {
                this.loadData();
            },
            methods: {
                loadData() {
                    axios
                        .post('/admin/admin/data')
                        .then((res) => {
                            this.list = res.data.data;
                        })
                },
                createAdmin() {
                    axios
                        .post('/admin/admin/create', this.create)
                        .then((res) => {
                            if (res.data.status) {
                                $('#createModal').modal('hide');
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                this.create = {};
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
                updateAdmin() {
                    axios
                        .post('/admin/admin/update', this.update)
                        .then((res) => {
                            if (res.data.status) {
                                $('#updateModal').modal('hide');
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                this.update = {};
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
                deleteAdmin() {
                    axios
                        .post('/admin/admin/delete', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                this.del = {};
                                $('#deleteModal').modal('hide');
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
                changeStatus(value) {
                    axios
                        .post('/admin/admin/change', value)
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
                date_format(now) {
                    return moment(now).format('DD/MM/yyyy');
                },
                handleAvatar(e) {
                    var formData = new FormData();
                    formData.append('file', e.target.files[0]);
                    axios
                        .post('/admin/admin/upload', formData)
                        .then((res) => {
                            if (res.data.status) {
                                this.preview = res.data.file;
                                this.create.avatar = res.data.file;
                                toastr.success(res.data.message, 'Success');
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
                handleUpdateAvatar(e) {
                    var formData = new FormData();
                    formData.append('file', e.target.files[0]);
                    axios
                        .post('/admin/admin/upload', formData)
                        .then((res) => {
                            if (res.data.status) {
                                this.update.avatar = res.data.file;
                                toastr.success(res.data.message, 'Success');
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((err) => {
                            $.each(err.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                }
            }
        });
    </script>
@endsection
