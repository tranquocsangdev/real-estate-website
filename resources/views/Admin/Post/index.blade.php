@extends('Admin.Layout.master')

@section('title', 'Bài đăng')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span class="mt-2">Danh sách bài đăng</span>
                        <a href="/admin/post/create" class="btn btn-primary">Thêm mới</a>
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
            data: {},
            created() {},
            methods: {}
        });
    </script>
@endsection
