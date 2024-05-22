<nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar"
>
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- User -->

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="@if(!isset($data)) {{asset('user.jpg')}} @else {{$data->picture}}  @endif" alt
                             class="w-px-40 h-auto rounded-circle"/>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="@if(!isset($data)) {{asset('user.jpg')}} @else {{$data->picture}}  @endif"
                                             alt class="w-px-40 h-auto rounded-circle"/>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">
                                        @if(isset($data))
                                            {{$data->name}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>


                    @if(isset($user))
                        @if($data)
                            @foreach($data->roles as $item)
                                @if (in_array($item->code, ["academic_board", "department", "teacher"]))
                                    <li>
                                        <a class="dropdown-item @if($item->code == $user->selected_role) active @endif"
                                           href="{{route('insertRole', ['role' => $item->code])}}">
                                            <i class="bx bxs-user-account me-2"></i>
                                            <span class="align-middle">{{ $item->name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                            @if($user->selected_role != "student")
                                <hr>
                                <?php
                                if ($user->selected_role != "student")
                                    $teacher_department = App\Services\EmployeeService::getEmployeeIdForDepartment($data->employee_id_number);
                                ?>

                                @foreach($teacher_department as $item)
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{route('insertDepartment', ['department' => $item->department->id, 'role' => $item->staffPosition->code])}}">
                                            <i class="bx bxs-user-account me-2"></i>
                                            <span class="align-middle">{{ $item->department->name.'('.$item->staffPosition->name.')' }}</span>
                                        </a>
                                    </li>
                                @endforeach
                                <hr>
                            @endif
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{route('logout-student')}}">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Chiqish</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>