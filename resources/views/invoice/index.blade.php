@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="height: 50px; margin-top: -15px; margin-bottom: 8px;" id="boxAlert">
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
                    <div class="card-header" style="background-color: #88b400;">Редактор счетов</div>

                    <div class="card-body">
                        <form action="{{route('invoice.add')}}" method="post">
                            @csrf
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">сорт</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">тек.Остаток</th>
                                    <th scope="col">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td id="s{{$invoice['id']}}"
                                            ondblclick="sort({{$invoice['id']}})">{{$invoice['sort']}}</td>
                                        <td>{{$invoice['invoice_name']}}</td>
                                        <td>{{$balance[$invoice['id']]}}</td>
                                        <td><a class="btn btn-success btn-sm" href="{{route('invoice.setting', [ 'id' => $invoice['id']])}}" role="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                                    <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                                                </svg>
                                            </a>
                                    </tr>
                                @endforeach

                                <tr id="addInvoice">
                                    <td colspan="4" style="text-align: center;">
                                        <button type="button" class="btn btn-success" onclick="getForm () ">Добавить
                                            счет
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
            $('#addInvoice').html('' +
                '<td><input type="number" name="sort" style="width: 45px" value="0"></td>' +
                '<td><input type="text" name="invoice_name" style="width: 180px" required></td>' +
                '<td><input type="number" name="balance"  style="width: 65px" value="0"> </td>' +
                '<td><button type="submit" class="btn btn-success">сохранить</button></td>');
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
