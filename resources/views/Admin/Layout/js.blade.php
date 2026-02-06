  <script src="/assets_admin/js/bootstrap.bundle.min.js"></script>
  <script src="/assets_admin/js/jquery.min.js"></script>
  <script src="/assets_admin/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="/assets_admin/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="/assets_admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="/assets_admin/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="/assets_admin/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="/assets_admin/plugins/chartjs/js/Chart.min.js"></script>
  <script src="/assets_admin/plugins/chartjs/js/Chart.extension.js"></script>
  <script src="/assets_admin/js/index.js"></script>
  <script src="/assets_admin/js/app.js"></script>
  <script src="/assets_admin/js/general.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pako/2.1.0/pako.min.js"></script>
  <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
  <!-- Lightbox JS -->
  <script src="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/js/lightbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  {!! Toastr::message() !!}
  <script>
      $(document).ready(function() {
          new Vue({
              el: '#notification-app',
              data: {
                  list_notifications: [],
                  tong_thong_bao: 0,
                  isLoading: false,
              },
              created() {
                  this.loadDataNotifications();
              },
              mounted() {
                  const channel = window.Echo.channel('admin-notifications');
                  // event có thông báo mới
                  channel.listen('.admin.notification', (e) => {
                      this.loadDataNotifications();
                      toastr.info('Có thông báo mới 🔔');
                  });
                  // event đánh dấu đã đọc
                  channel.listen('.admin.notification.read', (e) => {
                      let item = this.list_notifications.find(n => n.id == e.id);
                      if (item && item.is_read == 0) {
                          item.is_read = 1;
                          this.tong_thong_bao--;
                      }
                  });
                  // event đánh dấu tất cả đã đọc
                  channel.listen('.admin.notification.readAll', (e) => {
                      this.loadDataNotifications();
                  });
              },
              methods: {
                  loadDataNotifications() {
                      this.isLoading = true;
                      axios
                          .get('/admin/notifications/data')
                          .then((res) => {
                              this.list_notifications = res.data.data;
                              this.tong_thong_bao = res.data.tong_thong_bao;
                          })
                          .catch((err) => {
                              $.each(err.response.data.errors, function(k, v) {
                                  toastr.error(v[0], 'Error');
                              });
                          })
                          .finally(() => {
                              this.isLoading = false;
                          });

                  },
                  markAsRead(value) {
                      if (value.is_read == 1) return;
                      axios
                          .post('/admin/notifications/read/' + value.id)
                  },
                  markAsReadAll() {
                      axios
                          .post('/admin/notifications/read-all');
                  }
              },
          });
      });
  </script>
  <style>
      .bg-unread {
          background-color: #f5e6d3;
          /* nâu nhạt */
      }

      .bg-unread:hover {
          background-color: #ead3b5;
      }
  </style>
