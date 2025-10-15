@extends('Admin.Layout.master')

@section('title', 'Danh Mục Con')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">Thêm mới danh mục con</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label class="">Danh Mục Cha</label>
                        <select class="form-select" v-model="create.id_category">
                            <option value="0">-- Chọn danh mục cha --</option>
                            <template v-for="(v, k) in list_category">
                                <option :value="v.id">@{{ v.name }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="">Tên danh mục con</label>
                        <input type="text" class="form-control" v-model="create.name">
                    </div>
                    <div class="mb-2">
                        <label class="">Icon</label>
                        <input type="text" class="form-control" v-model="create.icon">
                    </div>
                    <div class="">
                        <span>Tìm kiếm icon <a href="https://fontawesome.com/icons" target="_blank"
                                rel="noopener noreferrer">tại đây</a></span>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary btn-sm" v-on:click="createSubCategory()">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">Danh sách danh mục con</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Danh mục cha</th>
                                    <th>Danh mục con</th>
                                    <th>Icon</th>
                                    <th>Tình Trạng</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(v, k) in list">
                                    <tr>
                                        <th class="text-center align-middle">@{{ k + 1 }}</th>
                                        <td class="align-middle">@{{ v.category_name }}</td>
                                        <td class="align-middle">@{{ v.name }}</td>
                                        <td class="text-center align-middle">
                                            <span class="fa-2x" v-html="v.icon"></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-success btn-sm text-white" v-if="v.status == 1"
                                                v-on:click="changeStatus(v)">Đang mở</button>
                                            <button class="btn btn-warning btn-sm text-white" v-else
                                                v-on:click="changeStatus(v)">Đã tắt</button>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button v-on:click="update = Object.assign({}, v)"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#updateModal">
                                                <i class="fa-solid fa-pencil ms-1"></i>
                                            </button>
                                            <button v-on:click="del = Object.assign({}, v)" class="btn btn-danger btn-sm"
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

    <!-- Modal -->
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
                        <label class="">Danh Mục Cha</label>
                        <select class="form-select" v-model="update.id_category">
                            <option value="0">-- Chọn danh mục cha --</option>
                            <template v-for="(v, k) in list_category">
                                <option :value="v.id">@{{ v.name }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="">Tên danh mục con</label>
                        <input type="text" class="form-control" v-model="update.name">
                    </div>
                    <div class="mb-2">
                        <label class="">Icon</label>
                        <input type="text" class="form-control" v-model="update.icon">
                    </div>
                    <div class="">
                        <span>Tìm kiếm icon <a href="https://fontawesome.com/icons" target="_blank"
                                rel="noopener noreferrer">tại đây</a></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="updateSubCategory()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Xác nhận xóa danh mục con
                        <b>@{{ del.name }}</b>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Cảnh báo!</strong> Bạn có chắc chắn muốn xóa
                        danh mục con <b>@{{ del.name }}</b> này không?
                        <br>
                        <span>Hành động này <b>không thể hoàn tác</b>. Nếu bạn đồng ý, hãy nhấn <b>Xác nhận</b> bên
                            dưới.</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="deleteSubCategory()">Xác nhận</button>
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
                list_category: [],
                create: {
                    id_category: 0,
                    name: '',
                    icon: ''
                },
                update: {},
                del: {},
            },
            created() {
                this.loadDataCategory();
                this.loadData();
            },
            methods: {
                loadDataCategory() {
                    axios
                        .get('/admin/category/data-open')
                        .then((res) => {
                            this.list_category = res.data.data;
                            displaySuccess(res, false);
                        })
                },
                loadData() {
                    axios
                        .post('/admin/subcategory/data')
                        .then((res) => {
                            this.list = res.data.data;
                            displaySuccess(res, false);
                        })
                },
                createSubCategory() {
                    axios
                        .post('/admin/subcategory/create', this.create)
                        .then((res) => {
                            this.loadData();
                            this.create = {};
                            displaySuccess(res);
                        })
                        .catch((err) => {
                            displayErrors(err);
                        });
                },
                updateSubCategory() {
                    axios
                        .post('/admin/subcategory/update', this.update)
                        .then((res) => {
                            if (res.data.status) {
                                displaySuccess(res);
                                this.loadData();
                                $('#updateModal').modal('hide');
                                this.update = {};
                            } else {
                                displaySuccess(res);
                            }
                        })
                        .catch((err) => {
                            displayErrors(err);
                        });
                },
                deleteSubCategory() {
                    axios
                        .post('/admin/subcategory/delete', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                displaySuccess(res);
                                this.loadData();
                                $('#deleteModal').modal('hide');
                                this.del = {};
                            } else {
                                displaySuccess(res);
                            }
                        })
                        .catch((err) => {
                            displayErrors(err);
                        });
                },
                changeStatus(value) {
                    axios
                        .post('/admin/subcategory/change', value)
                        .then((res) => {
                            displaySuccess(res);
                            this.loadData();
                        })
                        .catch((err) => {
                            displayErrors(err);
                        });
                }
            }
        });
    </script>
@endsection
