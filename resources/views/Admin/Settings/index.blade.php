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
                    <form id="form-settings">
                        @csrf
                        @php
                            $groupLabels = [
                                'info' => 'Thông tin chung',
                                'contact' => 'Liên hệ',
                                'social' => 'Mạng xã hội',
                                'seo' => 'SEO',
                                'system' => 'Hệ thống',
                            ];
                            $keyLabels = [
                                'phone' => 'Số điện thoại',
                                'site_name' => 'Tên website',
                                'address' => 'Địa chỉ',
                                'working_time' => 'Giờ làm việc',
                                'email' => 'Email',
                                'facebook' => 'Facebook',
                                'zalo' => 'Zalo',
                                'gmail' => 'Gmail',
                                'meta_title' => 'Meta title',
                                'meta_description' => 'Meta description',
                                'meta_keywords' => 'Meta keywords',
                                'logo' => 'Logo (URL)',
                                'favicon' => 'Favicon (URL)',
                            ];
                            $grouped = $settings->groupBy('group');
                        @endphp
                        @foreach($grouped as $group => $items)
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2 text-primary">{{ $groupLabels[$group] ?? $group }}</h6>
                                <div class="row">
                                    @foreach($items as $item)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ $keyLabels[$item->key] ?? $item->key }}</label>
                                            @if($item->type === 'textarea')
                                                <textarea name="{{ $item->key }}" class="form-control" rows="3">{{ old($item->key, $item->value) }}</textarea>
                                            @else
                                                <input type="{{ $item->type === 'url' ? 'url' : ($item->type === 'email' ? 'email' : 'text') }}" name="{{ $item->key }}" class="form-control" value="{{ old($item->key, $item->value) }}">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-primary" id="btn-save-settings">Lưu thông tin</button>
                    <a href="/admin/settings"><button type="button" class="btn btn-secondary">Hủy</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('btn-save-settings').addEventListener('click', function() {
            const btn = this;
            const form = document.getElementById('form-settings');
            const formData = new FormData(form);
            btn.disabled = true;
            btn.textContent = 'Đang lưu...';
            fetch('/admin/settings/update', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    if (typeof toastr !== 'undefined') toastr.success(data.message || 'Đã lưu cài đặt.');
                    else alert(data.message || 'Đã lưu cài đặt.');
                } else {
                    if (typeof toastr !== 'undefined') toastr.error(data.message || 'Có lỗi xảy ra.');
                    else alert(data.message || 'Có lỗi xảy ra.');
                }
            })
            .catch(() => {
                if (typeof toastr !== 'undefined') toastr.error('Có lỗi xảy ra.');
                else alert('Có lỗi xảy ra.');
            })
            .finally(() => {
                btn.disabled = false;
                btn.textContent = 'Lưu thông tin';
            });
        });
    </script>
@endsection
