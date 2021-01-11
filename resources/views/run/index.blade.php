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
                    <?php echo (session('status')) ?>
                </div>
                <script>
                    window.opener.location.reload();
                    setTimeout("$('#boxAlert').html('')", 5000);
                </script>
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
                    <div class="card-header" style="background-color: #88b400;">{{$nameCard}}</div>
                    <div class="card-body">
                        <form action="{{route('run.setMain')}}" method="post">
                            @csrf
                            <div id="boxCancel" style="height: 20px;"></div>
                                <div class="accordion" id="accordionExample">
                                    @foreach($article as $id => $art)
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
                                            </div>
                                            <div id="menu{{$id}}" class="collapse {{$id==$artId ? 'show' : ''}}"
                                                 aria-labelledby="heading{{$id}}"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">
                                                    @foreach($art['outgo'] as $outgo)
                                                        <div>
                                                            <button class="btn btn-light " type="button" style="margin: 5px;"
                                                                    onclick="getInput({{$outgo['id']}},{{$id}},{{$run}})">
                                                                {{$outgo['outgo_name']}}
                                                            </button>
                                                        </div>
                                                        <div class="boxInput" id="boxInput{{$outgo['id']}}"></div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getInput (id,artId,run) {
            $('.boxInput').html('');
            let d = "{{session('date')}}";
            $('#boxInput' + id).html('' +
                '<input type="date"  name="d" class="form-control form-control-sm" style=" margin: 4px;"  value="'+d+'">' +
                '<input type="text" name="cash" class="form-control form-control-sm" style=" margin: 4px;" placeholder="Сумма 500 или 30+40 или 80-20" autocomplete="off" required>' +
                '<input type="text" name="comment" class="form-control form-control-sm" style=" margin: 4px;">' +
                '<input type="hidden" name="artId" value="'+artId+'">' +
                '<input type="hidden" name="outgoId" value="'+id+'">' +
                '<input type="hidden" name="run" value="'+run+'">' +
                '<button type="submit" class="btn btn-success btn-sm btn-block"  style=" margin: 4px;" >сохранить</button>');
        }
    </script>
@endsection
