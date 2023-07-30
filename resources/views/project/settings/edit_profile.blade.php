@section('editProfileSection')
<form action="/index/ajax/settings/edit-profile/{{ auth()->user()->id }}">
    @csrf
    <div class="alert alert-success" style="display: none" id="flash-msg">
        <strong>Success</strong><br>
        <span>data saved sucessfully</span>
    </div>
    <label>
        <span class="label-txt">Username</span>
        <input type="text" value="{{ auth()->user()->name ?? old('name') }}" name="name" class="input"
            autocomplete="off" placeholder="Enter UserName">
        @error('name')
        <span class="text-red-700 font-bold">{{ $message }}</span>
        @enderror
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <span class="label-txt">Email</span>
        <input type="text" value="{{ auth()->user()->email ?? old('email') }}" name="email" class="input"
            autocomplete="off" placeholder="Enter Email">
        @error('email')
        <span class="text-red-700 font-bold">{{ $message }}</span>
        @enderror
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <span class="label-txt">Phone Number</span>
        <input type="text" value="{{ auth()->user()->phone ?? old('phone') }}" name="phone" class="input"
            autocomplete="off" placeholder="Enter Phone Number">
        @error('phone')
        <span class="text-red-700 font-bold">{{ $message }}</span>
        @enderror
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <div class="input-group">
            <span class="label-txt">Avatar</span>
            <input type="file" name="avatar" class="custom-file-input cursor-pointer" id="avatar-name">
            <div class="line-box">
                <div class="line"></div>
            </div>
        </div>
    </label>
    <input type="submit" value="Edit Data" class="btn btn-success">
</form>
@endsection