@extends('Admin.Layout.master')

@section('title', 'Danh Mục Cha')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mt-2 text-white text-uppercase">Thêm mới danh mục</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" v-model="create.name">
                    </div>
                    <div class="">
                        <label class="form-label">Icon</label>
                        <input type="text" class="form-control" v-model="create.icon">
                    </div>
                    <div class="form-text">
                        <span class="text-muted">Tìm kiếm icon <a href="https://fontawesome.com/icons" target="_blank"
                                rel="noopener noreferrer">tại đây</a></span>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" :disabled="is_loading_create" v-on:click="createCategory()">

                        <span v-if="is_loading_create">
                            <i class="fa fa-spinner fa-spin"></i> Đang xử lý...
                        </span>

                        <span v-else>
                            Thêm mới
                        </span>

                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mt-2 text-white text-uppercase">Danh sách danh mục</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center text-uppercase">
                                    <th>#</th>
                                    <th>Tên danh mục</th>
                                    <th>Icon</th>
                                    <th>Tình Trạng</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(v, k) in list">
                                    <tr>
                                        <th class="text-center align-middle">@{{ k + 1 }}</th>
                                        <td class="align-middle">@{{ v.name }}</td>
                                        <td class="text-center">
                                            <span class="fa-2x" v-html="v.icon"></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-success btn-sm" v-if="v.status == 1"
                                                :disabled="is_loading_change == v.id" v-on:click="changeStatus(v)">

                                                <span v-if="is_loading_change == v.id">
                                                    <i class="fa fa-spinner fa-spin"></i>
                                                </span>

                                                <span v-else>
                                                    Đang mở
                                                </span>

                                            </button>

                                            <button class="btn btn-warning btn-sm text-white" v-else
                                                :disabled="is_loading_change == v.id" v-on:click="changeStatus(v)">

                                                <span v-if="is_loading_change == v.id">
                                                    <i class="fa fa-spinner fa-spin"></i>
                                                </span>

                                                <span v-else>
                                                    Đã tắt
                                                </span>

                                            </button>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button v-on:click="update = Object.assign({}, v)" class="btn btn-info btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#updateModal"><i
                                                    class="fa-solid fa-pen-to-square me-0"></i>
                                            </button>
                                            <button v-on:click="del = Object.assign({}, v)" class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">
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
    </div>

    <!-- Modal Cập nhật danh mục-->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white text-uppercase" id="exampleModalLabel">Cập nhật danh mục
                        <b>@{{ update.name }}</b>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" v-model="update.name">
                    </div>
                    <div class="">
                        <label class="form-label">Icon</label>
                        <input type="text" class="form-control" v-model="update.icon">
                    </div>
                    <div class="form-text">
                        <span>Tìm kiếm icon <a href="https://fontawesome.com/icons" target="_blank"
                                rel="noopener noreferrer">tại đây</a></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" :disabled="is_loading_update"
                        v-on:click="updateCategory()">

                        <span v-if="is_loading_update">
                            <i class="fa fa-spinner fa-spin"></i> Đang cập nhật...
                        </span>

                        <span v-else>
                            Xác nhận
                        </span>

                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xóa danh mục-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white text-uppercase" id="exampleModalLabel">Xác nhận xóa danh mục
                        <b>@{{ del.name }}</b>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Cảnh báo!</strong> Bạn có chắc chắn muốn xóa
                        danh mục <b>@{{ del.name }}</b> này không?
                        <br>
                        <span>Hành động này <b>không thể hoàn tác</b>. Nếu bạn đồng ý, hãy nhấn <b>Xác nhận</b> bên
                            dưới.</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" :disabled="is_loading_delete"
                        v-on:click="deleteCategory()">

                        <span v-if="is_loading_delete">
                            <i class="fa fa-spinner fa-spin"></i> Đang xóa...
                        </span>

                        <span v-else>
                            Xác nhận
                        </span>

                    </button>
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
                is_loading_create: false,
                is_loading_update: false,
                is_loading_delete: false,
                is_loading_change: null,
            },
            created() {
                this.loadData();
            },
            methods: {
                loadData() {
                    axios
                        .post('/admin/category/data')
                        .then((res) => {
                            this.list = res.data.data;
                        })
                },
                createCategory() {
                    this.is_loading_create = true;
                    axios
                        .post('/admin/category/create', this.create)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                this.create = {};
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        })
                        .finally(() => {
                            this.is_loading_create = false;
                        });
                },
                updateCategory() {
                    this.is_loading_update = true;
                    axios
                        .post('/admin/category/update', this.update)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                this.update = {};
                                $('#updateModal').modal('hide');
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((err) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        })
                        .finally(() => {
                            this.is_loading_update = false;
                        });
                },
                deleteCategory() {
                    this.is_loading_delete = true;
                    axios
                        .post('/admin/category/delete', this.del)
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
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        })
                        .finally(() => {
                            this.is_loading_delete = false;
                        });
                },
                changeStatus(value) {
                    this.is_loading_change = value.id;
                    axios
                        .post('/admin/category/change', value)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                value.status = value.status == 1 ? 0 : 1;
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((err) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        })
                        .finally(() => {
                            this.is_loading_change = null;
                        });
                },
            }
        });
    </script>
@endsection
