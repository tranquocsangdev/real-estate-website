@extends('Admin.Layout.master')

@section('title', 'Cập nhật tin tức')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mt-2 text-white text-uppercase">
                        Cập nhật tin tức
                    </h5>
                </div>
                <div class="card-body" v-if="loaded">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Tiêu đề tin tức ( <span class="text-danger">*</span> )</label>
                            <input type="text" class="form-control" v-model="update.title"
                                placeholder="VD: Pháp lý khi làm sổ đỏ tại Đà Nẵng - 2026">
                        </div>
                        <div class="col-lg-9 mb-3">
                            <label class="form-label">Ảnh đại diện</label>
                            <input type="file" class="form-control mb-1" v-on:change="handleThumbnail($event)"
                                ref="file">
                            <small class="text-muted fst-italic">
                                * Để trống nếu giữ nguyên ảnh hiện tại. Chọn ảnh mới nếu muốn thay đổi.
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
                                <span>Chưa có ảnh đại diện</span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label class="form-label">Nội dung chi tiết ( <span class="text-danger">*</span>
                                )</label>
                            <textarea id="ckeditor-content" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-body" v-else>
                    <p class="text-muted mb-0">Đang tải dữ liệu...</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" v-on:click="submitUpdate()" :disabled="!loaded">Cập nhật
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
        const BLOG_ID = {{ (int) $id }};

        new Vue({
            el: '#app',
            data: {
                update: {
                    id: null,
                    title: '',
                    content: '',
                    thumbnail: '',
                },
                preview: '',
                loaded: false,
            },
            mounted() {
                axios
                    .post('/admin/blog/detail', {
                        id: BLOG_ID
                    })
                    .then((res) => {
                        if (res.data.status) {
                            this.update = res.data.data;
                            this.preview = this.update.thumbnail || '';
                            this.loaded = true;
                            this.$nextTick(() => {
                                this.initTinyMCE();
                            });
                        } else {
                            toastr.error(res.data.message, 'Error');
                            setTimeout(() => {
                                window.location.href = '/admin/blog';
                            }, 1200);
                        }
                    })
                    .catch(() => {
                        toastr.error('Không tải được tin tức.', 'Error');
                        setTimeout(() => {
                            window.location.href = '/admin/blog';
                        }, 1200);
                    });
            },

            methods: {
                initTinyMCE() {
                    const self = this;
                    if (tinymce.get('ckeditor-content')) {
                        tinymce.remove('#ckeditor-content');
                    }
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
                        content_style: "body { font-family:Arial,sans-serif; font-size:14px }",
                        init_instance_callback: function(editor) {
                            editor.setContent(self.update.content || '');
                        },
                    });
                },
                handleThumbnail(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        return;
                    }
                    toastr.info('Đang tải lên ảnh đại diện...', 'Info');
                    setTimeout(() => {
                        this.preview = URL.createObjectURL(file);
                        if (this.preview) {
                            toastr.success('Ảnh đại diện đã chọn!', 'Success');
                        }
                    }, 300);
                },
                submitUpdate() {
                    const editor = tinymce.get('ckeditor-content');
                    if (!editor) {
                        toastr.error('Trình soạn thảo chưa sẵn sàng, vui lòng đợi hoặc tải lại trang.', 'Error');
                        return;
                    }
                    this.update.content = editor.getContent();
                    var formData = new FormData();
                    formData.append('id', this.update.id);
                    formData.append('title', this.update.title);
                    formData.append('content', this.update.content);
                    if (this.$refs.file && this.$refs.file.files[0]) {
                        formData.append('thumbnail', this.$refs.file.files[0]);
                    }
                    axios
                        .post('/admin/blog/update', formData)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                setTimeout(() => {
                                    window.location.href = '/admin/blog';
                                }, 800);
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((err) => {
                            if (err.response && err.response.data && err.response.data.errors) {
                                $.each(err.response.data.errors, function(k, v) {
                                    toastr.error(v[0], 'Error');
                                });
                            } else {
                                toastr.error('Có lỗi xảy ra.', 'Error');
                            }
                        });
                }
            }
        });
    </script>
@endsection
