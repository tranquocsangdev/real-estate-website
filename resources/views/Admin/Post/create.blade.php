@extends('Admin.Layout.master')

@section('title', 'Thêm mới bài đăng')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mt-2 text-white text-uppercase">
                        Thêm mới bài đăng
                    </h5>
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
                            <select class="form-select" v-model="create.id_category">
                                <option value="" disabled>-- Vui lòng chọn danh mục cha --</option>
                                <template v-for='(value, index) in list_category'>
                                    <option :value="value.id">@{{ value.name }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Danh mục con ( <span class="text-danger">*</span> )</label>
                            <select class="form-select" v-model="create.id_subcategory" :disabled="!create.id_category">
                                <option value="" disabled>-- Vui lòng chọn danh mục con --</option>
                                <template v-for='(value, index) in list_subcategory'>
                                    <option :value="value.id">@{{ value.name }}</option>
                                </template>
                            </select>
                        </div>

                        <div class="col-lg-3 ">
                            <label class="form-label">
                                Giá bán ( <span class="text-danger">*</span> )
                                <small class="text-danger fst-italic ms-2">
                                    @{{ create.price ? formatVietnameseMoney(create.price) : '' }}
                                </small>
                            </label>

                            <input type="text" class="form-control" v-model="priceFormatted" v-on:input="formatPrice"
                                placeholder="Nhập giá bán (VD: 1.150.000.000)">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Diện tích (m <sup>2</sup>) ( <span class="text-danger">*</span>
                                )</label>
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
                            <label class="form-label">Tỉnh / Thành phố ( <span class="text-danger">*</span> )</label>
                            <select ref="selectTinh" class="form-select" autocomplete="address-level1">
                                <option value="">-- Chọn tỉnh thành --</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Xã / Phường ( <span class="text-danger">*</span> )</label>
                            <select ref="selectXa" class="form-select" autocomplete="address-level2">
                                <option value="">-- Chọn xã phường --</option>
                            </select>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Link bản đồ (Google Maps) ( <span class="text-danger">*</span>
                                )</label>
                            <input type="url" class="form-control" placeholder="https://maps.google.com/..."
                                v-model="create.map_link">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Số điện thoại liên hệ ( <span class="text-danger">*</span>
                                )</label>
                            <input type="text" class="form-control" placeholder="VD: 0386 831 999"
                                v-model="create.phone">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Zalo liên hệ ( <span class="text-danger">*</span> )</label>
                            <input type="url" class="form-control" placeholder="https://zalo.me/0386831..."
                                v-model="create.zalo_link">
                        </div>

                        <div class="col-lg-12 mb-3" v-if="contactSuggestions.length">
                            <label class="form-label mb-1">Gợi ý từ bài đã đăng</label>
                            <div class="text-muted small mb-2">
                                Chọn số đã dùng trước đây để điền nhanh SĐT và Zalo, hoặc nhập số mới ở trên.
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    v-for="(s, idx) in contactSuggestions" :key="idx"
                                    v-on:click="applyContactSuggestion(s)">
                                    @{{ s.phone }}
                                    <span class="badge bg-secondary ms-1" v-if="s.posts_count > 1">@{{ s.posts_count }}
                                        bài</span>
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-9 mb-3">
                            <label class="form-label">Ảnh đại diện ( <span class="text-danger">*</span> )</label>
                            <input type="file" class="form-control mb-1" v-on:change="handleThumbnail($event)">
                            <small class="text-muted fst-italic">
                                * Ảnh đại diện sẽ được hiển thị trên trang chủ và trong danh sách bài đăng. Vui lòng chọn
                                ảnh có kích thước phù hợp để hiển thị đẹp mắt.
                            </small>
                        </div>

                        <div class="col-lg-3 mb-3 mt-4">
                            <div v-if="preview" class="border rounded p-3 bg-light text-center mb-2">
                                <img :src="preview" alt="Ảnh xem trước" class="img-fluid rounded shadow-sm"
                                    style="max-height: 400px; object-fit: cover; width: 200px;">
                            </div>
                            <div v-else
                                class="border rounded p-3 bg-white text-center mb-2 d-flex flex-column justify-content-center align-items-center"
                                style="height: 220px; border-style: dashed; color: #999;">

                                <i class="bi bi-image" style="font-size: 40px; margin-bottom: 8px;"></i>
                                <span>Chưa chọn hình ảnh</span>
                            </div>


                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Ảnh chi tiết</label>
                            <input type="file" class="form-control mb-3" multiple v-on:change="handleImages($event)">

                            <div class="row">
                                <div class="col-md-3 mb-3" v-for="(img, index) in create.images" :key="index">
                                    <div class="position-relative border rounded shadow-sm overflow-hidden">
                                        <img :src="img" class="img-fluid"
                                            style="height: 400px; object-fit: cover; width: 100%;">
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
                            <label class="form-label">Nội dung chi tiết ( <span class="text-danger">*</span>
                                )</label>
                            <textarea id="ckeditor-content" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" :disabled="is_loading_create" v-on:click="createPost()">

                        <span v-if="is_loading_create">
                            <i class="fa fa-spinner fa-spin"></i> Đang xử lý...
                        </span>

                        <span v-else>
                            Thêm mới
                        </span>

                    </button>
                    <a href="/admin/post">
                        <button class="btn btn-secondary">
                            Hủy
                        </button>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                list_category: [],
                list_subcategory: [],
                list_tinh_thanh: [],
                contactSuggestions: [],
                priceFormatted: '',
                create: {
                    title: '',
                    slug: '',
                    content: '',
                    id_category: '',
                    id_subcategory: '',
                    id_tinh_thanh: '',
                    id_xa_phuong: '',
                    thumbnail: null,
                    price: '',
                    area: null,
                    bedrooms: null,
                    bathrooms: null,
                    address: '',
                    project_name: '',
                    phone: '',
                    zalo_link: '',
                    map_link: '',
                    images: []
                },
                preview: '',
                is_loading_create: false,
            },
            mounted() {
                tinymce.init({
                    selector: '#ckeditor-content',
                    height: 450,
                    menubar: true,
                    plugins: [
                        "advlist autolink lists link image charmap preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table paste help wordcount"
                    ],
                    toolbar: "undo redo | bold italic underline | \
                                          fontsizeselect formatselect | \
                                          alignleft aligncenter alignright alignjustify | \
                                          bullist numlist outdent indent | \
                                          forecolor backcolor | link image media | \
                                          removeformat | help",
                    content_style: "body { font-family:Arial,sans-serif; font-size:14px }"
                });
                this.loadTinhThanhForLocation().then(() => {
                    this.$nextTick(() => this.initTomLocationSelects());
                });
            },
            beforeDestroy() {
                this.destroyTomLocationSelects();
            },
            created() {
                this.loadDataCategory();
                this.loadContactSuggestions();
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
                    toastr.info('Đang tải lên ảnh đại diện...', 'Info');
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
                    toastr.info('Đang tải lên ảnh chi tiết...', 'Info');
                    for (let i = 0; i < files.length; i++) {
                        let formData = new FormData();
                        formData.append('file', files[i]);
                        axios
                            .post('/admin/post/upload', formData)
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
                loadTinhThanhForLocation() {
                    return axios
                        .get('/admin/dia-phan/tinh-thanh')
                        .then((res) => {
                            this.list_tinh_thanh = res.data.data || [];
                        });
                },
                destroyTomLocationSelects() {
                    if (this._tsTinh) {
                        this._tsTinh.destroy();
                        this._tsTinh = null;
                    }
                    if (this._tsXa) {
                        this._tsXa.destroy();
                        this._tsXa = null;
                    }
                },
                initTomLocationSelects() {
                    if (typeof TomSelect === 'undefined') return;
                    const self = this;
                    this.destroyTomLocationSelects();
                    const tinhOpts = (this.list_tinh_thanh || []).map((t) => ({
                        id: String(t.id),
                        name: t.name,
                    }));
                    this._tsTinh = new TomSelect(this.$refs.selectTinh, {
                        plugins: ['clear_button'],
                        maxOptions: 10000,
                        valueField: 'id',
                        labelField: 'name',
                        searchField: ['name'],
                        options: tinhOpts,
                        placeholder: 'Tìm và chọn tỉnh thành...',
                        onChange(val) {
                            self.create.id_tinh_thanh = val ? parseInt(val, 10) : '';
                            self.create.id_xa_phuong = '';
                            self.refreshTomXaOptions();
                        },
                    });
                    this._tsXa = new TomSelect(this.$refs.selectXa, {
                        plugins: ['clear_button'],
                        maxOptions: 20000,
                        valueField: 'id',
                        labelField: 'name',
                        searchField: ['name'],
                        options: [],
                        placeholder: 'Tìm và chọn xã phường...',
                        onChange(val) {
                            self.create.id_xa_phuong = val ? parseInt(val, 10) : '';
                        },
                    });
                },
                async refreshTomXaOptions() {
                    if (!this._tsXa) return;
                    this._tsXa.clear(true);
                    this._tsXa.clearOptions();
                    if (!this.create.id_tinh_thanh) return;
                    const res = await axios.get('/admin/dia-phan/xa-phuong', {
                        params: {
                            id_tinh_thanh: this.create.id_tinh_thanh
                        },
                    });
                    const rows = res.data.data || [];
                    rows.forEach((r) => this._tsXa.addOption({
                        id: String(r.id),
                        name: r.name,
                    }));
                    this._tsXa.refreshOptions(false);
                },
                loadContactSuggestions() {
                    axios
                        .get('/admin/post/contact-suggestions')
                        .then((res) => {
                            if (res.data.status) {
                                this.contactSuggestions = res.data.data || [];
                            }
                        })
                        .catch(() => {});
                },
                zaloLinkFromPhone(phone) {
                    const digits = String(phone || '').replace(/\D/g, '');
                    if (digits.length < 9) return '';
                    return 'https://zalo.me/' + digits;
                },
                applyContactSuggestion(s) {
                    this.create.phone = s.phone || '';
                    this.create.zalo_link = (s.zalo_link && String(s.zalo_link).trim()) ?
                        String(s.zalo_link).trim() :
                        this.zaloLinkFromPhone(s.phone);
                    toastr.info('Đã áp dụng số điện thoại & Zalo từ gợi ý.', 'Gợi ý');
                },
                removeImage(index) {
                    this.create.images.splice(index, 1);
                },
                createPost() {
                    this.is_loading_create = true;
                    this.create.content = tinymce.get('ckeditor-content').getContent();
                    axios
                        .post('/admin/post/create', this.create)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.create = {
                                    title: '',
                                    slug: '',
                                    content: '',
                                    id_category: '',
                                    id_subcategory: '',
                                    id_tinh_thanh: '',
                                    id_xa_phuong: '',
                                    thumbnail: null,
                                    price: '',
                                    area: null,
                                    bedrooms: null,
                                    bathrooms: null,
                                    address: '',
                                    project_name: '',
                                    phone: '',
                                    zalo_link: '',
                                    map_link: '',
                                    images: []
                                };
                                setTimeout(() => {
                                    window.location.href = '/admin/post';
                                }, 1000);
                            }
                        })
                        .catch((err) => {
                            $.each(err.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        })
                        .finally(() => {
                            this.is_loading_create = false;
                        });
                }
            }
        });
    </script>
@endsection
