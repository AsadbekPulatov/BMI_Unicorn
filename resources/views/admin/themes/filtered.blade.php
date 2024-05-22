@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h1 class="text float-start">Mavzular ro'yhati</h1>
                </div>

                <div class="card-body border-top border-2 border-primary">

                    <table class="table ">
                        <tr>
                            <th>#</th>
                            <th>Mavzu</th>
                            <th>Talaba</th>
                            <th>Guruh</th>
                            <th>O'qtuvchi</th>
                            <th>Holat</th>
                            <th>Amallar</th>
                        </tr>
                        @foreach($themes as $key=>$theme)
                            <!-- Modal batafsil  -->
                            <div class="modal fade" id="batafsilModal{{$theme->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div style="" class="modal-content">
                                        <div class="modal-header border-top border-2" style="border-color: #121466">

                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mavzu haqida ma'lumot</h1>


                                            <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>


                                        <div class="modal-body">

                                            <div class="mb-3 border-primary border-top p-2 border-2 card">
                                                <label for="name" class="form-label">Mavzu nomi</label>
                                                <p>{{$theme->name}}</p>
                                            </div>
                                            <div class="mb-3  border-primary border-top p-2 border-2 card">
                                                <label for="description" class="form-label">Izoh</label>
                                                <p>{!! $theme->description!!}</p>
                                            </div>
                                            @if( isset($theme->process->id))
                                                {{--                                        <div class="mb-3  border-primary border-top border p-2 border-2 card">--}}
                                                {{--                                            <label for="description" class="form-label">Jarayon mundarijasi</label>--}}
                                                {{--                                            @if($theme->process->content==null or $theme->process->content=="Hozircha kiritilmagan" )--}}
                                                {{--                                                <p>Hozircha kiritilmagan</p>--}}
                                                {{--                                            @else--}}
                                                {{--                                                <p>{!! $theme->process->content!!}</p>--}}
                                                {{--                                            @endif--}}

                                                {{--                                        </div>--}}
                                                <div class="card mb-3  border-primary border-top border p-2 border-2 ">
                                                    <div class="">
                                                        <div class="float-start">
                                                            <label for="description" class="form-label">Github link </label>
                                                            @if($theme->process->link==null or $theme->process->link=="Hozircha kiritilmagan" )
                                                                <p>Hozircha kiritilmagan</p>
                                                            @else
                                                                <a href="{{$theme->process->link}}" target="_blank"
                                                                   class="btn btn-primary btn-sm m-2"> <i
                                                                            class="bx bx-log-in"></i> Ko'rish </a>
                                                            @endif
                                                        </div>
                                                        <div class=" float-end ">
                                                            <label for="description" class="form-label">Fayl </label>
                                                            @if($theme->process->file==null or $theme->process->file=="Hozircha kiritilmagan" )
                                                                <p>Hozircha kiritilmagan</p>
                                                            @else
                                                                <a href="{{asset($theme->process->file)}}"
                                                                   class="btn btn-primary btn-sm m-2"><i
                                                                            class="bx bx-download"></i> Yuklab olish</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish
                                            </button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <tr>

                                <td>{{$loop->index+1}}</td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#batafsilModal{{$theme->id}}" type="button"
                                            class="btn btn-outline-dark">Batafsil
                                    </button>
                                </td>


                                <td>{{$theme->student_name}}
                                    @if($theme->student_name == null)
                                        Tanlamagan
                                    @endif
                                </td>
                                <td>{{$theme->group_name}}</td>

                                <td>{{\App\Services\EmployeeService::getEmployeeForId($theme->teacher_id)->full_name}}</td>
                                <td>
                                    @if($theme->status == 'new')
                                        <span class="badge bg-primary">Yangi</span>
                                    @elseif($theme->status == 'process')
                                        <span class="badge bg-warning">Jarayonda</span>
                                    @else
                                        <span class="badge bg-success">Topshirilgan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($theme->student_id == 0)
                                        <button data-bs-toggle="modal"
                                                data-bs-target="#editModal{{$theme->id}}"
                                                type="button"
                                                class="btn btn-warning"><i class="bx bx-pencil"></i>
                                        </button>

                                        <button data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$theme->id}}"
                                                type="button"
                                                class="btn btn-danger"><i class="bx bx-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            <!-- Modal edit -->
                            <div class="modal fade" id="editModal{{$theme->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mavzuni tahrirlash</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('theme_update_for_department', ['id'=>$theme->id])}}"
                                              method="post">
                                            @csrf
                                            @method("PUT")
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Mavzu nomi</label>
                                                    <input type="text" value="{{$theme->name}}" required name="name"
                                                           class="form-control" id="name"
                                                           placeholder="Mavzu nomini kiriting">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Izoh</label>
                                                    <textarea class="form-control" required name="description"
                                                              id="description"
                                                              rows="4"
                                                              placeholder="Ushbu mavzuda talaba...">{{$theme->description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Yopish
                                                </button>
                                                <button type="submit" class="btn btn-primary">Saqlash</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
                                        <form action="{{route('theme_delete_for_department', ['id' => $theme->id])}}"
                                              method="post">@csrf
                                            @method("DELETE")
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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
                    <div class="mt-3">
                        {{ $themes->appends([
                            'group_name' => $options->group_name,
                            'teacher_id'=> $options->teacher_id,
                            'status' => $options->status,
                            ])->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('filtered-themes')}}" method="get">
                        <div class="mb-3">
                            <label for="select1" class="form-label">Guruh</label>
                            <select name="group_name" class="form-select" id="select1">
                                <option selected value="0">Barchasi</option>
                                @foreach($groups as $key=>$group)
                                    <option @if($options->group_name==$group) selected
                                            @endif value="{{$group}}">{{$group}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="select2" class="form-label">O'qituvchi</label>
                            <select name="teacher_id" class="form-select" id="select2">
                                <option selected value="0">Barchasi</option>
                                @foreach($teachers as $item)
                                    @foreach($item as $teacher)
                                        <option @if($options->teacher_id==$teacher->employee_id_number) selected
                                                @endif value="{{$teacher->employee_id_number}}">{{$teacher->full_name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="select3" class="form-label">Holat</label>
                            <select name="status" class="form-select" id="select3">
                                <option selected value="0">Barchasi</option>
                                <option @if($options->status=="new") selected @endif value="new">Yangi</option>
                                <option @if($options->status=="process") selected @endif value="process">Jarayonda
                                </option>
                                <option @if($options->status=="end") selected @endif value="end">Topshirilgan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary "><i class="bx bx-filter-alt"></i>Filtr
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
