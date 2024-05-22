@extends('admin.master')
@section('content')
    <?php $now_date = date('Y-m-d', strtotime(now())); ?>
    <div class="card m-2 p-2" style="box-shadow: 0px 0px 5px 5px rgba(194,215,236,0.63)">
        <div class="card-header d-flex justify-content-between">
            <h1 class="text text-center text-dark">Mavzu vaqtlari</h1>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bx bx-plus"></i> Qo'shish
            </button>
        </div>
        <div class="card-body">
            <table class="table overflow-auto">
                <tr>
                    <th>#</th>
                    <th class="col-3">Tur</th>
                    <th class="col-3">O'quv yili</th>
                    <th class="col-3">Tanlashning oxirgi muddati</th>
                    <th>Amallar</th>
                </tr>
                @foreach($data['data']['deadline'] as $item)
                    <tr class="align-items-center">
                        <td>{{$loop->index+1}}</td>
                        <td>{{$item->type->name}}</td>
                        <td>{{$item->date.'-'.$item->date+1}}</td>
                        <td>{{$item->select_end_date}}</td>
                        <td class="">
                            <button data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}" type="button"
                                    class="btn btn-warning"><i class="bx bx-pencil"></i></button>
                            <button data-bs-toggle="modal" data-bs-target="#deleteModal{{$item->id}}" type="button"
                                    class="btn btn-danger"><i class="bx bx-trash"></i></button>
                        </td>

                    </tr>

                    <!-- Modal edit -->
                    <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tahrirlash</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{route('deadline_themes.update',$item->id)}}" method="post">@csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="type_id" class="form-label">Tur</label>
                                            <select name="type_id" id="type_id" class="form-control form-select">
                                                @foreach($data['data']['types'] as $val)
                                                    <option value="{{ $val->id }}" @if($val->id == $item->type_id) selected @endif>{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="select_end_date" class="form-label">Tanlashni oxirgi muddati</label>
                                            <input type="date" min="{{ $now_date }}" name="select_end_date" id="select_end_date" class="form-control" value="{{ $item->select_end_date }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                                        <button type="submit" class="btn btn-primary">Saqlash</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal delete -->
                    <div class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="exampleModalLabel">Haqiqatdan ham ushbu
                                        o'qituvchini o'chirib tashlamoqchimisiz ?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{route('deadline_themes.destroy',$item->id)}}" method="post">@csrf
                                    @method('DELETE')

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish
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
    <!-- Button trigger modal -->


    <!-- Modal create -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tur yaratish</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('deadline_themes.store')}}" method="post">@csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="type_id" class="form-label">Tur</label>
                            <select name="type_id" id="type_id" class="form-control form-select">
                                @foreach($data['data']['types'] as $val)
                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="select_end_date" class="form-label">Tanlashni oxirgi muddati</label>
                            <input type="date" min="{{ $now_date }}" name="select_end_date" id="select_end_date" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection