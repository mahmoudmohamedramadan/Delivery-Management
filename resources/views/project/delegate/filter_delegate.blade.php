@section('filterSection')
@foreach ($delegates as $delegate)
<tr class="row-{{ $delegate->id }}">
    <td>{{ $delegate->id }}</td>
    <td><a href="/index/delegate/{{ $delegate->id }}/edit">{{ $delegate->name }}</a></td>
    <td>{{ $delegate->national_id }}</td>
    <td>{{ $delegate->phone }}</td>
    @if ($delegate->image)
    <td><img src="{{ asset('images/delegate/' . $delegate->image) }}" alt="{{ $delegate->image }}" width="80px"
            height="80px">
    </td>
    @include('project.layouts.layout')
    @else
    <td>null</td>
    @include('project.layouts.layout')
    @endif
</tr>
@endforeach
@endsection