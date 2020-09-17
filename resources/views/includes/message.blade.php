{{-- Mostrar mensajes --}}
@if (session('message'))
<div class="alert alert-error">
    {{ session('message') }}
</div>
@endif
