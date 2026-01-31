@extends('Admin.Layout.master')

@section('title', 'Bài đăng')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h5 class="mt-2 text-white text-uppercase">Danh sách bài đăng</h5>
                    <a href="/admin/post/create">
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createModal">
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="">
                                <tr class="text-center text-uppercase">
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Giá</th>
                                    <th>Diện tích</th>
                                    <th>Địa chỉ</th>
                                    <th>Số Điện Thoại - Zalo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, index) in list">
                                    <tr class="align-middle">
                                        <th class="text-center">@{{ index + 1 }}</th>
                                        <td class="text-nowrap">
                                            @{{ value.title }}
                                        </td>
                                        <td class="text-end text-danger"><b>@{{ formatVND(value.price) }}</b></td>
                                        <td class="text-center"><b>@{{ value.area }}</b> m <sup>2</sup></td>
                                        <td class="text-nowrap">@{{ value.address }}</td>
                                        <td class="text-center">@{{ value.phone }} / <a :href="value.zalo_link"
                                                target="_blank">Zalo</a></td>
                                        <td class="text-center">
                                            <button v-on:click="post_detail = Object.assign({}, value)"
                                                class="btn btn-success" data-bs-toggle="modal" data-bs-target="#postModal">
                                                <i class="fa-solid fa-eye ms-1"></i>
                                            </button>
                                            <a :href="'/admin/post/update/' + value.id" class="btn btn-primary">
                                                <i class="fa-solid fa-pencil ms-1"></i>
                                            </a>
                                            <button v-on:click="del = Object.assign({}, value)" class="btn btn-danger"
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

    <!-- Modal Chi tiết bài viết-->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content shadow">
                <div class="modal-header bg-primary ">
                    <h5 class="modal-title text-white text-uppercase" id="postModalLabel">
                        Chi tiết bài đăng: @{{ post_detail.title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-heading ms-1"></i> Tiêu đề:</strong> @{{ post_detail.title }}</li>
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-money-bill ms-1"></i> Giá bán:</strong> <b class="text-danger">@{{ formatVND(post_detail.price) }}</b></li>
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-square ms-1"></i> Diện tích:</strong> <b>@{{ post_detail.area }}</b> m <sup>2</sup></li>
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-bed ms-1"></i> Phòng ngủ:</strong> @{{ post_detail.bedrooms || 'Không có' }}</li>
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-bath ms-1"></i> Phòng vệ sinh:</strong> @{{ post_detail.bathrooms || 'Không có' }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-location-dot ms-1"></i> Địa chỉ:</strong> @{{ post_detail.address }}</li>
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-location-dot ms-1"></i> Khu vực:</strong> @{{ post_detail.location }}</li>
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-location-dot ms-1"></i> Dự án:</strong> @{{ post_detail.project_name || 'Không có' }}</li>
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-phone ms-1"></i> Số điện thoại:</strong> @{{ post_detail.phone }} - <b> Zalo</b>: <a :href="post_detail.zalo_link" target="_blank">Tại đây</a></li>
                                    <li class="list-group-item"><strong> <i class="fa-solid fa-map-location-dot ms-1"></i> Link bản đồ:</strong>
                                        <a :href="post_detail.map_link" target="_blank">Xem bản đồ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12" v-if="post_detail.thumbnail">
                            <h6 class="text-secondary fw-bold">Ảnh đại diện</h6>
                            <a :href="post_detail.thumbnail" data-lightbox="post-thumbnail" data-title="Ảnh đại diện">
                                <img :src="post_detail.thumbnail" class="img-fluid rounded border shadow-sm mb-3"
                                    style="max-height: 300px; cursor: zoom-in;" alt="Ảnh đại diện">
                            </a>
                        </div>

                        <div class="col-12" v-if="post_detail.images && post_detail.images.length">
                            <h6 class="text-secondary fw-bold">Ảnh chi tiết</h6>
                            <div class="row">
                                <div class="col-md-3 mb-3" v-for="(img, i) in post_detail.images" :key="i">
                                    <a :href="img" data-lightbox="post-images" :data-title="'Ảnh ' + (i + 1)">
                                        <img :src="img" class="img-thumbnail"
                                            style="height: 350px; object-fit: cover; width: 100%;">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h6 class="text-secondary fw-bold">Nội dung chi tiết</h6>
                            <div class="border p-3 rounded bg-light" v-html="post_detail.content"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xóa bài viết-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white text-uppercase" id="exampleModalLabel">Xác nhận xóa bài viết
                        <b>@{{ del.title }}</b>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Cảnh báo!</strong> Bạn có chắc chắn muốn xóa
                        bài viết <b>@{{ del.title }}</b> này không?
                        <br>
                        <span>Hành động này <b>không thể hoàn tác</b>. Nếu bạn đồng ý, hãy nhấn <b>Xác nhận</b> bên
                            dưới.</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="deletePost()">Xác nhận</button>
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
                post_detail: {
                    images: []
                },
                del: {},
            },
            created() {
                this.loadData();
            },
            methods: {
                loadData() {
                    axios
                        .post('/admin/post/data')
                        .then((res) => {
                            this.list = res.data.data;
                        })
                },
                formatVND(number) {
                    return new Intl.NumberFormat("vi-VI", {
                        style: "currency",
                        currency: "VND"
                    }).format(
                        number,
                    )
                },
                deletePost() {
                    axios
                        .post('/admin/post/delete', this.del)
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
            }
        });
    </script>
@endsection
