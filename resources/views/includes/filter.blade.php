@if(isset($types))
    <div class="mb-3">
        <label for="type_id" class="form-label">Tur</label>
        <select name="type_id" id="type_id" class="form-select" required>
            <option value="0">Barchasi</option>
            @foreach($types as $item)
                <option value="{{ $item->id }}"
                        @if($item->id == $options->type_id) selected @endif
                >{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
@endif
@if(isset($specialties))
    <div class="mb-3">
        <label for="fakultet" class="form-label">Fakultet</label>
        <select name="fakultet" class="form-select" id="fakultet" onchange="showDepartment()">
            <option value="">Fakultet tanlang</option>
            @foreach($specialties as $key => $data)
                <option value="{{$key}}">{{ $data[0]->department->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="specialty" class="form-label">Yo'nalish</label>
        <select name="specialty" class="form-select" id="specialty">

        </select>
    </div>
@endif
@if(isset($filter["specialty"]))
    <div class="mb-3">
        <label for="name" class="form-label">Yonalish tanlang</label>
        <select class="form-select" required name="specialty" aria-label="Default select example">
            <option selected value="0">Barchasi</option>
            @foreach($filter["specialty"] as $key => $item)
                <option value="{{ $key }}"
                        @if($key == $options->specialty) selected @endif
                >{{ $key }}
                    - {{ \App\Services\SpecialtyService::getSpecialtyForId($key)->name }}</option>
            @endforeach
        </select>
    </div>
@endif
@if(isset($teachers))
    <div class="mb-3">
        <label for="select2" class="form-label">O'qituvchi</label>
        <select name="teacher_id" class="form-select" id="select2">
            <option value="0">Barchasi</option>
            @foreach($teachers as $item)
                @foreach($item as $teacher)
                    <option value="{{$teacher->employee_id_number}}">{{$teacher->full_name}}</option>
                @endforeach
            @endforeach
        </select>
    </div>
@endif
@if(isset($filter["date"]))
    <div class="mb-3">
        <label for="date" class="form-label">O'quv yili</label>
        <select name="date" id="date" class="form-select" required>
            <option value="">O'quv yilini tanlang:</option>
            @foreach($filter["date"] as $key => $item)
                <option value="{{ $key }}"
                        @if($key == $options->date) selected @endif
                >{{ $key.'-'.$key+1 }}</option>
            @endforeach
        </select>
    </div>
@endif
@if(isset($groups))
    <div class="mb-3">
        <label for="select1" class="form-label">Guruh</label>
        <select name="group" class="form-select" id="select1">
            @foreach($groups as $group)
                <option @if($options->group==$group) selected
                        @endif value="{{$group}}">{{$group}}</option>
            @endforeach
        </select>
    </div>
@endif
@if(isset($options->sort))
    <div class="mb-3">
        <label for="select2" class="form-label">Tartib</label>
        <select name="sort" class="form-select" id="sort">
            <option @if($options->sort=='DESC') selected @endif value="DESC">
                Kamayish
            </option>
            <option @if($options->sort=='ASC') selected @endif value="ASC">
                O'sish
            </option>
        </select>
    </div>
@endif