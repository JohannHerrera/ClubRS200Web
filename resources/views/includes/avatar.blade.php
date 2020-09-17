@if (!empty(Auth::user()->image) && Auth::user()->image != '--')
    <img class="img-xs rounded-circle" src="{{ route('user.avatar', ['filename'=>Auth::user()->image]) }}" alt="Avatar">
@endif



