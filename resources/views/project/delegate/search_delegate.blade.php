@section('searchSection')
  <ul class="dropdown-menu" style="width:260px;display:block;
  position:relative">
    @foreach($delegates as $delegate)
      <li style="cursor:pointer"><span style="margin:25px">{{
      $delegate->name
      }}</span></li>
    @endforeach
  </ul>
@endsection
