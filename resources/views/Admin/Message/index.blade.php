@extends('Admin.Layout.master')
@section('title', 'Chat Management')
@section('content')
    <div class="container-fluid">
        <div class="row" style="min-height: 75vh;">
            <!-- Sidebar trái -->
            <div class="col-md-3 d-flex flex-column">
                <div class="card d-flex flex-column border-right" style="min-height: 75vh;">
                    <div class="card-header" style="margin-top: 10px;">
                        <h5>CHAT</h5>
                    </div>
                    <div style="overflow: hidden; height: 500px;"
                        class="list-group list-group-flush overflow-auto flex-grow-1 p-3">
                        <template v-for="(v, k) in list_admin">
                            <a class="list-group-item list-group-item-action d-flex align-items-center"
                                v-on:click="openChat(v)">
                                <img :src="v.avatar" class="rounded-circle" alt="user"
                                    style="width: 40px; height: 40px; margin-right: 10px;">
                                <div>
                                    <div class="font-weight-bold">@{{ v.name }}</div>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Khung chat chính -->
            <div class="col-md-9 d-flex flex-column">
                <div class="card d-flex flex-column" style="min-height: 75vh;">
                    <!-- Header chat -->
                    <template v-if="message.id">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img :src="message.avatar" class="rounded-circle mr-2" alt="user"
                                    style="width: 40px; height: 40px; margin-right: 10px;">
                                <div>
                                    <strong>@{{ message.ten_nguoi_nhan }}</strong><br>
                                    <small class="text-muted"><i class="fas fa-circle text-success"></i> Đang hoạt
                                        động</small>
                                </div>
                            </div>

                            <div>
                                <button class="btn btn-light btn-sm"><i class="fas fa-phone text-primary"></i></button>
                                <button class="btn btn-light btn-sm"><i class="fas fa-video text-primary"></i></button>
                                <button class="btn btn-light btn-sm"><i
                                        class="fas fa-info-circle text-primary"></i></button>
                            </div>
                        </div>
                    </template>

                    <!-- Nếu chưa chọn người chat -->
                    <template v-if="!message.id">
                        <div class="card-body d-flex align-items-center justify-content-center flex-grow-1 text-muted"
                            style="min-height: 430px;">
                            👉 Vui lòng chọn người để bắt đầu trò chuyện
                        </div>
                    </template>

                    <!-- Nếu đã chọn -->
                    <template v-else>
                        <div id="chatBody" ref="chatBody"
                            class="card-body overflow-auto flex-grow-1 chat-messages-scroll p-3"
                            style="min-height: 430px; max-height: 590px;">
                            <template v-for="(v, k) in list_conversation">
                                <!-- Người nhận -->
                                <div v-if="message.id != v.to_id" class="d-flex align-items-end mb-3">
                                    <img :src="v.avatar" class="rounded-circle mr-2" alt="user"
                                        style="width: 35px; height: 35px; margin-right: 10px;">
                                    <div class="max-width-70">
                                        <div class="bg-dark text-white p-3 rounded chat-message-other">
                                            @{{ v.message }}
                                        </div>
                                        <small class="text-muted ml-2">@{{ dateFomat(v.created_at) }}</small>
                                    </div>
                                </div>

                                <!-- Người gửi -->
                                <div v-else class="d-flex align-items-end justify-content-end mb-3">
                                    <div class="max-width-70 text-right">
                                        <div class="bg-primary text-white p-3 rounded chat-message-mine">
                                            @{{ v.message }}
                                        </div>
                                        <div class="d-flex justify-content-between w-100">
                                            <small class="text-muted">@{{ dateFomat(v.created_at) }}</small>
                                            <small v-if="v.is_read == 0" class="text-secondary"> Đã gửi</small>
                                            <small v-if="v.is_read == 2" class="text-primary"> Đã nhận</small>
                                            <small v-if="v.is_read == 1" class="text-success"> Đã xem</small>
                                        </div>
                                    </div>
                                    <img :src="v.avatar" class="rounded-circle ml-2" alt="me"
                                        style="width: 35px; height: 35px; margin-left: 10px;">
                                </div>
                            </template>
                        </div>

                        <!-- Footer chỉ hiện khi đã chọn -->
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <div class="input-group">
                                <input type="text" class="form-control" v-on:keyup.enter="sendMessage()"
                                    v-model="message.noi_dung"
                                    :placeholder="'Nhập tin nhắn để gửi cho ' + message.ten_nguoi_nhan">

                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" v-on:click="sendMessage()">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </template>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            new Vue({
                el: '#app',
                data: {
                    list_admin: [],
                    message: {},
                    list_conversation: [],
                    currentUserId: {{ $adminLogin->id }},
                },

                created() {
                    this.loadDataAdminMessage();
                    window.Echo.channel('chat')
                        .listen('.MessageSentEvent', (data) => {
                            console.log("Realtime nhận tin:", data);
                            if (data.from_id == this.currentUserId) {
                                return;
                            }
                            this.list_conversation.push(data);
                            this.$nextTick(() => {
                                this.scrollToBottom();
                            });
                        });
                },

                methods: {
                    dateFomat(now) {
                        // return moment().utc().format('Y-MM-DD HH:mm:ss');
                        return moment().utc().format('HH:mm:ss');
                    },
                    loadDataAdminMessage() {
                        axios
                            .get('/admin/message/user')
                            .then((res) => {
                                this.list_admin = res.data.data;
                                displaySuccess(res, false);
                            })
                    },
                    openChat(payload) {
                        this.message = {
                            id: payload.id,
                            ten_nguoi_nhan: payload.name,
                            avatar: payload.avatar
                        };
                        axios
                            .post('/admin/conversation/data', payload)
                            .then((res) => {
                                this.list_conversation = res.data.data;
                                this.$nextTick(() => {
                                    this.scrollToBottom();
                                });
                            });
                    },
                    sendMessage() {
                        axios
                            .post('/admin/message/send', this.message)
                            .then((res) => {
                                this.openChat(this.message);
                                this.message.noi_dung = '';
                            });
                    },
                    scrollToBottom() {
                        const chatBody = this.$refs.chatBody;
                        chatBody.scrollTop = chatBody.scrollHeight;
                    }

                }
            });
        })
    </script>

@endsection
