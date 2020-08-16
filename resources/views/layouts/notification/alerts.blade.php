@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }} asd
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-success" role="alert">
        {{ session('warning') }}
    </div>
@endif