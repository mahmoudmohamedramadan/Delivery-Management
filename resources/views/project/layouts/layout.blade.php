<td>
    <form action="/index/delegate/{{ $id }}" method="POST" style="width:auto;margin:0px;padding:0px;background:none">
        @csrf
        @method('DELETE')
        @if ($filter === 2)
            <input type="button" value="Show Orders" class="btn btn-success">
        @endif
        <input type="button" value="Edit Data" class="btn btn-success"
            onclick="location.href = '/index/delegate/{{ $delegate->id }}/edit' ">
        <input type="submit" value="Delete" class="btn btn-danger">
        <input type="button" value="Delete Ajax" class="delete-ajax btn btn-danger" delete-id="{{ $id }}">
    </form>
</td>
