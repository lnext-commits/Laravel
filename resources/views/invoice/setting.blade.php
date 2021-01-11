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
                    <div class="card-header" style="background-color: #88b400;">
                        Настройка Счета
                        <a class="btn btn-outline-dark btn-sm" href="{{route('invoice.show')}}" role="button" style="margin-left: 15px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708l-4-4z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{route('invoice.setting',['id' => $invoiceId])}}" method="post">
                            @csrf
                            <div style="margin: 10px;">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="nameInvoice">Наименование счета:</label>
                                        <input type="text" class="form-control" id="nameInvoice" name="nameInvoice" value="{{$nameInvoice}}" style="text-align: center" required>
                                    </div>
                                    <div class="col">
                                        <label for="residue">Ввод остатка по счету:</label>
                                        <input type="number" name="residue" id="residue" class="form-control">
                                    </div>
                                    <div class="col">

                                    </div>
                                    <div class="col">
                                        <button type="submit" name="delInvoice" class="btn btn-danger btn-sm">удалить счет</button>
                                    </div>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" id="bar0" role="progressbar" style="width: 10%; background-color: #E06926"></div>
                                <div class="progress-bar" id="bar1" role="progressbar" style="width: 30%; background-color: #FCC00B"></div>
                                <div class="progress-bar" id="bar2" role="progressbar" style="width: 30%; background-color: #76A9D0"></div>
                                <div class="progress-bar" id="bar3" role="progressbar" style="width: 30%; background-color: #8AC255"></div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="formControlRange" style="color: #FCC00B">Жёлтый диапазон остатка счета</label>
                                <input type="range" class="form-control-range" id="range1" min="0" max="2000" step="50"
                                       name="limit1"
                                       value="{{$limit1}}"
                                       oninput="viewSize(1)">
                            </div>

                            <div class="form-group">
                                <label for="formControlRange" style="color: #76A9D0">Синий диапазон остатка счета</label>
                                <input type="range" class="form-control-range" id="range2" min="1000" max="5000" step="50"
                                       name="limit2"
                                       value="{{$limit2}}"
                                       oninput="viewSize(2)">
                            </div>
                            <div id="boxButtonSave"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = setRange;
        let buttonSave = '<button type="submit" class="btn btn-success btn-sm">Сохранить</button>'
        let l1, l2, name, number;

        function setRange() {
            l1 = $('#range1').val();
            l2 = $('#range2').val();
            name = $('#nameInvoice').val();
            $("#nameInvoice").keyup(function () {
                let nameForm;
                nameForm = $('#nameInvoice').val();
                if (nameForm === name) {
                    $('#boxButtonSave').html('');
                } else {
                    $('#boxButtonSave').html(buttonSave);
                }
            });
            $("#residue").keyup(function () {
                let nameForm2;
                nameForm2 = $('#residue').val();
                if (nameForm2 === '') {
                    $('#boxButtonSave').html('');
                } else {
                    $('#boxButtonSave').html(buttonSave);
                }
            });
            viewSize(1);
            viewSize(2);
            setTimeout("$('#boxAlert').html('')", 10000)
        }

        function viewSize(r) {
            let size, size1, size2, size22, size3, proc1, proc2, proc3;
            size = $('#range' + r).val();
            size1 = $('#range1').val();
            size2 = $('#range2').val();
            size22 = size2 - size1;
            size3 = 6000 - size22 - size1;

            proc1 = size1 * 0.015;
            proc2 = size22 * 0.015;
            proc3 = size3 * 0.015;

            $('.valRange' + r).text(size);
            $('#bar0').css('width', '10%').html('-&infin;  &mdash; 0');
            $('#bar1').css('width', proc1 + '%').html('0 &mdash; ' + size1);
            $('#bar2').css('width', proc2 + '%').html(size1 + ' &mdash; ' + size2);
            $('#bar3').css('width', proc3 + '%').html(size2 + ' &mdash; &infin;');
            $('#range2').attr('min', size1);
            if (size1 === l1 && size2 === l2) {
                $('#boxButtonSave').html('');
            } else {
                $('#boxButtonSave').html(buttonSave);
            }
        }
    </script>
@endsection
