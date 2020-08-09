@if(session('success'))
    <p class="alert alert-success">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="alert alert-danger">{{ session('error') }}</p>
@endif

@if(session('warning'))
    <p class="alert alert-warning">{{ session('warning') }}</p>
@endif

<script>

    setTimeout(function()
    {
        $('.alert').slideUp();

    }, 3000);

</script>
