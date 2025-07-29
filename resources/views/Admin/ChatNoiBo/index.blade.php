@extends('Admin.Layout.master')

@section('content')
    <div class="container mt-4">
        <h4>Xin chào, {{ $adminLogin->name }} </h4>

        <div class="row" id="chat-app">
            <div class="col-4 border-end">
                <h5>Người dùng</h5>
                <ul class="list-group" id="user-list">
                    {{-- @foreach ($users as $user)
                        <li class="list-group-item user-item" data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                            style="cursor: pointer">
                            {{ $user->name }}
                        </li>
                    @endforeach --}}
                </ul>
            </div>

            <div class="col-8">
                <h5>Đoạn chat với: <span id="selected-user-name">Chưa chọn</span></h5>

                <div class="border p-2 mb-3" id="chat-messages" style="height: 300px; overflow-y: auto">
                </div>

                <form id="chat-form">
                    <div class="input-group">
                        <input type="text" id="message-input" class="form-control" placeholder="Nhập tin nhắn..." />
                        <button class="btn btn-primary" type="submit">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
