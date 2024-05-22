@extends("admin.master")
@section("content")
    <div class="card">
        <div class="card-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Mavzu yaratish</h1>
        </div>
        <form action="{{route('themes.store')}}" method="post">@csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="type_id" class="form-label">Tur</label>
                    <select name="type_id" id="type_id" class="form-select" required
                        onchange="insert_semester_select(this)">
                        <option value="">Turni tanlang:</option>
                        @foreach($types as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Yo'nalish tanlang</label>
                    <select class="form-select" required name="specialty" aria-label="Default select example"
                            onchange="getGroups(this)">
                        <option value="">Yo'nalish tanlang</option>
                        @foreach($this_specialty as $item)
                            <option value="{{ $item->code }}">{{ $item->code }}
                                - {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
{{--                <div class="mb-3">--}}
{{--                    <label for="level" class="form-label">Kurs</label>--}}
{{--                    <input type="number" class="form-control" required name="level" id="level" min="1" max="10"--}}
{{--                           value="1">--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="semester" class="form-label">Semestr</label>--}}
{{--                    <input type="number" class="form-control" required name="semester" id="semester" min="1"--}}
{{--                           max="10" value="1">--}}
{{--                </div>--}}
                <div class="mb-3">
                    <label for="group" class="form-label">Guruhlar</label>
                    <select id="group" class="select2" name="group[]" multiple="multiple" data-placeholder="Барчаси"
                            style="width: 100%;">
                        @foreach($this_groups as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="themes">
                    <div class="accordion-item card mb-3">
                        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionIcon-1" aria-controls="accordionIcon-1"
                                    aria-expanded="false">
                                1-mavzu:
                                <button type="button" class="btn btn-icon btn-success m-3" onclick="create_theme_section()">
                                    <span class="tf-icons bx bx-plus"></span>
                                </button>
                            </button>
                        </h2>

                        <div id="accordionIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionIcon"
                             style="">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Mavzu nomi</label>
                                    <input type="text" required name="name[]" class="form-control" id="name"
                                           placeholder="Mavzu nomini kiriting">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Izoh</label>
                                    <textarea class="form-control tinymce" required name="description[]" id="description"
                                              rows="4"
                                              placeholder="Ushbu mavzuda talaba..."> </textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="second_teacher" class="form-label">Maslahatchi o'qituvchi</label>
                                    <input type="text" required name="second_teacher[]" class="form-control" id="second_teacher"
                                           placeholder="Maslahatchi o'qituvchini kiriting">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--                <div class="mb-3">--}}
                {{--                    <label for="student_id" class="form-label">Talaba</label>--}}
                {{--                    <input type="text" name="student_id" class="form-control" id="student_id"--}}
                {{--                           placeholder="Talaba id raqamini kiriting:">--}}
                {{--                    <p class="text-danger">Izoh: Mavzuni talabaga oldindan biriktirish.<br>Mavzuni talaba--}}
                {{--                        tasdiqlashi kerak.</p>--}}
                {{--                </div>--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                <button type="submit" class="btn btn-primary">Saqlash</button>
            </div>
        </form>
    </div>
    <script>
        var theme_count = 1;

        function create_theme_section() {
            theme_count++;

            var div = document.createElement('div');
            div.id = "theme_form" + theme_count;
            div.innerHTML = `
                <div class="accordion-item card mb-3">
                        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-` + theme_count + `" aria-controls="accordionIcon-1" aria-expanded="false">
                                ` + theme_count + `-mavzu:
                                 <button type="button" class="btn btn-icon btn-success mt-3 mb-3" onclick="create_theme_section()">
                                    <span class="tf-icons bx bx-plus"></span>
                                 </button>
                                 <button type="button" class="btn btn-icon btn-danger mt-3 mb-3" onclick="delete_theme_section(` + theme_count + `)">
                                    <span class="tf-icons bx bx-minus"></span>
                                 </button>
                            </button>
                        </h2>

                        <div id="accordionIcon-` + theme_count + `" class="accordion-collapse collapse" data-bs-parent="#accordionIcon" style="">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Mavzu nomi</label>
                                    <input type="text" required name="name[]" class="form-control" id="name"
                                           placeholder="Mavzu nomini kiriting">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Izoh</label>
                                    <textarea class="form-control tinymce" required name="description[]" id="description" rows="4"
                                              placeholder="Ushbu mavzuda talaba..."> </textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="second_teacher" class="form-label">Maslahatchi o'qituvchi</label>
                                    <input type="text" required name="second_teacher[]" class="form-control" id="second_teacher"
                                           placeholder="Maslahatchi o'qituvchini kiriting">
                                </div>
                            </div>
                        </div>
                    </div>`;
            document.getElementById('themes').appendChild(div);
        }

        function delete_theme_section(id) {
            var form = document.getElementById("theme_form" + id);
            form.remove();
        }
    </script>
    <script>
        $('.select2').select2({
            theme: "classic",
        });

        function getGroups(e) {
            var specialty = e.value;
            var groups = @json($this_groups);
            var group = document.getElementById("group");
            group.innerHTML = "";
            groups.forEach(function (spec) {
                if (specialty == spec.specialty.code && spec._curriculum > 0) {
                    console.log(spec);
                    addOption(group, spec.id, spec.name);
                }
            })
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
    </script>
@endsection