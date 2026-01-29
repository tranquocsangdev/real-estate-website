@extends('Admin.Layout.master')

@section('title', 'Cập nhật bài đăng')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mt-2">
                        <i class="fas fa-edit me-1"></i> Cập nhật bài đăng: @{{ update.title || 'Đang tải...' }}
                    </h5>
                    <a href="/admin/post" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Quay lại
                    </a>
                </div>

                <div class="card-body" v-if="loaded">
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
                            <label class="form-label">Giá bán ( <span class="text-danger">*</span> )<small
                                    class="text-muted fst-italic ms-2">
                                    @{{ update.price ? formatVietnameseMoney(update.price) : '' }}
                                </small></label>
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

                <div class="card-body text-center py-5" v-else>
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2 text-muted">Đang tải dữ liệu...</p>
                </div>

                <div class="card-footer" v-if="loaded">
                    <button type="button" class="btn btn-primary" v-on:click="updatePost()">
                        <i class="fas fa-save me-1"></i> Cập nhật
                    </button>
                    <a href="/admin/post" class="btn btn-secondary">Hủy</a>
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
                postId: {{ $id }},
                loaded: false,
                update: {
                    images: []
                },
                list_category: [],
                list_subcategory: [],
                preview: '',
            },
            created() {
                this.loadDataCategory();
                this.loadPost();
            },
            methods: {
                formatVietnameseMoney(number) {
                    if (!number || isNaN(number)) return '';
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
                loadPost() {
                    axios
                        .post('/admin/post/data')
                        .then((res) => {
                            const post = (res.data.data || []).find(p => Number(p.id) === Number(this.postId));
                            if (!post) {
                                toastr.error('Không tìm thấy bài viết.', 'Error');
                                setTimeout(() => { window.location.href = '/admin/post'; }, 1500);
                                return;
                            }
                            this.update = Object.assign({}, post);
                            if (!Array.isArray(this.update.images)) {
                                this.update.images = typeof this.update.images === 'string'
                                    ? (JSON.parse(this.update.images || '[]') || [])
                                    : [];
                            }
                            this.preview = this.update.thumbnail || '';
                            this.loaded = true;
                            if (this.update.id_category) {
                                axios
                                    .post('/admin/subcategory/data-post', { id_category: this.update.id_category })
                                    .then((r) => {
                                        this.list_subcategory = r.data.data || [];
                                    });
                            }
                            this.$nextTick(() => {
                                if (typeof CKEDITOR !== 'undefined') {
                                    if (!CKEDITOR.instances['ckeditor-content']) {
                                        CKEDITOR.replace('ckeditor-content');
                                    }
                                    CKEDITOR.instances['ckeditor-content'].setData(this.update.content || '');
                                }
                            });
                        })
                        .catch(() => {
                            toastr.error('Không tải được dữ liệu bài viết.', 'Error');
                            setTimeout(() => { window.location.href = '/admin/post'; }, 1500);
                        });
                },
                loadDataCategory() {
                    axios
                        .get('/admin/category/data-open')
                        .then((res) => {
                            this.list_category = res.data.data || [];
                        });
                },
                loadDataSubCategoryPost(e) {
                    const id_category = e.target.value;
                    axios
                        .post('/admin/subcategory/data-post', { id_category: id_category })
                        .then((res) => {
                            this.list_subcategory = res.data.data || [];
                        });
                },
                handleThumbnail(e) {
                    if (!e.target.files || !e.target.files[0]) return;
                    const formData = new FormData();
                    formData.append('file', e.target.files[0]);
                    axios
                        .post('/admin/post/upload', formData)
                        .then((res) => {
                            this.preview = res.data.file;
                            this.update.thumbnail = res.data.file;
                            toastr.success(res.data.message, 'Success');
                        })
                        .catch((err) => {
                            if (err.response && err.response.data && err.response.data.errors) {
                                Object.values(err.response.data.errors).forEach(msgs => msgs.forEach(m => toastr.error(m, 'Error')));
                            }
                        });
                },
                handleImages(e) {
                    const files = e.target.files;
                    if (!files || !files.length) return;
                    for (let i = 0; i < files.length; i++) {
                        const formData = new FormData();
                        formData.append('file', files[i]);
                        axios.post('/admin/post/upload', formData)
                            .then((res) => {
                                this.update.images.push(res.data.file);
                                toastr.success(res.data.message, 'Success');
                            })
                            .catch((err) => {
                                if (err.response && err.response.data && err.response.data.errors) {
                                    Object.values(err.response.data.errors).forEach(msgs => msgs.forEach(m => toastr.error(m, 'Error')));
                                }
                            });
                    }
                },
                removeImage(index) {
                    this.update.images.splice(index, 1);
                },
                updatePost() {
                    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['ckeditor-content']) {
                        this.update.content = CKEDITOR.instances['ckeditor-content'].getData();
                    }
                    axios
                        .post('/admin/post/update', this.update)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                window.location.href = '/admin/post';
                            } else {
                                toastr.error(res.data.message || 'Có lỗi xảy ra.', 'Error');
                            }
                        })
                        .catch((err) => {
                            if (err.response && err.response.data && err.response.data.errors) {
                                Object.values(err.response.data.errors).forEach(msgs => msgs.forEach(m => toastr.error(m, 'Error')));
                            } else {
                                toastr.error('Có lỗi xảy ra.', 'Error');
                            }
                        });
                },
            }
        });
    </script>
@endsection
