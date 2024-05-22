@extends('admin.master')
@section('content')
    <div class="card m-2 p-2" style="box-shadow: 0px 0px 5px 5px rgba(194,215,236,0.63)">
        <div class="card-header">
            <h1 class="text float-start">Mavzular ro'yhati</h1>
            <form action="{{route('student-themes', ['status' => $status])}}" method="get"
                  class="form-group  d-flex float-end justify-content-between align-items-center ">


                <table class="text-center my-2">
                    <tr>
                        <th>
                            <select name="type_id" id="type_id" class="form-select">
                                <option value="0">Barchasi</option>
                                @foreach($types as $item)
                                    <option @if($item->id == $options->type_id) selected
                                            @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </th>


                        <th class="btn-group">
                            <button type="submit" class="btn btn-primary "><i class="bx bx-filter-alt"></i>Filtr
                            </button>

                        </th>
                    </tr>
                </table>
            </form>
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
                        @if($status == 'new')
                            <th class="col-2">Tanlashni oxirgi muddati</th>
                        @endif
                    </tr>
                    @forelse($value as $theme)
                        <?php
                        $theme_group = $theme->group->toArray();
                        $now_date = strtotime(date('Y-m-d', strtotime(now())));
                        $select_end_date = \App\Services\DeadlineThemeService::deadline($theme->type_id, $theme->date);
                        ?>
                        @if (in_array($group, array_column($theme_group, "group_id")) && ($now_date < strtotime($select_end_date) || $status != "new"))
                            <tr class="align-items-center">
                                <td class="">
                                    @if($theme->student_id==0)
                                        <button data-bs-toggle="modal" data-bs-target="#batafsilModal{{$theme->id}}"
                                                type="button"
                                                class="btn btn-outline-dark">Batafsil
                                        </button>
                                    @else
                                        <table>
                                            <tr>
{{--                                                <td>--}}
{{--                                                    <button type="button" class="btn btn-info" disabled>Tanlandi--}}
{{--                                                    </button>--}}
{{--                                                </td>--}}
                                                <td>
                                                    @if($theme->status == "process")
                                                        <button data-bs-toggle="modal"
                                                                style="height: 40px; width: 130px;"
                                                                data-bs-target="#bekorModal{{$theme->id}}" type="button"
                                                                class="btn btn-outline-danger">Bekor qilish
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($theme->process->id))
                                                        <a href="{{route('show-process',$theme->process->id)}}"
                                                           style="height: 40px;"
                                                           class="btn btn-outline-info d-flex"> <i
                                                                    class="bx bx-list-check"></i> Jarayonda</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($theme->process->id))
                                                        <a href="{{route('chat-student',$theme->id)}}"
                                                           style="height: 40px;"
                                                           class="btn btn-outline-primary d-flex"> <i
                                                                    class="bx bx-chat"></i>
                                                            Chat @if($theme->chat->studentUnreadMessagesCount()>0)
                                                                <span style="border-radius: 50%;"
                                                                      class="badge bg-danger">{{$theme->chat->studentUnreadMessagesCount()}}</span>
                                                            @endif</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                </td>
                                <td>{{$theme->name}}</td>
                                @if($status == 'new')
                                    <td>{{$select_end_date}}</td>
                                @endif
                            </tr>
                            <!-- Modal batafsil  -->
                            <div class="modal fade" id="batafsilModal{{$theme->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div style="" class="modal-content">
                                        <div class="modal-header border-top border-2" style="border-color: darkblue">

                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tanlangan mavzuni
                                                o'zgartira
                                                olmaysiz, shu mavzuni tanlaysizmi ?</h1>


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
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Yopish
                                                </button>

                                                <button type="submit" class="btn btn-primary">Mavzuni tanlash</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal bekorqilsih  -->
                            <div class="modal fade" id="bekorModal{{$theme->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div style="" class="modal-content">
                                        <div class="modal-header border-top border-2" style="border-color: darkblue">

                                            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Tanlangan
                                                mavzuni
                                                bekor qilish uchun ilmiy rahbarga so'rov yuboriladi, agar qabul qilsa
                                                barcha
                                                jarayonlar bekor qilinadi va yangi mavzu tanlash imkoniyati paydo
                                                bo'ladi</h1>


                                            <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('cancel-theme',$theme->id)}}" method="get">


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Yopish
                                                </button>

                                                <button type="submit" class="btn btn-primary">So'rov yuborish</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal bekorqilsih2  -->
                            <div class="modal fade" id="bekorModal2{{$theme->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div style="" class="modal-content">
                                        <div class="modal-header border-top border-2" style="border-color: darkblue">

                                            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Tanlangan
                                                mavzuni
                                                bekor qilish.</h1>


                                            <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('cancel-confirm',$theme->id)}}" method="get">

                                            <input type="hidden" name="confirm" value="1">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Yopish
                                                </button>

                                                <button type="submit" class="btn btn-primary">Bekor qilish</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal tasdiqlash  -->
                            <div class="modal fade" id="tasdiqModal{{$theme->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div style="" class="modal-content">
                                        <div class="modal-header border-top border-2" style="border-color: darkblue">

                                            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">
                                                O'qituvchi sizga oldindan mavzu berdi. Agar uni tasdiqlasangiz shu
                                                mavzuni
                                                tanlagan bo'lasiz.
                                            </h1>

                                            <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('get-theme',$theme->id)}}" method="get">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Yopish
                                                </button>

                                                <button type="submit" class="btn btn-primary">Tasdiqlash</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">Sizning yo'lanilishingizdagi tanlangan semesterdagi
                                tanlash
                                mumkin bo'lgan mavzular yo'q
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>

        </div>
    @endforeach
@endsection