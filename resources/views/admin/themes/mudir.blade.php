@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-2 p-2">
                <div class="card-header">
                    <h1 class="text float-start">Mavzular ro'yhati</h1>
                    <button data-bs-toggle="modal" data-bs-target="#FilterModal"
                            type="button" class="btn btn-primary float-end">
                        <i class="bx bx-filter-alt"></i>
                        Filtr
                    </button>
                </div>
            </div>

            @foreach($themes as $key => $value)
                <div class="card m-2 p-2">
                    <div class="card-header">
                        <h1 class="text float-start">{{ $types[$key]->name }}</h1>
                    </div>
                    <div class="card-body border-top border-2 border-primary table-responsive">

                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Mavzu</th>
                                <th>Talaba</th>
                                <th>Guruh</th>
                                <th>O'qtuvchi</th>
                                @if($status == "new")
                                    <th>Amallar</th>
                                @endif
                            </tr>
                            @foreach($value as $key=>$theme)
                                <!-- Modal batafsil  -->
                                <div class="modal fade" id="batafsilModal{{$theme->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div style="" class="modal-content">
                                            <div class="modal-header border-top border-2" style="border-color: #121466">

                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Mavzu haqida
                                                    ma'lumot</h1>


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
                                                    <div class="mb-3  border-primary border-top border p-2 border-2 card">
                                                        <label for="description" class="form-label">Jarayon
                                                            mundarijasi</label>
                                                        @if($theme->process->content==null or $theme->process->content=="Hozircha kiritilmagan" )
                                                            <p>Hozircha kiritilmagan</p>
                                                        @else
                                                            <p>{!! $theme->process->content!!}</p>
                                                        @endif

                                                    </div>
                                                    <div class="card mb-3  border-primary border-top border p-2 border-2 ">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="description" class="form-label">Github
                                                                    link </label>
                                                                @if($theme->process->link==null or $theme->process->link=="Hozircha kiritilmagan" )
                                                                    <p>Hozircha kiritilmagan</p>
                                                                @else
                                                                    <a href="{{$theme->process->link}}" target="_blank"
                                                                       class="btn btn-primary btn-sm m-2"> <i
                                                                                class="bx bx-log-in"></i> Ko'rish </a>
                                                                @endif
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="description"
                                                                       class="form-label">Fayl </label>
                                                                @if($theme->process->file==null or $theme->process->file=="Hozircha kiritilmagan" )
                                                                    <p>Hozircha kiritilmagan</p>
                                                                @else
                                                                    <a href="{{ route('process.download', $theme->process->id) }}"
                                                                       class="btn btn-primary btn-sm m-2"><i
                                                                                class="bx bx-download"></i> Yuklab
                                                                        olish</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Yopish
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <tr>

                                    <td>{{$loop->index+1}}</td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#batafsilModal{{$theme->id}}"
                                                type="button"
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
                                    @if($status == "new")
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
                                    @endif
                                </tr>

                                <!-- Modal edit -->
                                <div class="modal fade" id="editModal{{$theme->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Mavzuni
                                                    tahrirlash</h1>
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
                <form action="{{route('mudir-themes', ['status' => $status])}}" method="get">
                    <div class="modal-body">
                        @include('includes.filter')
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
