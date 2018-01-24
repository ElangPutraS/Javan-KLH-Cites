<li class="dropdown top-nav__notifications">
    <a href="" data-toggle="dropdown" aria-expanded="false">
        <i class="zmdi zmdi-notifications"></i>
        <span class="badge" id="jumlahNotif" style="background-color: red; border-radius: 8px;">
            {{ count(auth()->user()->unreadNotifications) }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
        <div class="listview listview--hover">
            <div class="listview__header">
                Notifications
                @if(count(auth()->user()->unreadNotifications) > 0)
                    <div class="actions">
                        <a onclick="markReadAll(this)" class="actions__item zmdi zmdi-check-all" data-ma-action="notifications-clear"></a>
                    </div>
                @endif
            </div>

            <div class="scroll-wrapper listview__scroll scrollbar-inner" style="position: relative;">
                <div class="listview__scroll scrollbar-inner scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 350px;">
                    @forelse( auth()->user()->unreadNotifications as $notif)
                        <a class="listview__item" data-link="{{ url($notif->data['url']) }}" data-id="{{ $notif->id }}" onclick="markRead(this)">
                            <div class="listview__content">
                                <div class="listview__heading"><b>{{ $notif->data['user']['name'] }} </b></div>
                                <font>{{ $notif->data['text'] }} </font><br>
                                <small> <i class="zmdi zmdi-time zmdi-hc-fw"></i> {{ $notif->data['time'] }} </small>
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

        function markReadAll(a) {
            $.ajax({
                type:'get',
                url: window.baseUrl +'/notif/readAll',
                success : function(cek){
                    $('#jumlahNotif').html('0');
                }
            });
        }
    </script>
@endpush