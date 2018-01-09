<li class="dropdown top-nav__notifications">
    <a href="" data-toggle="dropdown" aria-expanded="false">
        <i class="zmdi zmdi-notifications"></i>
        <span class="badge" style="background-color: red; border-radius: 8px;">
            {{ count(auth()->user()->unreadNotifications) }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
        <div class="listview listview--hover">
            <div class="listview__header">
                Notifications
            </div>

            <div class="scroll-wrapper listview__scroll scrollbar-inner" style="position: relative;">
                <div class="listview__scroll scrollbar-inner scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 350px;">
                    @forelse( auth()->user()->unreadNotifications as $notif)
                        <a class="listview__item" data-link="{{ url($notif->data['url']) }}" data-id="{{ $notif->id }}" onclick="markRead(this)">
                            <div class="listview__content">
                                <div class="listview__heading">{{ $notif->data['user']['name'] }} <small>{{ $notif->data['time'] }} </small></div>
                                <font>{{ $notif->data['text'] }} </font>
                            </div>
                        </a>
                    @empty
                        <div class="listview__item">
                            <div class="listview__content">
                                <div class="listview__heading">Tidak Ada Notifikasi</div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="p-1"></div>
        </div>
    </div>
</li>
@push('body.script')
    <script>
        function markRead(a) {
            var id = a.getAttribute('data-id');
            var link = a.getAttribute('data-link');

            $.ajax({
                type:'get',
                url: window.baseUrl +'/notif/read/'+id,
                success : function(cek){
                    location.href= link;
                }
            });
        }
    </script>
@endpush