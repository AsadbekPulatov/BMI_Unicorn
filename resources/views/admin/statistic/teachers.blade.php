@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text">O'qituvchilar ro'yhati</h1>

                    <button data-bs-toggle="modal" data-bs-target="#FilterModal"
                            type="button" class="btn btn-primary float-end">
                        <i class="bx bx-filter-alt"></i>
                        Filtr
                    </button>
                </div>

                <div class="card-body border-top border-2 border-primary overflow-auto">

                    <table class="table ">
                        <tr>
                            <th>#</th>
                            <th>O'qituvchi</th>
                            <th>Mavzular soni</th>
                            <th>Bajarilgan</th>
                            <th>Yangi</th>
                            <th>Jarayonda</th>
                            <th>Tugallangan</th>
                        </tr>
                        @foreach($data as $teacher)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#batafsilModal{{$loop->iteration}}"
                                            type="button"
                                            class="btn btn-outline-dark">
                                        {{$teacher['name']}}
                                    </button>

                                    <div class="modal fade" id="batafsilModal{{$loop->iteration}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <div class="modal-dialog modal-lg">

                                            <div style="" class="modal-content">

                                                <div class="modal-header border-top border-2"
                                                     style="border-color: darkblue">
                                                    <h1 class="text text-center" id="exampleModalLabel">Mavzular </h1>

                                                    <button type="button" class="btn-close bg-danger float-end "
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if($teacher['themes']!=null)
                                                        <table
                                                                class="table">
                                                            <tr>
                                                                <th>Mavzu</th>
                                                                <th>Talaba</th>
                                                                <th>Guruh</th>
                                                                <th>Foiz</th>
                                                            </tr>

                                                            @foreach($teacher['themes'] as $theme)
                                                                <tr>
                                                                    <td>{{$theme->name}}</td>
                                                                    <td>{{$theme->student_name ?? "Hozircha tanlamagan"}}</td>
                                                                    <td>{{$theme->group_name ?? "-"}}</td>
                                                                    <td><span>{{$theme->percentage}}%</span></td>
                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    @else
                                                        <h2 class="text">Mavzular yo'q</h2>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Yopish
                                                    </button>

                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </td>
                                <td>{{ $teacher['count'] ?? 0}} ta</td>
                                <td>
                                    @if($teacher['count']>0)
                                        {{round($teacher['percentage']/$teacher['count'])}}
                                    @else
                                        0
                                    @endif %
                                </td>
                                <td>{{$teacher['new'] ?? 0}} ta</td>
                                <td>{{$teacher['progress'] ?? 0}} ta</td>
                                <td>{{$teacher['end'] ?? 0}} ta</td>

                            </tr>
                        @endforeach
                    </table>

                    {{--            <div class="mt-3">--}}
                    {{--                {{ $teachers->appends([--}}
                    {{--                    'semester' => $options->semester,--}}
                    {{--                    'year' => $options->year,--}}
                    {{--                    'sort'=> $options->sort,--}}
                    {{--                    ])->links() }}--}}

                    {{--            </div>--}}
                </div>
            </div>
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
                <form action="{{route('statistics-teacher')}}" method="get">
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

