@extends('admin.master')
@section('content')
    <div class="card m-2 p-2" style="box-shadow: 0px 0px 5px 5px rgba(194,215,236,0.63)">
        <div class="card-header d-flex justify-content-between">
            <h1 class="text text-center text-dark">Turlar ro'yhati</h1>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bx bx-plus"></i> Qo'shish
            </button>
        </div>
        <div class="card-body">
            <table class="table overflow-auto">
                <tr>
                    <th>#</th>
                    <th class="col-8">Nomi</th>
                    <th>Amallar</th>
                </tr>
                @foreach($types['data'] as $type)
                    <tr class="align-items-center">
                        <td>{{$loop->index+1}}</td>
                        <td>{{$type->name}}</td>
                        <td class="">
                            <button data-bs-toggle="modal" data-bs-target="#editModal{{$type->id}}" type="button"
                                    class="btn btn-warning"><i class="bx bx-pencil"></i></button>
                            <button data-bs-toggle="modal" data-bs-target="#deleteModal{{$type->id}}" type="button"
                                    class="btn btn-danger"><i class="bx bx-trash"></i></button>
                        </td>

                    </tr>

                    <!-- Modal edit -->
                    <div class="modal fade" id="editModal{{$type->id}}" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tahrirlash</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{route('types.update',$type->id)}}" method="post">@csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tur nomi</label>
                                            <input type="text" required name="name" class="form-control"
                                                   value="{{$type->name}}" id="name"
                                                   placeholder="Tur nomi">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish
                                        </button>
                                        <button type="submit" class="btn btn-primary">Saqlash</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal delete -->
                    <div class="modal fade" id="deleteModal{{$type->id}}" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="exampleModalLabel">Haqiqatdan ham ushbu
                                        o'qituvchini o'chirib tashlamoqchimisiz ?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{route('types.destroy',$type->id)}}" method="post">@csrf
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
                <form action="{{route('types.store')}}" method="post">@csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">Tur nomi</label>
                            <input type="text" required name="name" class="form-control" id="name"
                                   placeholder="Tur nomi">
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