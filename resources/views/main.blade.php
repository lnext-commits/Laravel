@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="boxAlert">
            @error('cash')
            <div class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
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
            <script> setTimeout("$('#boxAlert').html('')", 8000);</script>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div style="width: 75%; float: left;">
                            <img src="/images/{{$iqoInvoice}}">
                            <span style="font-size: 18px; {{$color}}">{{$nameInvoice}}:&nbsp;&nbsp;&nbsp;
                           <strong style="font-size: 22px;">
                               <u>{{$balance}}</u>
                           </strong>
                           <i>грн</i>
                       </span>
                        </div>
                        <div style="width: 25%; float: right; text-align: right;">
                            <button type="button" class="btn btn-success"
                                    onclick='let incoming=window.open("/income/0","","width=550,height=600,screenX=200,screenY=170,status=no,menubar=no,toolbar=no,scrollbars=yes");return false;'
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                    <path fill-rule="evenodd"
                                          d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zM8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-success"
                                    onclick='let incoming=window.open("/expenditure/0","","width=550,height=600,screenX=200,screenY=170,status=no,menubar=no,toolbar=no,scrollbars=yes");return false;'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-clipboard-minus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                    <path fill-rule="evenodd"
                                          d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zm-1 9.5A.5.5 0 0 1 6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-image" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M12 16a2 2 0 0 0 2-2V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8zM3 2a1 1 0 0 1 1-1h5.5v2A1.5 1.5 0 0 0 11 4.5h2V10l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12V2z"/>
                                    <path fill-rule="evenodd" d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                </svg>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
                                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Перевод денежных средств между счетами</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('run.transfer')}}" method="post">
                                            @csrf
                                            <div class="modal-body" style="text-align: center;">
                                                <label>
                                                    <input type="date" name="d" class="form-control form-control-sm" value="{{session('date')}}">
                                                </label>
                                                <label>
                                                    <select class="form-control form-control-sm" name="invoiceMain">
                                                        @foreach($invoices as $invoice)
                                                            <option value="{{$invoice['id']}}" {{$invoice['id'] == session('invoice') ? 'selected' : ''}} >
                                                                {{$invoice['invoice_name']}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                                <label>
                                                    <input type="text" name="cash" class="form-control form-control-sm" placeholder="500 или 30+40 или 80-20" autocomplete="off"
                                                           required>
                                                </label>
                                                <label>
                                                    <select class="form-control form-control-sm" name="invoiceSecondary">
                                                        @foreach($invoices as $invoice)
                                                            <option value="{{$invoice['id']}}">{{$invoice['invoice_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                                <label>
                                                    <input type="text" name="comment" class="form-control form-control-sm">
                                                </label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success btn-sm">Перевести</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Дата</th>
                                <th scope="col">Статья</th>
                                <th scope="col">Название</th>
                                <th scope="col">Приход</th>
                                <th scope="col">Расход</th>
                                <th scope="col">Коментарий</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tables as $table)
                                <tr id="row{{$table['id']}}">
                                    <td id="boxSetting{{$table['id']}}" class="boxSetting">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-success btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                          d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z"/>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if($table['outgo_name'] != 'перевод')
                                                    <button type="button" class="btn btn-light dropdown-item"
                                                            onclick="editMainRow({{$table['id']}})">
                                                        Редактировать
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-light dropdown-item"
                                                        onclick="delRow({{$table['id']}})">
                                                    Удалить
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td> {{date('d-m-Y', strtotime($table['d']))}}</td>
                                    <td>{{$table['art_name']}}</td>
                                    <td>{{$table['outgo_name']}}</td>
                                    <td><span style="color: green">{{$table['run'] ? $table['cash'] : ''}}</span></td>
                                    <td><span style="color: red">{{$table['run'] ? '' : $table['cash']}}</span></td>
                                    <td><?php echo $table['comment'] ?></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function delRow(id) {
            let route = "{{route('run.delRow')}}";
            let csrf = '@csrf';
            let met = '@method('DELETE')';
            $('#boxSetting' + id).html('' +
                '<form action="' + route + '" method="post">' +
                '' + csrf + '' +
                '' + met + '' +
                '<input type="hidden" name="mainId" value="' + id + '">' +
                '<button type="submit" class="btn btn-danger btn-sm">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-square" viewBox="0 0 16 16">\n' +
                '  <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>\n' +
                '  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>\n' +
                '</svg>' +
                '</button>' +
                '</form>')
        }
    </script>
@endsection
