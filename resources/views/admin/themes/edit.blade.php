@extends("admin.master")
@section("content")
    <div class="card">
        <div class="card-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Mavzuni tahrirlash</h1>
        </div>
        <form action="{{route('themes.update', $theme->id)}}" method="post">@csrf
            @method("PUT")
            <div class="card-body">
                <div class="mb-3">
                    <label for="type_id" class="form-label">Tur</label>
                    <select name="type_id" id="type_id" class="form-select" required
                            onchange="insert_semester_select(this.value)">
                        <option value="">Turni tanlang:</option>
                        @foreach($types as $item)
                            <option value="{{ $item->id }}"
                                    @if($theme->type_id == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Yo'nalish tanlang</label>
                    <select class="form-select" required name="specialty" aria-label="Default select example"
                            onchange="getGroups(this)">
                        <option value="">Yo'nalish tanlang</option>
                        @foreach($this_specialty as $item)
                            <option value="{{ $item->code }}"
                                    @if($item->code == $theme->specialty) selected @endif
                            >{{ $item->code }}
                                - {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
{{--                <div class="mb-3">--}}
{{--                    <label for="level" class="form-label">Kurs</label>--}}
{{--                    <input type="number" class="form-control" required name="level"--}}
{{--                           id="level" min="1" max="10"--}}
{{--                           value="{{ substr($theme->level, 0, -5) }}">--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="semester" class="form-label">Semestr</label>--}}
{{--                    <input type="number" class="form-control" required name="semester"--}}
{{--                           id="semester" min="1" max="10"--}}
{{--                           value="{{ substr($theme->semester, 0, -8) }}">--}}
{{--                </div>--}}
                <div class="mb-3">
                    <label for="group" class="form-label">Guruhlar</label>
                    <select id="group" class="select2" name="group[]" multiple="multiple" data-placeholder="Барчаси"
                            style="width: 100%;">
                        <?php $groups = $theme->group->toArray(); ?>
                        @foreach($new_groups as $item)
                            <option value="{{ $item->id }}"
                                    @if(in_array($item->id, array_column($groups, "group_id"))) selected @endif>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Mavzu nomi</label>
                    <input type="text" value="{{$theme->name}}" required name="name"
                           class="form-control" id="name"
                           placeholder="Mavzu nomini kiriting">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Izoh</label>
                    <textarea class="form-control tinymce" required name="description"
                              id="description"
                              rows="4"
                              placeholder="Ushbu mavzuda talaba...">{{$theme->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="second_teacher" class="form-label">Maslahatchi
                        o'qituvchi</label>
                    <input type="text" required name="second_teacher"
                           class="form-control"
                           id="second_teacher"
                           placeholder="Maslahatchi o'qituvchini kiriting"
                           value="{{ $theme->second_teacher }}">
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