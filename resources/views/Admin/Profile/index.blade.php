@extends('Admin.Layout.master')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ $adminLogin->avatar }}" alt="Admin" class="rounded-circle p-1 bg-primary"
                                    width="110">
                                <div class="mt-3">
                                    <h4>{{ $adminLogin->name }}</h4>
                                    <p class="text-secondary mb-1">Admin</p>
                                    <span class="badge bg-success">Đang hoạt động</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <form action="/admin/profile/update" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $adminLogin->id }}">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Họ Tên</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $adminLogin->name }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $adminLogin->email }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Ảnh đại diện</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary">
                                        <input type="file" name="avatar_upload" class="form-control" accept="image/*"
                                            v-on:change="handleAvatar($event)" />

                                        <input type="hidden" name="avatar" :value="preview ? preview : currentAvatar">

                                        <small class="text-muted fst-italic d-block mt-2">
                                            * Ảnh đại diện sẽ được hiển thị là avatar của tài khoản.
                                        </small>


                                    </div>
                                    <div class="col-sm-3">
                                        <div class="col-lg-12 text-center">
                                            <div v-if="preview">
                                                <label class="form-label">Ảnh xem trước khi cập nhật</label>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <img :src="preview" class="img-fluid rounded-circle border"
                                                        style="width: 100px; height: 100px;" alt="Ảnh xem trước" />
                                                </div>
                                            </div>

                                            <div v-else>
                                                <label class="form-label">Ảnh hiện tại</label>

                                                <div v-if="currentAvatar"
                                                    class="d-flex justify-content-center align-items-center">
                                                    <img :src="currentAvatar" class="img-fluid rounded-circle border"
                                                        style="width: 100px; height: 100px;" alt="Ảnh hiện tại" />
                                                </div>

                                                <div v-else
                                                    class="d-flex flex-column justify-content-center align-items-center">
                                                    <i class="bi bi-image" style="font-size: 40px; margin-bottom: 8px;"></i>
                                                    <span>Chưa có ảnh</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-end">
                                        <button class="btn btn-primary" type="submit">Lưu Thông Tin</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
                currentAvatar: '{{ $adminLogin->avatar }}',
                preview: ''
            },
            created() {},
            methods: {
                handleAvatar(e) {
                    var formData = new FormData();
                    formData.append('file', e.target.files[0]);
                    axios
                        .post('/admin/admin/upload', formData)
                        .then((res) => {
                            this.preview = res.data.file;
                            toastr.success(res.data.message, 'Success');
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
            }
        });
    </script>
@endsection
