<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <li class="menu-title"></li>
        <div class="separator">
            <div class="line"></div>
            <h6> پنل مدیریت </h6>
            <div class="line"></div>
        </div>
        @if(auth()->check())
            @foreach (config('panelConfig.menus') as $menu)
                <li>
                    <a href="{{ $menu['url'] }}">
                        <i class="mdi mdi-{{ $menu['icon'] }}"></i>
                        <span> {{ $menu['title'] }} </span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="separator">
    <div class="version-custom">
            <div class="line"></div>
            <h6>version:1 </h6>
            <div class="line"></div>
        </div>
    </div>

</div>
