@extends('Admin.Layout.master')

@section('title', 'Thêm mới tin tức')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mt-2 text-white text-uppercase">
                        Thêm mới tin tức
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Tiêu đề tin tức ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="create.title" placeholder="VD: Pháp lý khi làm sổ đỏ tại Đà Nẵng - 2026">
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

                        <div class="col-lg-9 mb-3">
                            <label class="form-label">Ảnh đại diện ( <span class="text-danger">*</span> )</label>
                            <input type="file" class="form-control mb-1" v-on:change="handleThumbnail($event)"
                                ref="file">
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
                                <span>Chưa chọn ảnh đại diện</span>
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
                    <button class="btn btn-primary" v-on:click="createBlog()">Thêm mới
                    </button>
                    <button class="btn btn-secondary">
                        <a href="/admin/blog" class="text-white">Hủy
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
                create: {
                    title: '',
                    content: '',
                    id_category: '',
                    id_subcategory: '',
                },
                preview: '',
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
                      fullscreen | removeformat | help",
                    content_style: "body { font-family:Arial,sans-serif; font-size:14px }"
                });
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
                handleThumbnail(e) {
                    toastr.info('Đang tải lên ảnh đại diện...', 'Info');
                    setTimeout(() => {
                        this.preview = URL.createObjectURL(e.target.files[0]);
                        if (this.preview) {
                            toastr.success('Ảnh đại diện đã tải lên thành công!', 'Success');
                        } else {
                            toastr.error('Vui lòng chọn ảnh!', 'Error');
                            return;
                        }
                    }, 1000);
                },
                loadDataCategory() {
                    axios
                        .get('/admin/category/data-open')
                        .then((res) => {
                            this.list_category = res.data.data;
                        });
                },
                createBlog() {
                    this.create.content = tinymce.get('ckeditor-content').getContent();
                    var formData = new FormData();
                    formData.append('title', this.create.title);
                    formData.append('content', this.create.content);
                    formData.append('id_category', this.create.id_category);
                    formData.append('id_subcategory', this.create.id_subcategory);
                    formData.append('thumbnail', this.$refs.file.files[0]);
                    axios
                        .post('/admin/blog/create', formData)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.create = {
                                    title: '',
                                    content: '',
                                    id_category: '',
                                    id_subcategory: '',
                                };
                                this.preview = '';
                                this.$refs.file.value = '';
                                setTimeout(() => {
                                    window.location.href = '/admin/blog';
                                }, 1000);
                            } else {
                                toastr.error(res.data.message, 'Error');
                                this.create = {
                                        title: '',
                                        content: '',
                                        id_category: '',
                                        id_subcategory: '',
                                    },
                                    this.preview = '';
                                this.$refs.file.value = '';
                            }
                        });
                }
            }
        });
    </script>
@endsection
