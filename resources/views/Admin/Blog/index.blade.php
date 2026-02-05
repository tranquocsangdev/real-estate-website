@extends('Admin.Layout.master')
@section('title', 'Blog')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h5 class="mt-2 text-white text-uppercase">Danh sách tin tức</h5>
                    <a href="/admin/blog/create">
                        <button class="btn btn-light">Thêm mới</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center text-uppercase">
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục cha - Danh mục con</th>
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
                                        <td>@{{ value.category_name }} - @{{ value.subcategory_name }}</td>
                                        <td>
                                            <img :src="value.thumbnail" alt="Ảnh đại diện" class="img-fluid"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-success" v-on:click="blog_detail = value"
                                            data-bs-toggle="modal" data-bs-target="#postModal">
                                                <i class="fa-solid fa-eye ms-1"></i>
                                            </button>
                                        </td>
                                        <td v-html="date_format_full(value.created_at)"></td>
                                        <td class="text-center">@{{ value.views }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-success text-white" v-if="value.status == 1">Đang hoạt
                                                động</button>
                                            <button class="btn btn-danger text-white" v-else>Đã
                                                ẩn hiện</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary">
                                                <i class="fa-solid fa-pencil ms-1"></i>
                                            </button>
                                            <button class="btn btn-danger">
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
</div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                list_blog: [],
                blog_detail : {}
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
                            $.each(err.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
            },
        });
    </script>
@endsection
