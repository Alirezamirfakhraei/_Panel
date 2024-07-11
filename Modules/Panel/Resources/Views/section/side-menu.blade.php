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
                @php
                    $submenu = $menu['submenu'] ?? []; // Default to an empty array if 'submenu' is not set
                @endphp
                <li class="{{ is_array($submenu) && count($submenu) ? 'has-submenu' : '' }}">
                    <a href="{{ is_array($submenu) && count($submenu) ? '#' : $menu['url'] }}" class="{{ is_array($submenu) && count($submenu) ? 'dropdown-toggle' : '' }}" {{ is_array($submenu) && count($submenu) ? 'data-toggle=dropdown' : '' }}>
                        <i class="mdi mdi-{{ $menu['icon'] }}"></i>
                        <span> {{ $menu['title'] }} </span>
                        @if(is_array($submenu) && count($submenu))
                            <span class="menu-arrow"></span>
                        @endif
                    </a>
                    @if(is_array($submenu) && count($submenu))
                        <ul class="nav-second-level" aria-expanded="false">
                            @foreach ($submenu as $sub)
                                <li style="display: flex;justify-content: start;align-items: center">
                                    <i class="mdi mdi-{{ $sub['icon'] }}"></i>
                                    <a href="{{ $sub['url'] }}">{{ $sub['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
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
