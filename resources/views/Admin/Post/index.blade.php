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
                                    <th>Số Điện Thoại - Zalo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, index) in list">
                                    <tr class="align-middle">
                                        <th class="text-center">@{{ index + 1 }}</th>
                                        <td class="text-wrap">@{{ value.title }}</td>
                                        <td class="text-end text-danger"><b>@{{ formatVND(value.price) }}</b></td>
                                        <td class="text-center text-success">@{{ value.area }} m²</td>
                                        <td class="text-wrap">@{{ value.address }}</td>
                                        <td class="text-center">@{{ value.phone }} / <a :href="value.zalo_link"
                                                target="_blank">Zalo</a></td>
                                        <td class="text-center align-middle">
                                            <button v-on:click="post_detail = Object.assign({}, value)"
                                                class="btn btn-sm btn-success text-white" data-bs-toggle="modal"
                                                data-bs-target="#postModal">
                                                Xem thêm
                                            </button>
                                            <button v-on:click="openUpdateModal(value)"
                                                class="btn btn-sm btn-primary text-white">
                                                Cập Nhật
                                            </button>
                                            <button v-on:click="del = Object.assign({}, value)"
                                                class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">
                                                Xóa
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
                            <div class="border border-primary rounded p-3 h-100">
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
                            <div class="border border-primary rounded p-3 h-100">
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

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content shadow">
                <div class="modal-header bg-primary ">
                    <h5 class="modal-title text-white" id="postModalLabel">
                        <i class="fas fa-file-alt me-2"></i> Cập Nhật Bài Viết @{{ update.title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Tiêu đề bài viết ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="update.title"
                                placeholder="VD: Bán đất nền 82m² đường Nguyễn Trãi">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Danh mục cha ( <span class="text-danger">*</span> )</label>
                            <select class="form-select" v-model="update.id_category"
                                v-on:change="loadDataSubCategoryPost($event)">
                                <option value="">-- Chọn danh mục cha --</option>
                                <template v-for='(value, index) in list_category'>
                                    <option :value="value.id">@{{ value.name }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Danh mục con ( <span class="text-danger">*</span> )</label>
                            <select class="form-select" v-model="update.id_subcategory" :disabled="!update.id_category">
                                <option value="">-- Chọn danh mục con --</option>
                                <template v-for='(value, index) in list_subcategory'>
                                    <option :value="value.id">@{{ value.name }}</option>
                                </template>
                            </select>
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Giá bán ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="update.price"
                                placeholder="VD: Thỏa thuận hoặc 3.xx">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Diện tích (m²) ( <span class="text-danger">*</span> )</label>
                            <input type="number" class="form-control" v-model="update.area" placeholder="VD: 82">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Phòng ngủ </label>
                            <input type="number" class="form-control" v-model="update.bedrooms">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Phòng vệ sinh</label>
                            <input type="number" class="form-control" v-model="update.bathrooms">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Địa chỉ cụ thể ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="update.address"
                                placeholder="VD: Số 9, đường Láng, Đống Đa">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Tên dự án</label>
                            <input type="text" class="form-control" v-model="update.project_name"
                                placeholder="VD: Khu đô thị mới Tây Hồ Tây">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Khu vực (Quận, Tỉnh/TP) ( <span class="text-danger">*</span>
                                )</label>
                            <input type="text" class="form-control" v-model="update.location"
                                placeholder="VD: Cầu Giấy, Hà Nội">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Link bản đồ (Google Maps) ( <span class="text-danger">*</span>
                                )</label>
                            <input type="url" class="form-control" placeholder="https://maps.google.com/..."
                                v-model="update.map_link">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Số điện thoại liên hệ ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" placeholder="VD: 0386 831 999"
                                v-model="update.phone">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Zalo liên hệ ( <span class="text-danger">*</span> )</label>
                            <input type="url" class="form-control" placeholder="https://zalo.me/0386831..."
                                v-model="update.zalo_link">
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Ảnh đại diện ( <span class="text-danger">*</span> )</label>
                            <input type="file" class="form-control" v-on:change="handleThumbnail($event)">
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="border rounded p-3 bg-light text-center mb-2">
                                <img :src="preview" alt="Chưa chọn ảnh" class="img-fluid rounded shadow-sm"
                                    style="max-height: 400px; object-fit: cover; width: 200px;">
                            </div>
                            <small class="text-muted fst-italic">
                                * Ảnh đại diện sẽ được hiển thị trên trang chủ và trong danh sách bài đăng. Vui lòng chọn
                                ảnh có kích thước phù hợp để hiển thị đẹp mắt.
                            </small>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Ảnh mô tả chi tiết</label>
                            <input type="file" class="form-control mb-3" multiple v-on:change="handleImages($event)">

                            <div class="row">
                                <div class="col-md-3 mb-3" v-for="(img, index) in update.images" :key="index">
                                    <div class="position-relative border rounded shadow-sm overflow-hidden">
                                        <img :src="img" class="img-fluid"
                                            style="height: 150px; object-fit: cover; width: 100%;">
                                        <button type="button"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle"
                                            v-on:click="removeImage(index)" title="Xóa ảnh">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label class="form-label">Nội dung chi tiết ( <span class="text-danger">*</span> )</label>
                            <textarea id="ckeditor-content" rows="5" class="form-control" v-model="update.content"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng
                    </button>
                    <button type="button" class="btn btn-primary" v-on:click="updatePost()">Cập Nhật
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Xác nhận xóa bài viết
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
                update: {},
                list_category: [],
                list_subcategory: [],
                preview: '',
            },
            mounted() {
                CKEDITOR.replace('ckeditor-content');
            },
            created() {
                this.loadData();
                this.loadDataCategory();
            },
            methods: {
                openUpdateModal(value) {
                    this.update = Object.assign({}, value);
                    this.preview = this.update.thumbnail || '';
                    const modal = new bootstrap.Modal(document.getElementById('updateModal'));
                    modal.show();
                    // 🟢 Load danh mục con tương ứng với danh mục cha đang có
                    if (this.update.id_category) {
                        axios
                            .post('/admin/subcategory/data-post', {
                                id_category: this.update.id_category
                            })
                            .then((res) => {
                                this.list_subcategory = res.data.data;

                                // 🔄 Sau khi có danh mục con, gán lại id_subcategory cũ
                                this.update.id_subcategory = value.id_subcategory;
                            });
                    }

                    this.$nextTick(() => {
                        if (CKEDITOR.instances['ckeditor-content']) {
                            CKEDITOR.instances['ckeditor-content'].setData(this.update.content || '');
                        }
                    });
                },
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
                updatePost() {
                    this.update.content = CKEDITOR.instances['ckeditor-content'].getData();
                    axios
                        .post('/admin/post/update', this.update)
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
                            $.each(err.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
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
                loadDataCategory() {
                    axios
                        .get('/admin/category/data-open')
                        .then((res) => {
                            this.list_category = res.data.data;
                        });
                },
                loadDataSubCategoryPost(e) {
                    var payload = {
                        id_category: e.target.value
                    }
                    axios
                        .post('/admin/subcategory/data-post', payload)
                        .then((res) => {
                            this.list_subcategory = res.data.data
                        });
                },
                handleThumbnail(e) {
                    var formData = new FormData();
                    formData.append('file', e.target.files[0]);
                    axios
                        .post('/admin/post/upload', formData)
                        .then((res) => {
                            this.preview = res.data.file;
                            this.update.thumbnail = res.data.file;
                            toastr.success(res.data.message, 'Success');
                        })
                        .catch((err) => {
                            $.each(err.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                handleImages(e) {
                    const files = e.target.files;
                    for (let i = 0; i < files.length; i++) {
                        let formData = new FormData();
                        formData.append('file', files[i]);
                        axios.post('/admin/post/upload', formData)
                            .then((res) => {
                                this.update.images.push(res.data.file); // Lưu đường dẫn ảnh vào mảng images
                                toastr.success(res.data.message, 'Success');
                            })
                            .catch((err) => {
                                displayErrors(err);
                            });
                    }
                },
                removeImage(index) {
                    this.update.images.splice(index, 1);
                },
            }
        });
    </script>
@endsection
