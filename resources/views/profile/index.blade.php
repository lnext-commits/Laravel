@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="height: 50px; margin-top: -15px; margin-bottom: 8px;" id="boxAlert">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    <?php echo(session('status')) ?>
                </div>
            @endif
            @if(session('attention'))
                <div class="alert alert-danger" role="alert">
                    <?php echo(session('attention')) ?>
                </div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning" role="alert">
                    <?php echo(session('warning')) ?>
                </div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: #88b400;">Данные пользователя
                        <a class="btn btn-outline-dark btn-sm" href="{{route('main')}}" role="button" style="margin-left: 15px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708l-4-4z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{route('profile')}}" method="post">
                            @csrf
                            <div id="boxPassword">
                                <div class="form-group">
                                    <label for="name">Имя :</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="surname">Фамилия :</label>
                                    <input type="text" name="surname" class="form-control" id="surname" value="{{$user->surname}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="login">Логин :</label>
                                    <input type="text" name="login" class="form-control" id="login" value="{{$user->login}}" required>
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <button type="button" class="btn btn-secondary" onclick="getForm()">Изменить пароль</button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Сохранить изменения</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = setT;

        function setT() {
            setTimeout("$('#boxAlert').html('')", 10000);
        }

        function getForm() {
            let route = "{{route('invoice.add')}}"
            let csrf = '@csrf';
            $('#boxPassword').html('' +
                '<div class="form-group">' +
                '<label for="oldPassword">Старый пароль :</label>' +
                '<input type="password" name="oldPassword" class="form-control" id="oldPassword" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="newPassword">Новый пароль : </label>' +
                '<input type="password" name="newPassword" class="form-control" id="newPassword" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="dblPassword">Повторить новый пароль :</label>' +
                '<input type="password" name="dblPassword" class="form-control" id="dblPassword" required>' +
                '</div>');
        }

        let oldId = 0;
        let oldSort = 0;

        function sort(id) {
            if (oldId > 0) {
                $('#s' + oldId).text(oldSort);
            }
            oldId = id;
            oldSort = $('#s' + id).text();

            $('#s' + id).html('' +
                '<input type="number" name="sort" style="width: 45px" value="' + oldSort + '">' +
                '<input type="hidden" name="invoiceId"  value="' + id + '">');
        }
    </script>
@endsection
