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
                    <div class="row g-2 align-items-end mb-3">
                        <div class="col-lg-4">
                            <label class="form-label mb-1">Tìm kiếm</label>
                            <input type="text" class="form-control" v-model="filters.q"
                                placeholder="Nhập tiêu đề, địa chỉ, khu vực, số điện thoại..." v-on:keyup.enter="applyFilters()">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label mb-1">Danh mục cha</label>
                            <select class="form-select" v-model="filters.id_category">
                                <option value="">-- Tất cả --</option>
                                <template v-for="(c, i) in list_category" :key="i">
                                    <option :value="c.id">@{{ c.name }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label mb-1">Danh mục con</label>
                            <select class="form-select" v-model="filters.id_subcategory" :disabled="!filters.id_category">
                                <option value="">-- Tất cả --</option>
                                <template v-for="(s, i) in list_subcategory" :key="i">
                                    <option :value="s.id">@{{ s.name }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-lg-2 d-flex gap-2">
                            <button class="btn btn-primary w-100" v-on:click="applyFilters()">Lọc</button>
                            <button class="btn btn-outline-secondary w-100" v-on:click="resetFilters()">Reset</button>
                        </div>
                    </div>
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
                                        <th class="text-center align-middle">@{{ ((meta.current_page - 1) * meta.per_page) + index + 1 }}</th>
                                        <td class="text-nowrap">
                                            @{{ value.title }}
                                        </td>
                                        <td class="text-end text-danger"><b>@{{ formatVND(value.price) }}</b></td>
                                        <td class="text-center"><b>@{{ value.area }}</b> m <sup>2</sup></td>
                                        <td class="text-nowrap">@{{ value.address }}</td>
                                        <td class="text-center">@{{ value.phone }} / <a :href="value.zalo_link"
                                                target="_blank">Zalo</a></td>
                                        <td class="text-center align-middle">
                                            <button v-on:click="post_detail = Object.assign({}, value)"
                                                class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#postModal">
                                                <i class="fa-solid fa-eye me-0"></i>
                                            </button>
                                            <a :href="'/admin/post/update/' + value.id" class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-pen-to-square me-0"></i>
                                            </a>
                                            <button v-on:click="del = Object.assign({}, value)" class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                <i class="fa-solid fa-trash-can-arrow-up me-0"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3" v-if="meta.total">
                        <div class="text-muted">
                            Tổng: <b>@{{ meta.total }}</b> bài đăng
                        </div>
                        <nav aria-label="Pagination">
                            <ul class="pagination mb-0">
                                <li class="page-item" :class="{ disabled: meta.current_page <= 1 }">
                                    <a class="page-link" href="javascript:void(0)" v-on:click="goToPage(meta.current_page - 1)">«</a>
                                </li>
                                <template v-for="p in pagesToShow()" :key="p.key">
                                    <li class="page-item" v-if="p.type === 'page'" :class="{ active: p.page === meta.current_page }">
                                        <a class="page-link" href="javascript:void(0)" v-on:click="goToPage(p.page)">@{{ p.page }}</a>
                                    </li>
                                    <li class="page-item disabled" v-else>
                                        <span class="page-link">...</span>
                                    </li>
                                </template>
                                <li class="page-item" :class="{ disabled: meta.current_page >= meta.last_page }">
                                    <a class="page-link" href="javascript:void(0)" v-on:click="goToPage(meta.current_page + 1)">»</a>
                                </li>
                            </ul>
                        </nav>
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
                list_category: [],
                list_subcategory: [],
                filters: {
                    q: '',
                    id_category: '',
                    id_subcategory: '',
                },
                meta: {
                    current_page: 1,
                    last_page: 1,
                    per_page: 10,
                    total: 0,
                },
                post_detail: {
                    images: []
                },
                del: {},
            },
            created() {
                this.loadDataCategory();
                this.loadData(1);
            },
            watch: {
                'filters.id_category'(newVal) {
                    this.filters.id_subcategory = '';
                    this.list_subcategory = [];
                    if (!newVal) return;
                    axios
                        .post('/admin/subcategory/data-post', {
                            id_category: newVal
                        })
                        .then((res) => {
                            this.list_subcategory = res.data.data || [];
                        });
                }
            },
            methods: {
                loadDataCategory() {
                    axios
                        .get('/admin/category/data-open')
                        .then((res) => {
                            this.list_category = res.data.data || [];
                        });
                },
                loadData(page) {
                    axios
                        .post('/admin/post/data', {
                            page: page,
                            q: this.filters.q,
                            id_category: this.filters.id_category,
                            id_subcategory: this.filters.id_subcategory,
                        })
                        .then((res) => {
                            this.list = res.data.data || [];
                            this.meta = Object.assign(this.meta, res.data.meta || {});
                        })
                },
                applyFilters() {
                    this.loadData(1);
                },
                resetFilters() {
                    this.filters = {
                        q: '',
                        id_category: '',
                        id_subcategory: '',
                    };
                    this.list_subcategory = [];
                    this.loadData(1);
                },
                goToPage(page) {
                    if (!page || page < 1 || page > this.meta.last_page) return;
                    this.loadData(page);
                },
                pagesToShow() {
                    const current = this.meta.current_page || 1;
                    const last = this.meta.last_page || 1;
                    const windowSize = 2;
                    const pages = new Set([1, last]);
                    for (let p = current - windowSize; p <= current + windowSize; p++) {
                        if (p >= 1 && p <= last) pages.add(p);
                    }
                    const sorted = Array.from(pages).sort((a, b) => a - b);
                    const out = [];
                    let prev = null;
                    sorted.forEach((p) => {
                        if (prev !== null && p - prev > 1) {
                            out.push({ type: 'gap', key: `gap-${prev}-${p}` });
                        }
                        out.push({ type: 'page', page: p, key: `page-${p}` });
                        prev = p;
                    });
                    return out;
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
                                this.loadData(this.meta.current_page);
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
