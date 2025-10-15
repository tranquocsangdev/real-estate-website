@extends('Admin.Layout.master')

@section('title', 'Danh Mục Cha')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">Thêm mới danh mục</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label class="">Tên danh mục</label>
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
                    <button class="btn btn-primary btn-sm" v-on:click="createCategory()">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mb-0 text-white">Danh sách danh mục</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
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
                        <label class="">Tên danh mục</label>
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
                    <button type="button" class="btn btn-primary" v-on:click="updateCategory()">Xác nhận</button>
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
                    <h5 class="modal-title text-white" id="exampleModalLabel">Xác nhận xóa danh mục
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
                    <button type="button" class="btn btn-primary" v-on:click="deleteCategory()">Xác nhận</button>
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
                            displaySuccess(res, false);
                        })
                },
                createCategory() {
                    axios
                        .post('/admin/category/create', this.create)
                        .then((res) => {
                            displaySuccess(res);
                            this.loadData();
                            this.create = {};
                        })
                        .catch((err) => {
                            displayErrors(err);
                        });
                },
                updateCategory() {
                    axios
                        .post('/admin/category/update', this.update)
                        .then((res) => {
                            if (res.data.status) {
                                displaySuccess(res);
                                this.loadData();
                                this.update = {};
                                $('#updateModal').modal('hide');
                            } else {
                                displaySuccess(res);
                            }
                        })
                        .catch((err) => {
                            displayErrors(err);
                        });
                },
                deleteCategory() {
                    axios
                        .post('/admin/category/delete', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                displaySuccess(res);
                                this.loadData();
                                this.del = {};
                                $('#deleteModal').modal('hide');
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
                        .post('/admin/category/change', value)
                        .then((res) => {
                            displaySuccess(res);
                            this.loadData();
                        })
                        .catch((err) => {
                            displayErrors(err);
                        });
                },
                date_format(now) {
                    return moment(now).format('DD/MM/yyyy');
                },
                number_format(number, decimals = 2, dec_point = ",", thousands_sep = ".") {
                    var n = number,
                        c = isNaN((decimals = Math.abs(decimals))) ? 2 : decimals;
                    var d = dec_point == undefined ? "," : dec_point;
                    var t = thousands_sep == undefined ? "." : thousands_sep,
                        s = n < 0 ? "-" : "";
                    var i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
                        j = (j = i.length) > 3 ? j % 3 : 0;

                    return (s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (
                        c ? d +
                        Math.abs(n - i)
                        .toFixed(c)
                        .slice(2) :
                        ""));
                },
            }
        });
    </script>
@endsection
