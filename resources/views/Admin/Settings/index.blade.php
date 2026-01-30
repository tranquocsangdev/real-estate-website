@extends('Admin.Layout.master')

@section('title', 'Cấu hình website')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mt-2 text-white text-uppercase">Cấu hình website</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" v-on:click="updateSettings()">Lưu thông tin</button>
                    <a href="/admin/settings"><button class="btn btn-secondary">Hủy</button></a>
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

            },
            created() {},
            methods: {}
        });
    </script>
