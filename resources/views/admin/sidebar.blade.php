<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="https://www.ubtuit.uz/img/tuit_logo.png" alt="Brand Logo" class="img-fluid">
              </span>
            <span class=" demo menu-text fw-bolder ms-2">BMI | Kurs ishi</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @if(isset($user))
            @if($selection_role == "academic_board")
                <li class="menu-item @if(request()->routeIs("sifat-bolimi-statistika")) active @endif">
                    <a href="{{route('sifat-bolimi-statistika')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-stats"></i>
                        <div data-i18n="Analytics">Statistika</div>
                    </a>
                </li>

                <li class="menu-item @if(request()->routeIs("deadline_themes.index")) active @endif">
                    <a href="{{route('deadline_themes.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-timer"></i>
                        <div data-i18n="Analytics">Mavzu vaqtlari</div>
                    </a>
                </li>
            @else
                @if($selection_role == "department")
                    <li class="menu-item @if(request()->routeIs("types.index")) active @endif ">
                        <a href="{{route('types.index')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Analytics">Ish turlari</div>
                        </a>
                    </li>
                    {{--                    <li class="menu-item @if(request()->routeIs("teachers.index")) active @endif ">--}}
                    {{--                        <a href="{{route('teachers.index')}}" class="menu-link">--}}
                    {{--                            <i class="menu-icon tf-icons bx bx-user"></i>--}}
                    {{--                            <div data-i18n="Analytics">O'qituvchilar</div>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li class="menu-item @if(request()->routeIs("statistics-teacher")) active @endif ">
                        <a href="{{route('statistics-teacher')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-chart"></i>
                            <div data-i18n="Analytics">Statistika O'qituvchilar</div>
                        </a>
                    </li>
                    <li class="menu-item @if(request()->routeIs("statistics-student")) active @endif ">
                        <a href="{{route('statistics-student')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-bar-chart-alt"></i>
                            <div data-i18n="Analytics">Statistika Talabalar</div>
                        </a>
                    </li>
                    <li class="menu-item @if(request()->routeIs("mudir-themes") && $status == 'new') active @endif ">
                        <a href="{{route('mudir-themes', ['status' => 'new'])}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book"></i>
                            <div data-i18n="Analytics">Mavzular</div>
                        </a>
                    </li>
                    <li class="menu-item @if(request()->routeIs("mudir-themes") && $status == 'process') active @endif ">
                        <a href="{{route('mudir-themes', ['status' => 'process'])}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book"></i>
                            <div data-i18n="Analytics">Tanlangan mavzular</div>
                        </a>
                    </li>
                    <li class="menu-item @if(request()->routeIs("mudir-themes") && $status == 'end') active @endif ">
                        <a href="{{route('mudir-themes', ['status' => 'end'])}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book"></i>
                            <div data-i18n="Analytics">Tugallangan mavzular</div>
                        </a>
                    </li>
                @else
                    @if($selection_role == "teacher")
                        <li class="menu-item @if(request()->routeIs("themes.index") && $options->status == "new") active @endif ">
                            <a href="{{route('themes.index', ['status' => 'new'])}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-book"></i>
                                <div data-i18n="Analytics">Mavzular</div>
                            </a>
                        </li>
                        <li class="menu-item @if(request()->routeIs("themes.index") && $options->status == "process") active @endif ">
                            <a href="{{route('themes.index', ['status' => 'process'])}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-book"></i>
                                <div data-i18n="Analytics">Tanlangan mavzular</div>
                            </a>
                        </li>
                        <li class="menu-item @if(request()->routeIs("themes.index") && $options->status == "end") active @endif ">
                            <a href="{{route('themes.index', ['status' => 'end'])}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-book"></i>
                                <div data-i18n="Analytics">Tugallangan mavzular</div>
                            </a>
                        </li>
                    @endif
                @endif
            @endif
        @endif
        @if($selection_role == 'student')
            <li class="menu-item @if(request()->routeIs("student-themes") && $status == 'new') active @endif ">
                <a href="{{route('student-themes', ['status' => 'new'])}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book"></i>
                    <div data-i18n="Analytics">Mavzular</div>
                </a>
            </li>
            <li class="menu-item @if(request()->routeIs("student-themes") && $status == 'process') active @endif ">
                <a href="{{route('student-themes', ['status' => 'process'])}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book"></i>
                    <div data-i18n="Analytics">Tanlangan mavzular</div>
                </a>
            </li>
            <li class="menu-item @if(request()->routeIs("student-themes") && $status == 'end') active @endif ">
                <a href="{{route('student-themes', ['status' => 'end'])}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book"></i>
                    <div data-i18n="Analytics">Tugallangan mavzular</div>
                </a>
            </li>
            <li class="menu-item @if(request()->routeIs("examples")) active @endif ">
                <a href="{{route('examples')}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Analytics">Namunalar</div>
                </a>
            </li>
{{--            <li class="menu-item @if(request()->routeIs("chat-student")) active @endif ">--}}
{{--                <a href="{{route('chat-student')}}" class="menu-link">--}}
{{--                    <i class="menu-icon tf-icons bx bx-chat"></i>--}}
{{--                    <div data-i18n="Analytics">Chat--}}
{{--                        @if(\App\Services\ThemeService::studentChatMessagesCount()!=0)--}}
{{--                            <span class="badge bg-danger "--}}
{{--                                  style="border-radius: 50%">{{\App\Services\ThemeService::studentChatMessagesCount()}} </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </li>--}}
        @endif
        {{--        @endif--}}
    </ul>
</aside>
