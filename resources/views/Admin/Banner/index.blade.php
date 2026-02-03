@extends('Admin.Layout.master')
@section('title', 'Banner trang chủ')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mt-2 text-white text-uppercase">Thêm Ảnh Banner</h5>
                </div>
                <div class="card-body">
                    <div class="">
                        <input type="file" class="form-control" accept="image/*" ref="file"
                            v-on:change="handleBanner($event)">
                    </div>
                    <div class="mt-3">
                        <img v-if="preview" :src="preview" alt="Banner" class="img-fluid">
                        <div v-else class="border rounded d-flex flex-column justify-content-center align-items-center"
                            style="height: 220px; border-style: dashed; color: #999;">
                            <i class="fa-solid fa-image" style="font-size: 40px; margin-bottom: 8px;"></i>
                            <span>Chưa chọn hình ảnh</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <input type="number" class="form-control" v-model="create.order" placeholder="Thứ tự">
                        <small class="text-muted fst-italic d-block mt-2">
                            * Thứ tự sẽ được hiển thị theo thứ tự từ trên xuống dưới.
                        </small>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" v-on:click="createBanner()">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mt-2 text-white text-uppercase">Danh sách Ảnh Banner</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center text-uppercase">
                                <th>#</th>
                                <th>Hình ảnh</th>
                                <th>Thứ tự</th>
                                <th>Tình trạng</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="list.length == 0">
                                <tr>
                                    <td colspan="5" class="text-center p-5">
                                        <div
                                            class="d-flex flex-column justify-content-center align-items-center text-muted">
                                            <i class="fa-solid fa-image fa-2x mb-2"></i>
                                            <span>Chưa có banner nào. Vui lòng thêm banner mới.</span>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template v-for="(value, index) in list">
                                <tr>
                                    <th class="text-center align-middle">@{{ index + 1 }}</th>
                                    <td class="text-center">
                                        <img :src="value.image" alt="Banner" class="img-fluid"
                                            style="width: 300px; height: 100%; object-fit: cover;">
                                    </td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-primary">@{{ value.order }}</button>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-success text-white" v-if="value.status == 1"
                                            v-on:click="changeStatus(value)">Đang hoạt động</button>
                                        <button class="btn btn-danger text-white" v-else v-on:click="changeStatus(value)">Đã
                                            ẩn hiện</button>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-danger" v-on:click="del = Object.assign({}, value)"
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

        <!-- Modal Xóa banner-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white text-uppercase" id="exampleModalLabel">Xác nhận xóa banner có thứ tự
                            <b>@{{ del.order }}</b>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i> Cảnh báo!</strong> Bạn có chắc chắn muốn xóa
                            banner có thứ tự <b>@{{ del.order }}</b> này không?
                            <br>
                            <span>Hành động này <b>không thể hoàn tác</b>. Nếu bạn đồng ý, hãy nhấn <b>Xác nhận</b> bên
                                dưới.</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" v-on:click="deleteBanner()">Xác nhận</button>
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
                preview: '',
                update: {},
                del: {},
                create: {
                    order: 0,
                },
            },
            created() {
                this.loadData();
            },
            methods: {
                handleBanner(e) {
                    this.preview = URL.createObjectURL(e.target.files[0]);
                },
                loadData() {
                    axios
                        .post('/admin/banner/data')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                createBanner() {
                    if (!this.preview) {
                        toastr.error('Vui lòng chọn ảnh!', 'Error');
                        return;
                    }
                    if (!this.create.order) {
                        toastr.error('Vui lòng nhập thứ tự!', 'Error');
                        return;
                    }
                    var formData = new FormData();
                    formData.append('file', this.$refs.file.files[0]);
                    formData.append('order', this.create.order);
                    axios
                        .post('/admin/banner/create', formData)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                this.preview = '';
                                this.$refs.file.value = '';
                                this.create.order = 0;
                            } else {
                                toastr.error(res.data.message, 'Error');
                                this.preview = '';
                                this.$refs.file.value = '';
                                this.create.order = 0;
                            }
                        });
                },

                changeStatus(value) {
                    var payload = {
                        id: value.id
                    }
                    axios
                        .post('/admin/banner/change', payload)
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
                deleteBanner() {
                    axios
                        .post('/admin/banner/delete', this.del)
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
                }
            }
        });
    </script>
@endsection
