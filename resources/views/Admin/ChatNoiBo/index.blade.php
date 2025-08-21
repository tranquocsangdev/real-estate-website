@extends('Admin.Layout.master')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
@section('content')
    <div class="container mt-4">
        <h4>Xin chào, {{ $adminLogin->name }} </h4>

        <div class="row" id="chat-app">
            <!-- Danh sách user -->
            <div class="col-4 border-end">
                <h5>Người dùng</h5>
                <ul class="list-group">
                    <li v-for="u in users" :key="u.id" @click="selectUser(u)" class="list-group-item"
                        style="cursor:pointer" :class="{ 'active': selectedUser && selectedUser.id === u.id }">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong class="me-2">@{{ u.name }}</strong>
                            <span v-if="u.unread_count && u.unread_count > 0" class="badge bg-danger rounded-pill">@{{ u.unread_count }}</span>
                        </div>
                        <div class="text-muted small text-truncate" style="max-width: 100%">
                            <span v-if="u.last_message_from_id == currentUserId">Bạn: </span>@{{ u.last_message || 'Chưa có tin nhắn' }}
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Chat box -->
            <div class="col-8 d-flex flex-column">
                <div class="d-flex align-items-center mb-2">
                    <h5 class="mb-0">@{{ selectedUser ? selectedUser.name : 'Chưa chọn' }}</h5>
                    <span v-if="selectedUser && selectedUser.unread_count > 0" class="badge bg-danger ms-2">@{{ selectedUser.unread_count }}</span>
                </div>

                <div class="border p-3 mb-2 flex-grow-1" style="height:300px;overflow-y:auto" ref="chatBox">
                    <div v-for="m in messages" :key="m.id" class="d-flex mb-2" :class="m.from_id == currentUserId ? 'justify-content-end' : 'justify-content-start'">
                        <div :class="m.from_id == currentUserId ? 'bg-primary text-white' : 'bg-light'" class="rounded px-2 py-1" style="max-width:70%">
                            <div class="mb-1">@{{ m.message }}</div>
                            <div class="text-end small" :class="m.from_id == currentUserId ? 'text-white-50' : 'text-muted'">
                                <span>@{{ (m.created_at || '').slice(11,16) }}</span>
                                <span v-if="m.from_id == currentUserId" class="ms-1">
                                    <span v-if="m.is_read">✔✔</span>
                                    <span v-else>✔</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <form @submit.prevent="sendMessage" v-if="selectedUser" class="mt-auto">
                    <div class="input-group">
                        <input type="text" v-model="newMessage" class="form-control" placeholder="Nhập tin nhắn...">
                        <button class="btn btn-primary" type="submit">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        new Vue({
            el: '#chat-app',
            data: {
                currentUserId: {{ $adminLogin->id }},
                users: [],
                selectedUser: null,
                messages: [],
                newMessage: ''
            },
            created() {
                this.loadUsers();
                this.initEcho();
            },
            methods: {
                loadUsers() {
                    axios
                        .post('/admin/admin/data-chat').then(res => {
                            this.users = res.data.data;
                        });
                },
                selectUser(user) {
                    this.selectedUser = user;
                    this.messages = [];
                    axios.get(`/messages/${this.currentUserId}/${user.id}`).then(res => {
                        this.messages = res.data.data;
                        this.scrollBottom();
                        // mark unread messages from selected user as read
                        axios.patch(`/messages/read-between/${user.id}/${this.currentUserId}`).then(() => {
                            const target = this.users.find(x => x.id === user.id);
                            if (target) target.unread_count = 0;
                        }).catch(() => {});
                    });
                },
                sendMessage() {
                    axios.post('/messages', {
                        from_id: this.currentUserId,
                        to_id: this.selectedUser.id,
                        message: this.newMessage
                    }).then(res => {
                        this.messages.push(res.data.data);
                        // Update preview for selected user on sender side
                        const u = this.users.find(x => x.id === this.selectedUser.id);
                        if (u) {
                            u.last_message = res.data.data.message;
                            u.last_message_from_id = res.data.data.from_id;
                            u.last_message_at = res.data.data.created_at;
                        }
                        this.newMessage = '';
                        this.scrollBottom();
                    });
                },
                initEcho() {
                    // Ensure global Pusher exists (provided by CDN script)
                    if (typeof window.Pusher === 'undefined' && typeof Pusher !== 'undefined') {
                        window.Pusher = Pusher;
                    }

                    const key = "{{ env('REVERB_APP_KEY') }}";
                    const host = "{{ env('REVERB_HOST') ?: request()->getHost() }}";
                    const port = Number("{{ env('REVERB_PORT', 6001) }}") || 6001;
                    const scheme = "{{ env('REVERB_SCHEME', 'http') }}";
                    const useTLS = scheme === 'https';

                    if (typeof window.Pusher === 'undefined') {
                        console.error('Pusher library is not loaded.');
                        return;
                    }

                    if (!window._pusher) {
                        @if (app()->environment('local'))
                        try { window.Pusher && (window.Pusher.logToConsole = true); } catch (e) {}
                        @endif
                        window._pusher = new window.Pusher(key, {
                            wsHost: host,
                            wsPort: port,
                            wssPort: port,
                            forceTLS: useTLS,
                            enabledTransports: ['ws', 'wss'],
                            cluster: 'mt1',
                            disableStats: true,
                        });
                    }

                    // Attach X-Socket-Id to axios for toOthers()
                    if (window.axios && window._pusher && window._pusher.connection) {
                        const bindSocketHeader = () => {
                            if (window._pusher && window._pusher.connection && window._pusher.connection.socket_id) {
                                window.axios.defaults.headers.common['X-Socket-Id'] = window._pusher.connection.socket_id;
                            }
                        };
                        window._pusher.connection.bind('connected', bindSocketHeader);
                        bindSocketHeader();
                    }

                    const channel = window._pusher.subscribe('chat');
                    const onMessage = (e) => {
                        console.debug('Message event:', e);
                        if (e.to_id == this.currentUserId) {
                            if (this.selectedUser && this.selectedUser.id == e.from_id) {
                                this.messages.push(e);
                                this.scrollBottom();
                                // mark single message as read when viewing this conversation
                                axios.patch(`/messages/${e.id}/read`).catch(() => {});
                            } else {
                                const u = this.users.find(x => x.id === e.from_id);
                                if (u) {
                                    u.unread_count = (u.unread_count || 0) + 1;
                                    u.last_message = e.message;
                                    u.last_message_from_id = e.from_id;
                                    u.last_message_at = e.created_at;
                                }
                            }
                        }
                    };
                    channel.bind('MessageSent', onMessage);
                    channel.bind('App\\\\Events\\\\MessageSent', onMessage);

                    const onRead = (e) => {
                        if (this.selectedUser) {
                            if (e.type === 'single') {
                                const msg = this.messages.find(m => m.id === e.id);
                                if (msg && msg.from_id == this.currentUserId) msg.is_read = true;
                            } else if (e.type === 'bulk') {
                                if (e.from_id == this.currentUserId && e.to_id == this.selectedUser.id) {
                                    this.messages.forEach(m => { if (m.from_id == this.currentUserId) m.is_read = true; });
                                }
                            }
                        }
                    };
                    channel.bind('MessageRead', onRead);
                    channel.bind('App\\\\Events\\\\MessageRead', onRead);
                },
                scrollBottom() {
                    this.$nextTick(() => {
                        this.$refs.chatBox.scrollTop = this.$refs.chatBox.scrollHeight;
                    });
                }
            }
        });
    </script>
@endsection
