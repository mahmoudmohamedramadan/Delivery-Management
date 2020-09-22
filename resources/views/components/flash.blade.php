<div>
  @if(session()->has('message'))
    <div class="alert alert-success">
      <strong>Success</strong><br>
      <span>{{ session()->get('message') }}</span>
    </div>
  @elseif(session()->has('error'))
    <div class="alert alert-danger">
      <strong>Fail</strong><br>
      <span>{{ session()->get('error') }}</span>
    </div>
</div>@endif</div>
