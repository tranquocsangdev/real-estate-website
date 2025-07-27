@extends('Admin.Layout.master')

@section('title', 'Bài đăng')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white">Danh sách bài đăng</h5>
                    <a href="/admin/post/create">
                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fa-solid fa-plus"></i> Thêm mới
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Giá</th>
                                    <th>Diện tích</th>
                                    <th>Địa chỉ</th>
                                    <th>Điện thoại</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, index) in list">
                                    <tr class="align-middle">
                                        <th class="text-center">@{{ index + 1 }}</th>
                                        <td>@{{ value.title }}</td>
                                        <td class="text-end"><b>@{{ formatVND(value.price) }}</b></td>
                                        <td class="text-center">@{{ value.area }} m²</td>
                                        <td>@{{ value.address }}</td>
                                        <td class="text-center">@{{ value.phone }}</td>
                                        <td class="text-center">
                                            <button v-on:click="post_detail = Object.assign({}, value)"
                                                class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                                data-bs-target="#postModal">
                                                Xem
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

    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content shadow">
                <div class="modal-header bg-primary ">
                    <h5 class="modal-title text-white" id="postModalLabel">
                        <i class="fas fa-file-alt me-2"></i> Chi tiết bài đăng: @{{ post_detail.title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Thông tin cơ bản -->
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h6 class="text-secondary fw-bold mb-3">Thông tin cơ bản</h6>
                                <p><strong>Tiêu đề:</strong> @{{ post_detail.title }}</p>
                                <p><strong>Giá bán:</strong> <b>@{{ formatVND(post_detail.price) }}</b></p>
                                <p><strong>Diện tích:</strong> @{{ post_detail.area }} m²</p>
                                <p><strong>Phòng ngủ:</strong> @{{ post_detail.bedrooms }}</p>
                                <p><strong>Phòng vệ sinh:</strong> @{{ post_detail.bathrooms }}</p>
                            </div>
                        </div>

                        <!-- Thông tin địa điểm & liên hệ -->
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h6 class="text-secondary fw-bold mb-3">Vị trí & Liên hệ</h6>
                                <p><strong>Địa chỉ:</strong> @{{ post_detail.address }}</p>
                                <p><strong>Khu vực:</strong> @{{ post_detail.location }}</p>
                                <p><strong>Dự án:</strong> @{{ post_detail.project_name }}</p>
                                <p><i class="fas fa-phone-alt me-1 text-primary"></i> @{{ post_detail.phone }}</p>
                                <p>
                                    <i class="fas fa-map-marker-alt me-1 text-danger"></i>
                                    <a :href="post_detail.map_link" target="_blank">Xem bản đồ</a>
                                </p>
                                <p>
                                    <i class="fab fa-zalo me-1 text-info"></i>
                                    <a :href="post_detail.zalo_link" target="_blank">Liên hệ Zalo</a>
                                </p>
                            </div>
                        </div>

                        <!-- Ảnh đại diện -->
                        <div class="col-12" v-if="post_detail.thumbnail">
                            <h6 class="text-secondary fw-bold">Ảnh đại diện</h6>
                            <a :href="post_detail.thumbnail" data-lightbox="post-thumbnail" data-title="Ảnh đại diện">
                                <img :src="post_detail.thumbnail" class="img-fluid rounded border shadow-sm mb-3"
                                    style="max-height: 300px; cursor: zoom-in;" alt="Ảnh đại diện">
                            </a>
                        </div>

                        <!-- Ảnh mô tả -->
                        <div class="col-12" v-if="post_detail.images && post_detail.images.length">
                            <h6 class="text-secondary fw-bold">Ảnh mô tả</h6>
                            <div class="row">
                                <div class="col-md-3 mb-3" v-for="(img, i) in post_detail.images" :key="i">
                                    <a :href="img" data-lightbox="post-images" :data-title="'Ảnh ' + (i + 1)">
                                        <img :src="img" class="img-thumbnail"
                                            style="height: 150px; object-fit: cover; width: 100%;">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Nội dung mô tả -->
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
                            displaySuccess(res, false);
                        })
                },
                formatVND(number) {
                    return new Intl.NumberFormat("vi-VI", {
                        style: "currency",
                        currency: "VND"
                    }).format(
                        number,
                    )
                }
            }
        });
    </script>
@endsection
