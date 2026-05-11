@extends('Admin.Layout.master')
@section('title', 'Blog')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h5 class="mt-2 text-white text-uppercase">Danh sách tin tức</h5>
                    <a href="/admin/blog/create">
                        <button class="btn btn-light" ref="createButton">Thêm mới</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center text-uppercase">
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Nội dung</th>
                                    <th>Ngày tạo</th>
                                    <th>Lượt xem</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, index) in list_blog">
                                    <tr class="align-middle">
                                        <th class="text-center">@{{ index + 1 }}</th>
                                        <td>@{{ value.title }}</td>
                                        <td class="text-center">
                                            <img :src="value.thumbnail" alt="Ảnh đại diện" class="img-fluid"
                                                style="width: 150px; height: 150px; object-fit: cover;">
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-sm" v-on:click="blog_detail = value"
                                                data-bs-toggle="modal" data-bs-target="#postModal">
                                                <i class="fa-solid fa-eye me-0"></i>
                                            </button>
                                        </td>
                                        <td class="text-center" v-html="date_format_full(value.created_at)"></td>
                                        <td class="text-center align-middle">@{{ value.views }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-sm text-white" v-if="value.status == 1">Đang
                                                hoạt
                                                động</button>
                                            <button class="btn btn-danger btn-sm text-white" v-else>Đã
                                                ẩn hiện</button>
                                        </td>
                                        <td class="text-center">
                                            <a :href="'/admin/blog/update/' + value.id" class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-pen-to-square me-0"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                v-on:click="del = Object.assign({}, value)" data-bs-toggle="modal"
                                                data-bs-target="#deleteBlogModal">
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

        <!-- Modal Xem Nội Dung-->
        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content shadow">
                    <div class="modal-header bg-primary ">
                        <h5 class="modal-title text-white text-uppercase" id="postModalLabel">
                            Chi tiết tin tức: @{{ blog_detail.title }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>

                    <div class="modal-body">
                        <span v-html="blog_detail.content"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xóa tin tức -->
    <div class="modal fade" id="deleteBlogModal" tabindex="-1" role="dialog" aria-labelledby="deleteBlogModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white text-uppercase" id="deleteBlogModalLabel">Xác nhận xóa tin tức
                        <b>@{{ del.title }}</b>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Cảnh báo!</strong> Bạn có chắc chắn muốn xóa
                        tin tức <b>@{{ del.title }}</b> không?
                        <br>
                        <span>Hành động này <b>không thể hoàn tác</b>. Nếu bạn đồng ý, hãy nhấn <b>Xác nhận</b> bên
                            dưới.</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="deleteBlog()">Xác nhận</button>
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
                list_blog: [],
                blog_detail: {},
                del: {},
            },
            mounted() {
                this.getDataBlog();
            },
            methods: {
                getDataBlog() {
                    axios
                        .post('/admin/blog/data')
                        .then((res) => {
                            this.list_blog = res.data.data;
                        })
                        .catch((err) => {
                            if (err.response && err.response.data && err.response.data.errors) {
                                $.each(err.response.data.errors, function(k, v) {
                                    toastr.error(v[0], 'Error');
                                });
                            }
                        });
                },
                deleteBlog() {
                    axios
                        .post('/admin/blog/delete', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.getDataBlog();
                                this.del = {};
                                $('#deleteBlogModal').modal('hide');
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((err) => {
                            if (err.response && err.response.data && err.response.data.errors) {
                                $.each(err.response.data.errors, function(k, v) {
                                    toastr.error(v[0], 'Error');
                                });
                            } else {
                                toastr.error('Không xóa được tin tức.', 'Error');
                            }
                        });
                },
            },
        });
    </script>
@endsection
