@extends('layouts.min')

@section('content')
    <div class="container">
        <div style="height: 50px; margin-top: -15px; margin-bottom: 8px;" id="boxAlert">
            @error('cash')
            <div class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    <?php echo(session('status')) ?>
                </div>
                <script>
                    window.opener.location.reload();
                    setTimeout("$('#boxAlert').html('')", 5000);
                </script>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header my-card-header">
                        <form action="{{route('summary')}}" method="post">
                            @csrf
                            <input type="date"
                                   name="dateSummary"
                                   class="form-control"
                                   style="font-size:  35px; background: transparent; text-align: center; font-weight: bold;"
                                   value="{{$valDate}}"
                            >
                            <button class="btn btn-success btn-sm btn-block" type="submit" style="margin-top: 8px;">Отразить</button>
                        </form>
                    </div>
                    <div class="card-body">
                        @foreach($result as $name => $mains)
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th colspan="6">{{$name}}</th>
                                </tr>
                                <tr>
                                    <th>Дата</th>
                                    <th>Статья</th>
                                    <th>Название</th>
                                    <th>Приход</th>
                                    <th>Расход</th>
                                    <th>Коментарий</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mains as $main)
                                    <tr>
                                        <td> {{date('d-m-Y', strtotime($main->d))}}</td>
                                        <td>{{$main->art->art_name}}</td>
                                        <td>{{$main->outgo->outgo_name}}</td>
                                        <td><span style="color: green">{{$main->run ? $main->cash : ''}}</span></td>
                                        <td><span style="color: red">{{$main->run ? '' : $main->cash}}</span></td>
                                        <td><?php echo $main->comment ?></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" style="text-align: right;">итого:</td>
                                    <td style="color: green; font-weight: bold;">{{$cash[$name][1]}}</td>
                                    <td style="color: red; font-weight: bold;">{{$cash[$name][0]}}</td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection
