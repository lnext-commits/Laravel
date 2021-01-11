@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="height: 50px; margin-top: -15px; margin-bottom: 8px;">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    <?php echo (session('status')) ?>
                </div>
            @endif
            @if(session('attention'))
                <div class="alert alert-danger" role="alert">
                    <?php echo (session('attention')) ?>
                </div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning" role="alert">
                    <?php echo (session('warning')) ?>
                </div>
            @endif
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: #88b400;">Редактор статей</div>

                    <div class="card-body">
                        <form action="{{route('art.crud')}}" method="post">
                            @csrf
                            <div id="boxCancel" style="height: 20px;"></div>

                            @foreach($article as $nameGroup => $arts)
                                <hr>
                                <div style="height: 20px;">
                                    <strong>{{$nameGroup}}</strong>
                                    <span id="artGroup{{$nameGroup}}" style="margin-left: 25px;">
                                        <span class="boxInputArt">
                                             <button type="button" class="btn btn-success btn-sm"
                                                     onclick='addArt("{{$nameGroup}}")'>
                                                    добавить новый раздел
                                             </button>
                                        </span>
                                     </span>
                                </div>
                                <hr>
                                <div class="accordion" id="accordionExample">
                                    @foreach($arts as $id => $art)
                                        <div>
                                            <div class="btn-group dropright" style="margin: 5px;">
                                                <div id="heading{{$id}}">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-light collapsed" type="button"
                                                                data-toggle="collapse"
                                                                data-target="#menu{{$id}}" aria-expanded="false"
                                                                aria-controls="{{$id}}"
                                                                id="button{{$id}}"
                                                        >{{$art['name']}}</button>
                                                    </h5>
                                                </div>
                                                <button type="button"
                                                        class="button-dropdown  btn btn-light dropdown-toggle dropdown-toggle-split"
                                                        data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <span style="margin-left: 10px;" id="boxAddOutgo{{$id}}"></span>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="btn btn-light dropdown-item"
                                                            onclick="addOutgo({{$id}})">
                                                        Добавить статью
                                                    </button>
                                                    <button type="button" class="btn btn-light dropdown-item"
                                                            onclick="editArt ({{$id}})">
                                                        Редактировать
                                                    </button>
                                                    <button type="button" class="btn btn-light dropdown-item"
                                                    onclick="delArt({{$id}})">
                                                        Удалить
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="menu{{$id}}" class="collapse {{$id==$artId ? 'show' : ''}}"
                                                 aria-labelledby="heading{{$id}}"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">
                                                    @foreach($art['outgo'] as $outgo)
                                                        <div class="dropdown dropright">
                                                            <button class="btn btn-light dropdown-toggle" type="button"
                                                                    id="dropdownMenuButton{{$outgo['id']}}"
                                                                    data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"
                                                                    style="margin: 5px;"
                                                            >{{$outgo['outgo_name']}}</button>
                                                            <span style="margin-left: 10px;"
                                                                  id="boxOutgo{{$outgo['id']}}"></span>
                                                            <div class="dropdown-menu"
                                                                 aria-labelledby="dropdownMenuButton{{$outgo['id']}}">
                                                                <button type="button"
                                                                        class="btn btn-light dropdown-item"
                                                                        onclick="editOutgo({{$outgo['id']}}, {{$id}})">
                                                                    Редактировать
                                                                </button>
                                                                <button type="button"
                                                                        class="btn btn-light dropdown-item"
                                                                onclick="delOutgo({{$outgo['id']}}, {{$id}})">
                                                                    Удалить
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let oldId = 0;
        let nameArt = '';

        function addArt(name) {
            $('#artGroup' + name).html('' +
                '<input type="text" name="art_name" style="width: 180px" required>' +
                '<input type="hidden" name="run" value="' + name + '">' +
                '<button type="submit" class="btn btn-success btn-sm" style="margin-left: 20px;">сохранить</button>');
            $('.boxInputArt').remove();
            getButtonCancel();
        }

        function editArt(id) {
            let buttonArt = $('#button' + id);
            let boxArt = $('#boxAddOutgo' + id);
            nameArt = buttonArt.text();
            boxArt.html('' +
                '<input type="text" name="nameArt" value="' + nameArt + '" style="width: 100px;">' +
                '<input type="hidden" name="artId" value="' + id + '">' +
                '<input type="hidden" name="nameOld" value="' + nameArt + '">' +
                '<button type="submit" class="btn btn-success btn-sm" style="margin-left: 20px;">сохранить новое название раздела</button>');
            $('.boxInputArt').remove();
            $('.dropdown-menu').remove();
            getButtonCancel();
        }

        function editOutgo(id, artId) {
            let buttonOutgo = $('#dropdownMenuButton' + id);
            let boxOutgo = $('#boxOutgo' + id);
            nameArt = buttonOutgo.text();
            boxOutgo.html('' +
                '<input type="text" name="nameOutgo" value="' + nameArt + '" style="width: 100px;">' +
                '<input type="hidden" name="outgoId" value="' + id + '">' +
                '<input type="hidden" name="nameOld" value="' + nameArt + '">' +
                '<input type="hidden" name="artId" value="' + artId + '">' +
                '<button type="submit" class="btn btn-success btn-sm" style="margin-left: 20px;">сохранить новое название статьи</button>');
            $('.boxInputArt').remove();
            $('.dropdown-menu').remove();
            getButtonCancel();
        }

        function addOutgo(id) {
            $('.dropdown-menu').remove();
            $('.boxInputArt').remove();
            getButtonCancel();
            $('#boxAddOutgo' + id).html('' +
                '<input type="text" name="outgo_name" style="width: 100px;">' +
                '<input type="hidden" name="art_id" value="' + id + '">' +
                '<button type="submit" class="btn btn-success btn-sm" style="margin-left: 20px;">сохранить новую статью</button>');
        }

        function delArt(id) {
            $('#boxAddOutgo' + id).html('' +
                '<input type="hidden" name="art_id" value="' + id + '">' +
                '<input type="hidden" name="delArt" value="1">' +
                '<button type="submit" class="btn btn-danger btn-sm" style="margin-left: 20px;">Удалить выбраный раздел!?</button>');
        }

        function delOutgo(id, artId) {
            $('#boxOutgo' + id).html('' +
                '<input type="hidden" name="outgo_id" value="' + id + '">' +
                '<input type="hidden" name="delOutgo" value="1">' +
                '<input type="hidden" name="artId" value="' + artId + '">' +
                '<button type="submit" class="btn btn-danger btn-sm" style="margin-left: 20px;">Удалить выбраную статью!?</button>');
        }

        function getButtonCancel() {
            let url = "{{route('art.show',['id' => 0])}}";
            $('#boxCancel').html('<a class="btn btn-warning btn-sm" href="' + url + '" role="button">Сброс</a>')
        }
    </script>
@endsection
