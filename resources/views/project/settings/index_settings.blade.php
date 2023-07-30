@extends('layouts.app')@section('title', 'Settings | Delivery Management')
@section('ajax')
<script>
    $(document).ready(function() {
            $('#edit-profile').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/index/ajax/settings/edit-profile',
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status) {
                            $('#content-settings').empty().html(data.editProfileSection);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            });
        });
        $(document).on('submit', 'form', function(e) {
            const image =
                e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                encType: 'multipart/form-data',
                dataType: 'json',
                data: new FormData($(this)[0]),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        var getFlashMsg = document.getElementById('flash-msg');
                        $('#flash-msg').show();
                        setTimeout(() => {
                            $('#flash-msg').hide();
                        }, 6000);
                    }
                },
                error: function(data) {
                    console.log(data);
                },
            });
        });
        /*
        notice that you can't access any element in any view to other view which fetched using ajax using class or id like this #edit-profile but use upper method
        */
</script>
@stop
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Delivery Management Settings</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" id="edit-profile" style="cursor: pointer">Edit Profile<span
                        class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<div id="content-settings"></div>
@endsection