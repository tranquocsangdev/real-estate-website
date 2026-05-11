@extends('Admin.Layout.master')

@section('title', 'Cập nhật bài đăng')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mt-2"> Cập nhật bài đăng: @{{ update.title || 'Đang tải...' }}
                    </h5>
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
                                    class="text-danger fst-italic ms-2">
                                    @{{ update.price ? formatVietnameseMoney(update.price) : '' }}
                                </small></label>
                            <input type="text" class="form-control" v-model="priceFormatted" v-on:input="formatPrice"
                                placeholder="Nhập giá bán (VD: 1.150.000.000)">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Diện tích (m <sup>2</sup>) ( <span class="text-danger">*</span>
                                )</label>
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
                                    <span class="badge bg-secondary ms-1" v-if="s.posts_count > 1">@{{ s.posts_count }} bài</span>
                                </button>
                            </div>
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
                    <button class="btn btn-primary" :disabled="is_loading_update" v-on:click="updatePost()">

                        <span v-if="is_loading_update">
                            <i class="fa fa-spinner fa-spin"></i> Đang cập nhật...
                        </span>

                        <span v-else>
                            Cập nhật
                        </span>

                    </button>
                    <a href="/admin/post" class="btn btn-secondary">Hủy</a>
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
                postId: {{ $id }},
                loaded: false,
                update: {
                    images: []
                },
                list_category: [],
                list_subcategory: [],
                list_tinh_thanh: [],
                contactSuggestions: [],
                preview: '',
                priceFormatted: '',
                is_loading_update: false,
                _tsTinh: null,
                _tsXa: null,
            },
            beforeDestroy() {
                this.destroyTomLocationSelects();
            },
            created() {
                this.loadDataCategory();
                this.loadContactSuggestions();
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
                formatNumberWithDots(num) {
                    if (num == null || num === '') return '';
                    const raw = String(num).replace(/\D/g, '');
                    return raw.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                },
                formatPrice() {
                    let raw = this.priceFormatted.replace(/\D/g, '');
                    this.priceFormatted = raw.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    this.update.price = raw ? Number(raw) : 0;
                },
                loadPost() {
                    axios
                        .post('/admin/post/detail', {
                            id: this.postId
                        })
                        .then((res) => {
                            if (!res.data.status) {
                                toastr.error(res.data.message || 'Không tìm thấy bài viết.', 'Error');
                                setTimeout(() => {
                                    window.location.href = '/admin/post';
                                }, 1500);
                                return;
                            }

                            const post = res.data.data;
                            this.update = Object.assign({}, post);
                            if (!Array.isArray(this.update.images)) {
                                this.update.images = typeof this.update.images === 'string' ?
                                    (JSON.parse(this.update.images || '[]') || []) : [];
                            }
                            this.preview = this.update.thumbnail || '';
                            this.priceFormatted = this.formatNumberWithDots(this.update.price);
                            this.update.id_tinh_thanh = this.update.id_tinh_thanh ?
                                parseInt(this.update.id_tinh_thanh, 10) : '';
                            this.update.id_xa_phuong = this.update.id_xa_phuong ?
                                parseInt(this.update.id_xa_phuong, 10) : '';
                            this.loaded = true;

                            if (this.update.id_category) {
                                axios
                                    .post('/admin/subcategory/data-post', {
                                        id_category: this.update.id_category
                                    })
                                    .then((r) => {
                                        this.list_subcategory = r.data.data || [];
                                    });
                            }

                            this.$nextTick(async () => {
                                if (typeof tinymce !== 'undefined') {
                                    if (!tinymce.get('ckeditor-content')) {
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
                                        tinymce.get('ckeditor-content').setContent(this.update
                                            .content || '');
                                    } else {
                                        tinymce.get('ckeditor-content').setContent(this.update
                                            .content || '');
                                    }
                                }
                                await this.initTomLocationAfterLoad();
                            });
                        })
                        .catch(() => {
                            toastr.error('Không tải được dữ liệu bài viết.', 'Error');
                            setTimeout(() => {
                                window.location.href = '/admin/post';
                            }, 1500);
                        });
                },
                loadDataCategory() {
                    axios
                        .get('/admin/category/data-open')
                        .then((res) => {
                            this.list_category = res.data.data || [];
                        });
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
                async refreshTomXaOptionsUpdate() {
                    if (!this._tsXa) return;
                    this._tsXa.clear(true);
                    this._tsXa.clearOptions();
                    if (!this.update.id_tinh_thanh) return;
                    const res = await axios.get('/admin/dia-phan/xa-phuong', {
                        params: {
                            id_tinh_thanh: this.update.id_tinh_thanh
                        },
                    });
                    (res.data.data || []).forEach((r) => this._tsXa.addOption({
                        id: String(r.id),
                        name: r.name,
                    }));
                    this._tsXa.refreshOptions(false);
                },
                async initTomLocationAfterLoad() {
                    if (typeof TomSelect === 'undefined') return;
                    await this.loadTinhThanhForLocation();
                    await this.$nextTick();
                    this.destroyTomLocationSelects();
                    await this.$nextTick();
                    const self = this;
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
                            self.update.id_tinh_thanh = val ? parseInt(val, 10) : '';
                            self.update.id_xa_phuong = '';
                            self.refreshTomXaOptionsUpdate();
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
                            self.update.id_xa_phuong = val ? parseInt(val, 10) : '';
                        },
                    });
                    if (this.update.id_tinh_thanh) {
                        this._tsTinh.setValue(String(this.update.id_tinh_thanh), true);
                        await this.refreshTomXaOptionsUpdate();
                        if (this.update.id_xa_phuong) {
                            this._tsXa.setValue(String(this.update.id_xa_phuong), true);
                        }
                    }
                },
                zaloLinkFromPhone(phone) {
                    const digits = String(phone || '').replace(/\D/g, '');
                    if (digits.length < 9) return '';
                    return 'https://zalo.me/' + digits;
                },
                applyContactSuggestion(s) {
                    this.update.phone = s.phone || '';
                    this.update.zalo_link = (s.zalo_link && String(s.zalo_link).trim())
                        ? String(s.zalo_link).trim()
                        : this.zaloLinkFromPhone(s.phone);
                    toastr.info('Đã áp dụng số điện thoại & Zalo từ gợi ý.', 'Gợi ý');
                },
                loadDataSubCategoryPost(e) {
                    const id_category = e.target.value;
                    axios
                        .post('/admin/subcategory/data-post', {
                            id_category: id_category
                        })
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
                                Object.values(err.response.data.errors).forEach(msgs => msgs.forEach(m => toastr
                                    .error(m, 'Error')));
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
                                    Object.values(err.response.data.errors).forEach(msgs => msgs.forEach(m =>
                                        toastr.error(m, 'Error')));
                                }
                            });
                    }
                },
                removeImage(index) {
                    this.update.images.splice(index, 1);
                },
                updatePost() {
                    this.is_loading_update = true;
                    if (typeof tinymce !== 'undefined' && tinymce.get('ckeditor-content')) {
                        this.update.content = tinymce.get('ckeditor-content').getContent();
                    }
                    axios
                        .post('/admin/post/update', this.update)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                setTimeout(() => {
                                    window.location.href = '/admin/post';
                                }, 1000);
                            } else {
                                toastr.error(res.data.message || 'Có lỗi xảy ra.', 'Error');
                            }
                        })
                        .catch((err) => {
                            if (err.response && err.response.data && err.response.data.errors) {
                                Object.values(err.response.data.errors).forEach(msgs => msgs.forEach(m => toastr
                                    .error(m, 'Error')));
                            } else {
                                toastr.error('Có lỗi xảy ra.', 'Error');
                            }
                        })
                        .finally(() => {
                            this.is_loading_update = false;

                        });
                },
            }
        });
    </script>
@endsection
