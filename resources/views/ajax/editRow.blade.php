<td>
    <button class="btn btn-outline-success btn-sm" type="button" style="margin-bottom: 3px;"
    onclick="saveMainRow({{$main->id}})">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
        </svg>
    </button><br>
    <a class="btn btn-outline-success btn-sm" href="{{route('main')}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
            <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
        </svg>
    </a>
</td>
<td><input type="date"  name="d" id="d" class="form-control form-control-sm" style="width: 100px;"  value="{{$main->d}}"></td>
<td colspan="3">
    <label>
        <select class="form-control form-control-sm" name="invoice" id="invoice" style="width: 100px;">
            @foreach($invoices as $invoice)
                <option value="{{$invoice->id}}" {{$invoice->id == $main->invoice_id ? 'selected' : ''}} >{{$invoice->invoice_name}}</option>
            @endforeach
        </select>
    </label>
    <label>
        <select class="form-control form-control-sm" name="art" id="art" style="width: 110px;">
            @foreach($arts as $art)
                <option value="{{$art->id}}" {{$art->id == $main->art_id ? 'selected' : ''}} >{{$art->art_name}}</option>
            @endforeach
        </select>
    </label>
    <label>
        <select class="form-control form-control-sm" name="outgo" id="outgo" style="width: 110px;">
            @foreach($outgos as $outgo)
                <option value="{{$outgo->id}}" {{$outgo->id == $main->outgo_id ? 'selected' : ''}} >{{$outgo->outgo_name}}</option>
            @endforeach
        </select>
    </label>
</td>
<td><input type="text" name="cash" id="cash" value="{{$main->cash}}" style="width: 70px;"></td>
<td><input type="text" name="comment" id="comment" value="{{$main->comment}}"></td>
