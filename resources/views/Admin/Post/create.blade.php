@extends('Admin.Layout.master')

@section('title', 'Thêm Mới')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-1"></i> Thêm bài đăng
                    </h5>
                    <a href="/admin/post" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Trở lại
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Tiêu đề bài viết ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="create.title"
                                placeholder="VD: Bán đất nền 82m² đường Nguyễn Trãi">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Danh mục cha ( <span class="text-danger">*</span> )</label>
                            <select class="form-select">
                                <option selected>-- Chọn danh mục cha --</option>
                                <template v-for='(value, index) in list_category'>
                                    <option :value="value.id">@{{ value.name }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Danh mục con ( <span class="text-danger">*</span> )</label>
                            <select class="form-select">
                                <option selected>-- Chọn danh mục con --</option>
                                <template v-for='(value, index) in list_category'>
                                    <option :value="value.id">@{{ value.name }}</option>
                                </template>
                            </select>
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Giá bán ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="create.price"
                                placeholder="VD: Thỏa thuận hoặc 3.xx">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Diện tích (m²) ( <span class="text-danger">*</span> )</label>
                            <input type="number" class="form-control" v-model="create.area" placeholder="VD: 82">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Phòng ngủ </label>
                            <input type="number" class="form-control" v-model="create.bedrooms">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Phòng vệ sinh</label>
                            <input type="number" class="form-control" v-model="create.bathrooms">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Địa chỉ cụ thể ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="create.address"
                                placeholder="VD: Số 9, đường Láng, Đống Đa">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Tên dự án</label>
                            <input type="text" class="form-control" v-model="create.project_name"
                                placeholder="VD: Khu đô thị mới Tây Hồ Tây">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Khu vực (Quận, Tỉnh/TP) ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="create.location"
                                placeholder="VD: Cầu Giấy, Hà Nội">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Link bản đồ (Google Maps) ( <span class="text-danger">*</span>
                                )</label>
                            <input type="url" class="form-control" placeholder="https://maps.google.com/..."
                                v-model="create.map_link">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Số điện thoại liên hệ ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" placeholder="VD: 0386 831 999"
                                v-model="create.phone">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Zalo liên hệ ( <span class="text-danger">*</span> )</label>
                            <input type="url" class="form-control" placeholder="https://zalo.me/0386831..."
                                v-model="create.zalo_link">
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
                                <div class="col-md-3 mb-3" v-for="(img, index) in create.images" :key="index">
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
                            <textarea id="ckeditor-content" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" v-on:click="createPost()">Thêm bài đăng</button>
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
                list_category: [],
                create: {
                    title: '',
                    slug: '',
                    content: '',
                    id_client: 1,
                    id_category: '',
                    id_subcategory: '',
                    thumbnail: null,
                    price: '',
                    area: null,
                    bedrooms: null,
                    bathrooms: null,
                    location: '',
                    address: '',
                    project_name: '',
                    phone: '',
                    zalo_link: '',
                    map_link: '',
                    images: []
                },
                preview: '',
            },
            mounted() {
                CKEDITOR.replace('ckeditor-content');
            },
            created() {
                this.loadDataCategory();
            },
            methods: {
                handleThumbnail(e) {
                    var formData = new FormData();
                    formData.append('file', e.target.files[0]);
                    axios
                        .post('/admin/post/upload', formData)
                        .then((res) => {
                            this.preview = res.data.file;
                            this.create.thumbnail = res.data.file;
                            displaySuccess(res, false);
                        })
                        .catch((err) => {
                            displayErrors(err);
                        });
                },
                handleImages(e) {
                    const files = e.target.files;
                    for (let i = 0; i < files.length; i++) {
                        let formData = new FormData();
                        formData.append('file', files[i]);
                        axios.post('/admin/post/upload', formData)
                            .then((res) => {
                                this.create.images.push(res.data.file); // Lưu đường dẫn ảnh vào mảng images
                                displaySuccess(res, false);
                            })
                            .catch((err) => {
                                displayErrors(err);
                            });
                    }
                },
                loadDataCategory() {
                    axios
                        .get('/admin/category/data-open')
                        .then((res) => {
                            this.list_category = res.data.data;
                            displaySuccess(res, false);
                        });
                },
                removeImage(index) {
                    this.create.images.splice(index, 1);
                },
                createPost() {
                    this.create.content = CKEDITOR.instances['ckeditor-content'].getData();
                    axios
                        .post('/admin/post/create', this.create)
                        .then((res) => {})
                        .catch((err) => {
                            displayErrors(err);
                        });
                }
            }
        });
    </script>
@endsection
