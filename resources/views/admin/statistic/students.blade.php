@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text">Talabalar ro'yhati</h1>
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
                            <th>Talaba</th>
                            <th>Bajarilgan</th>
                            <th>O'qituvchi</th>
                            <th>Holat</th>
                        </tr>
                        @foreach($students as $student)
                            {{--                    @dd($student)--}}
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$student->student_name}}</td>
                                <td>{{$student->percentage}}%</td>
                                <td>{{ \App\Services\EmployeeService::getEmployeeForId($student->teacher_id)->full_name }}</td>
                                @if($student->status=='end') <td><span class="bg-success badge">Topshirilgan</span></td>
                                @else
                                    <td><span class="bg-warning badge">Jarayonda</span></td>
                                @endif
                            </tr>
                        @endforeach
                    </table>

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
                <form action="{{route('statistics-student')}}" method="get">
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

