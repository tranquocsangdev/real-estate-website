@extends('Admin.Layout.master')

@section('title', 'Thêm Mới')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mt-2">
                        <i class="fas fa-plus-circle me-1"></i> Thêm bài đăng
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-bold">Tiêu đề bài viết ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="create.title"
                                placeholder="VD: Bán đất nền 82m² đường Nguyễn Trãi">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Danh mục cha ( <span class="text-danger">*</span> )</label>
                            <select class="form-select" v-model="create.id_category">
                                <option value="" disabled>-- Vui lòng chọn danh mục cha --</option>
                                <template v-for='(value, index) in list_category'>
                                    <option :value="value.id">@{{ value.name }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Danh mục con ( <span class="text-danger">*</span> )</label>
                            <select class="form-select" v-model="create.id_subcategory" :disabled="!create.id_category">
                                <option value="" disabled>-- Vui lòng chọn danh mục con --</option>
                                <template v-for='(value, index) in list_subcategory'>
                                    <option :value="value.id">@{{ value.name }}</option>
                                </template>
                            </select>
                        </div>

                        <div class="col-lg-3 ">
                            <label class="form-label fw-bold">
                                Giá bán ( <span class="text-danger">*</span> )
                                <small class="text-danger fst-italic ms-2">
                                    @{{ create.price ? formatVietnameseMoney(create.price) : '' }}
                                </small>
                            </label>

                            <input type="text" class="form-control" v-model="priceFormatted" v-on:input="formatPrice"
                                placeholder="Nhập giá bán (VD: 1.150.000.000)">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-bold">Diện tích (m²) ( <span class="text-danger">*</span> )</label>
                            <input type="number" class="form-control" v-model="create.area" placeholder="VD: 82">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-bold">Phòng ngủ </label>
                            <input type="number" class="form-control" v-model="create.bedrooms">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-bold">Phòng vệ sinh</label>
                            <input type="number" class="form-control" v-model="create.bathrooms">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Địa chỉ cụ thể ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="create.address"
                                placeholder="VD: Số 9, đường Láng, Đống Đa">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Tên dự án</label>
                            <input type="text" class="form-control" v-model="create.project_name"
                                placeholder="VD: Khu đô thị mới Tây Hồ Tây">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Khu vực (Quận, Tỉnh/TP) ( <span class="text-danger">*</span>
                                )</label>
                            <input type="text" class="form-control" v-model="create.location"
                                placeholder="VD: Cầu Giấy, Hà Nội">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Link bản đồ (Google Maps) ( <span class="text-danger">*</span>
                                )</label>
                            <input type="url" class="form-control" placeholder="https://maps.google.com/..."
                                v-model="create.map_link">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Số điện thoại liên hệ ( <span class="text-danger">*</span>
                                )</label>
                            <input type="text" class="form-control" placeholder="VD: 0386 831 999"
                                v-model="create.phone">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Zalo liên hệ ( <span class="text-danger">*</span> )</label>
                            <input type="url" class="form-control" placeholder="https://zalo.me/0386831..."
                                v-model="create.zalo_link">
                        </div>

                        <div class="col-lg-9 mb-3">
                            <label class="form-label fw-bold">Ảnh đại diện ( <span class="text-danger">*</span> )</label>
                            <input type="file" class="form-control mb-1" v-on:change="handleThumbnail($event)">
                            <small class="text-muted fst-italic">
                                * Ảnh đại diện sẽ được hiển thị trên trang chủ và trong danh sách bài đăng. Vui lòng chọn
                                ảnh có kích thước phù hợp để hiển thị đẹp mắt.
                            </small>
                        </div>

                        <div class="col-lg-3 mb-3 mt-4">
                            <!-- CÓ ẢNH -->
                            <div v-if="preview" class="border rounded p-3 bg-light text-center mb-2">
                                <img :src="preview" alt="Ảnh xem trước" class="img-fluid rounded shadow-sm"
                                    style="max-height: 400px; object-fit: cover; width: 200px;">
                            </div>

                            <!-- KHÔNG CÓ ẢNH -->
                            <div v-else
                                class="border rounded p-3 bg-white text-center mb-2 d-flex flex-column justify-content-center align-items-center"
                                style="height: 220px; border-style: dashed; color: #999;">

                                <i class="bi bi-image" style="font-size: 40px; margin-bottom: 8px;"></i>
                                <span>Chưa chọn hình ảnh</span>
                            </div>


                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-bold">Ảnh mô tả chi tiết</label>
                            <input type="file" class="form-control mb-3" multiple v-on:change="handleImages($event)">

                            <div class="row">
                                <div class="col-md-3 mb-3" v-for="(img, index) in create.images" :key="index">
                                    <div class="position-relative border rounded shadow-sm overflow-hidden">
                                        <img :src="img" class="img-fluid"
                                            style="height: 200px; object-fit: cover; width: 100%;">
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
                            <label class="form-label fw-bold">Nội dung chi tiết ( <span class="text-danger">*</span>
                                )</label>
                            <textarea id="ckeditor-content" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary mt-2 mb-2" v-on:click="createPost()">
                        <i class="fas fa-plus-circle me-1"></i>Thêm bài đăng
                    </button>
                    <button class="btn btn-secondary mt-2 mb-2">
                        <a href="/admin/post" class="text-white">
                            Hủy
                        </a>
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
                list_category: [],
                list_subcategory: [],
                priceFormatted: '',
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
                    zalo_link: 'https://zalo.me/0',
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
            watch: {
                'create.id_category'(newVal) {

                    this.create.id_subcategory = '';
                    this.list_subcategory = [];

                    if (!newVal) return;

                    axios
                        .post('/admin/subcategory/data-post', {
                            id_category: newVal
                        })
                        .then((res) => {
                            this.list_subcategory = res.data.data;
                        });
                }
            },
            methods: {
                formatVietnameseMoney(number) {
                    if (!number || isNaN(number)) return ''; // nếu người dùng xóa hết
                    const num = parseInt(number);

                    const ty = Math.floor(num / 1000000000);
                    const trieu = Math.floor((num % 1000000000) / 1000000);
                    const nghin = Math.floor((num % 1000000) / 1000);
                    let result = '';

                    if (ty > 0) result += `${ty} tỷ `;
                    if (trieu > 0) result += `${trieu} triệu `;
                    if (nghin > 0 && ty === 0 && trieu === 0) result += `${nghin} nghìn`;

                    return result.trim();
                },
                formatPrice() {
                    let raw = this.priceFormatted.replace(/\D/g, "");
                    this.priceFormatted = raw.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    this.create.price = raw ? Number(raw) : 0;
                },
                handleThumbnail(e) {
                    var formData = new FormData();
                    formData.append('file', e.target.files[0]);
                    axios
                        .post('/admin/post/upload', formData)
                        .then((res) => {
                            this.preview = res.data.file;
                            this.create.thumbnail = res.data.file;
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
                                this.create.images.push(res.data.file); // Lưu đường dẫn ảnh vào mảng images
                                displaySuccess(res, false);
                            })
                            .catch((err) => {
                                $.each(err.response.data.errors, function(k, v) {
                                    toastr.error(v[0], 'Error');
                                });
                            });
                    }
                },
                loadDataCategory() {
                    axios
                        .get('/admin/category/data-open')
                        .then((res) => {
                            this.list_category = res.data.data;
                        });
                },
                removeImage(index) {
                    this.create.images.splice(index, 1);
                },
                createPost() {
                    this.create.content = CKEDITOR.instances['ckeditor-content'].getData();
                    axios
                        .post('/admin/post/create', this.create)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.create = {
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
                                    window.location.href = '/admin/post';
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
