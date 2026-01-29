@extends('Client.Layout.master')
@section('content')

    <h2 class="mt-5 mb-4 text-center text-md-start text-dark">Các Tin Đăng Mới Nhất</h2>

    <div class="row g-5" id="app">
        <template v-for="(value, index) in list_post">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow border-0 h-100 rounded-3">
                    <div class="position-relative">
                        <img v-bind:src="value.thumbnail" class="card-img-top rounded-top-3" alt="Ảnh lô đất">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-primary"> @{{ value.title }} </h5>
                        <p class="card-text text-muted small mb-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> @{{ value.address }}
                        </p>
                        <ul class="list-unstyled mb-3 small">
                            <li class="mb-1"><i class="bi bi-aspect-ratio-fill me-2 text-secondary"></i>Diện
                                tích: <span class="fw-bold">@{{ value.area }} m²</span></li>
                            <li><i class="bi bi-cash-stack me-2 text-secondary"></i>Giá bán: <span
                                    class="fw-bold text-danger">@{{ formatVND(value.price) }}</span></li>
                        </ul>

                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                            <a :href="value.map_link" class="btn btn-outline-secondary btn-sm"><i
                                    class="bi bi-map-fill"></i>
                                Xem Vị Trí</a>
                            <div>
                                <a href="#" class="btn btn-primary btn-sm me-2">Xem Chi Tiết</a>
                                <a class="btn btn-success btn-sm"><i class="bi bi-telephone-fill"></i>
                                    Gọi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                list_post: [],
            },
            created() {
                this.loadDataPostHome();
            },
            methods: {
                loadDataPostHome() {
                    axios
                        .get('/home/post/data')
                        .then((res) => {
                            this.list_post = res.data.data;
                        })
                },
                formatVND(number) {
                    return new Intl.NumberFormat("vi-VI", {
                        style: "currency",
                        currency: "VND"
                    }).format(
                        number,
                    )
                }
            }
        });
    </script>
@endsection
