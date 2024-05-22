@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-2 p-2" style="box-shadow: 0px 0px 5px 5px rgba(194,215,236,0.63)">
                <div class="card-header">
                    <h1 class="text float-start">Mavzular ro'yhati</h1>
                    @if(json_decode(\Illuminate\Support\Facades\Auth::user()->data)->type == 'employee')
                        <a href="{{ route('themes.create') }}" class="btn btn-success float-end ">
                            <i class="bx bx-plus"></i> Qo'shish
                        </a>

                        <button data-bs-toggle="modal" data-bs-target="#FilterModal"
                                type="button" class="btn btn-primary float-end">
                            <i class="bx bx-filter-alt"></i>
                            Filtr
                        </button>
                    @endif
                </div>
            </div>

            @foreach($themes as $key => $value)
                <div class="card m-2 p-2" style="box-shadow: 0px 0px 5px 5px rgba(194,215,236,0.63)">
                    <div class="card-header">
                        <h1 class="text float-start">{{ $types[$key]->name }}</h1>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table overflow-auto">
                            <tr>
                                <th>Amallar</th>
                                <th class="col-8">Mavzu</th>
                            </tr>
                            @foreach($value as $theme)
                                <?php
                                $theme_group = $theme->group->toArray();
                                $now_date = strtotime(date('Y-m-d', strtotime(now())));
                                $select_end_date = \App\Services\DeadlineThemeService::deadline($theme->type_id, $theme->date);
                                ?>
                                <tr class="align-items-center">
                                    <td class="">
                                        <table>
                                            <tr>
                                                <td>
                                                    <button data-bs-toggle="modal"
                                                            data-bs-target="#batafsilModal{{$theme->id}}"
                                                            type="button"
                                                            class="btn btn-outline-dark">Batafsil
                                                    </button>
                                                </td>
                                                @if($theme->student_id == 0)
                                                    <td>
                                                        <a href="{{ route('themes.edit', $theme->id) }}"
                                                           class="btn btn-warning">
                                                            <i class="bx bx-pencil"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{$theme->id}}"
                                                                type="button"
                                                                class="btn btn-danger"><i class="bx bx-trash"></i>
                                                        </button>
                                                    </td>
                                                @else
                                                    <td>
                                                        @if (isset($theme->process->id))
                                                            <a href="{{route('show-process',$theme->process->id)}}"
                                                               style="height: 40px;"
                                                               class="btn btn-outline-info d-flex"> <i
                                                                        class="bx bx-list-check"></i> Jarayonda</a>
                                                        @else
                                                            <a style="height: 40px;"
                                                               class="btn btn-outline-info d-flex"> <i
                                                                        class="bx bx-list-check"></i> Tasdiqlanmagan</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (isset($theme->process->id))
                                                            <a href="{{route('chat',$theme->chat->id)}}"
                                                               style="height: 40px;"
                                                               class="btn btn-outline-primary d-flex"> <i
                                                                        class="bx bx-chat"></i>
                                                                Chat @if($theme->chat->teacherUnreadMessagesCount() >0)
                                                                    <span style="border-radius: 50%;"
                                                                          class="badge bg-danger">{{$theme->chat->teacherUnreadMessagesCount()}}</span>
                                                                @endif</a>
                                                        @endif
                                                    </td>
                                                    @if($theme->percentage=='-1')
                                                        <td>
                                                            <button data-bs-toggle="modal"
                                                                    data-bs-target="#confirmCancelModal{{$theme->id}}"
                                                                    type="button"
                                                                    class="btn btn-outline-danger"
                                                                    style="height: 40px;">
                                                                So'rov
                                                            </button>
                                                        </td>
                                                    @endif
                                                @endif
                                            </tr>
                                        </table>
                                    </td>

                                    <td>{{$theme->name}}</td>
                                </tr>
                                <!-- Modal batafsil  -->
                                <div class="modal fade" id="batafsilModal{{$theme->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div style="" class="modal-content">
                                            <div class="modal-header border-top border-2"
                                                 style="border-color: darkblue">

                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Mavzu haqida
                                                    ma'lumot</h1>


                                                <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('get-theme',$theme->id)}}" method="get">

                                                <div class="modal-body">

                                                    <div class="card mb-3  border-primary border-top border p-2 border-2 ">
                                                        <label for="name" class="form-label">Mavzu nomi</label>
                                                        <p>{{$theme->name}}</p>
                                                    </div>
                                                    <div class="card mb-3  border-primary border-top border p-2 border-2 ">
                                                        <label for="description" class="form-label">Izoh</label>
                                                        <p>{!! $theme->description!!}</p>
                                                    </div>

                                                    <div class="card mb-3  border-primary border-top border p-2 border-2 ">
                                                        <label for="select_end_date" class="form-label">Tanlashni oxirgi
                                                            muddati</label>
                                                        <p>{{ $select_end_date }}</p>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Yopish
                                                    </button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @if($theme->percentage=='-1')
                                    <!-- Modal confirmCancel  -->
                                    <div class="modal fade" id="confirmCancelModal{{$theme->id}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div style="" class="modal-content">
                                                <div class="modal-header border-top border-2"
                                                     style="border-color: darkblue">

                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mavzuni bekor
                                                        qilish
                                                        uchun
                                                        talaba so'rov yuborgan</h1>


                                                    <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('cancel-confirm',$theme->id)}}" method="get">

                                                    <div class="modal-body">

                                                        <div class="card mb-3  border-primary border-top border p-2 border-2 ">
                                                            <label for="name" class="form-label">Talaba so'rovini qabul
                                                                qilasizmi?</label>
                                                            <select name="confirm" class="form-select"
                                                                    aria-label="Default select example">
                                                                <option value="1">Ha</option>
                                                                <option value="0">Yo'q</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                            Yopish
                                                        </button>

                                                        <button type="submit" class="btn btn-primary">Saqlash</button>


                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- Modal delete -->
                                <div class="modal fade" id="deleteModal{{$theme->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-3" id="exampleModalLabel">Haqiqatdan ham ushbu
                                                    mavzuni
                                                    o'chirib tashlamoqchimisiz ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('themes.destroy', $theme->id)}}" method="post">@csrf
                                                @method("DELETE")
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Yopish
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">O'chirish</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal filter  -->
    <div class="modal fade" id="FilterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div style="" class="modal-content">
                <div class="modal-header" style="border-color: darkblue">
                    <button type="button" class="btn-close " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="{{route('themes.index')}}" method="get">
                    <div class="modal-body">
                        @include('includes.filter')
                        <input type="hidden" name="status" value="{{ $options->status }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Yopish
                        </button>
                        <button type="submit" class="btn btn-primary "><i class="bx bx-filter-alt"></i>Filtr
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection