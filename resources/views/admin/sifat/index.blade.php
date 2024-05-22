@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h1 class="text">O'qituvchilar ro'yhati</h1>

                    <div class="d-flex justify-content-around" style="width: 34%">
                        <a href="{{ route('report.index') }}" class="btn btn-info" target="_blank">
                            <i class="bx bx-file"></i>Buyruq chiqarish
                        </a>
                        <button type="button" onclick="sendOptions()" class="btn btn-info">
                            <i class="bx bx-file"></i>Hisobot
                        </button>

                        <button data-bs-toggle="modal" data-bs-target="#FilterModal"
                                type="button" class="btn btn-primary">
                            <i class="bx bx-filter-alt"></i>
                            Filtr
                        </button>
                    </div>
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
                        @foreach($data as $key => $teacher)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#batafsilModal{{$loop->iteration}}"
                                            type="button"
                                            class="btn btn-outline-dark">
                                        {{ \App\Services\EmployeeService::getEmployeeForId($key)->full_name }}
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
                                                    <?php
                                                    $new = 0;
                                                    $progress = 0;
                                                    $end = 0;
                                                    $percentage = 0;
                                                    $count = count($teacher);
                                                    ?>
                                                    @if(count($teacher) > 0)
                                                        <table
                                                                class="table">
                                                            <tr>
                                                                <th>Mavzu</th>
                                                                <th>Talaba</th>
                                                                <th>Guruh</th>
                                                                <th>Foiz</th>
                                                            </tr>

                                                            @foreach($teacher as $theme)
                                                                <?php
                                                                $percentage += $theme->percentage;
                                                                if ($theme->status == "new") $new++;
                                                                if ($theme->status == "process") $progress++;
                                                                if ($theme->status == "end") $end++;
                                                                ?>
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
                                <td>{{ $count }} ta</td>
                                <td>
                                    @if($count>0)
                                        {{round($percentage/$count)}}
                                    @else
                                        0
                                    @endif %
                                </td>
                                <td>{{$new}} ta</td>
                                <td>{{$progress}} ta</td>
                                <td>{{$end}} ta</td>

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
                <form action="{{route('sifat-bolimi-statistika')}}" method="get">
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
@section('js')
    <script>
        function showDepartment() {
            // Get the selected value from the first select
            var selectedFakultet = document.getElementById("fakultet").value;

            // Get the second select element
            var specialty = document.getElementById("specialty");

            var specialties = @json($specialties);
            // Clear existing options
            specialty.innerHTML = "";
            // Add options based on the selected fruit
            var this_specialty = specialties[selectedFakultet];

            this_specialty.forEach(function (spec) {
                console.log(spec);
                addOption(specialty, spec.code, spec.code + '-' + spec.name);
            });
        }

        function addOption(selectElement, value, text) {
            // Create a new option element
            var option = document.createElement("option");

            // Set the value and text of the option
            option.value = value;
            option.text = text;

            // Append the option to the select element
            selectElement.add(option);
        }

        function sendOptions() {
            // let mudir_id = document.getElementById('select5').value;
            let year = document.getElementById('date').value;
            let sort = document.getElementById('sort').value;
            let type_id = document.getElementById("type_id").value;

            // TODO: urlni o'zgartirish kerak
            // let url = 'statistika/print?mudir_id=' + mudir_id + '&year=' + year + '&semester=' + semester + '&sort=' + sort;
            let url = 'statistika/print?date=' + year + '&type_id=' + type_id + '&sort=' + sort;
            window.open(url);
        }
    </script>
@endsection

