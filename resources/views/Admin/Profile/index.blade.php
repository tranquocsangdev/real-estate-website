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
                                    <p class="text-secondary mb-1">Full Stack Developer</p>
                                    <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                                    <button class="btn btn-primary">Follow</button>
                                    <button class="btn btn-outline-primary">Message</button>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-instagram me-2 icon-inline text-danger">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                            </rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>Instagram</h6>
                                    <span class="text-secondary">codervent</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-facebook me-2 icon-inline text-primary">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                            </path>
                                        </svg>Facebook</h6>
                                    <span class="text-secondary">codervent</span>
                                </li>
                            </ul>
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
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" name="avatar_upload" class="form-control" accept="image/*"
                                            v-on:change="handleAvatar($event)" />

                                        <input type="hidden" name="avatar" :value="preview">

                                        <small class="text-muted fst-italic d-block mt-2">
                                            * Ảnh đại diện sẽ được hiển thị là avatar của tài khoản.
                                        </small>

                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <label>Ảnh mới được tải lên</label>
                                                <div class="mt-3 d-flex justify-content-center align-items-center">
                                                    <img :src="preview" class="img-fluid rounded-circle border"
                                                        style="width: 100px; height: 100px;" alt="Chưa tải ảnh lên" />
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
                preview: '{{ $adminLogin->avatar }}'
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
                            displaySuccess(res);
                        })
                        .catch((err) => {
                            displayErrors(err);
                        });
                },
            }
        });
    </script>
@endsection
