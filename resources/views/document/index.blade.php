@extends('layouts.main')
@section('content')

    <div class="card-body">
            @include('document.formulaire')
    </div>
@endsection

{{-- @section('content2')
    @include('document.table')
@endsection --}}

@section('js')
<script>
    new DataTable('#example');
    $('.btn-delete').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var url = '{{ route('document.delete', ['id' => ':id' ]) }}'.replace(':id', id)
        console.log(url)
        if (confirm('Voulez vous supprimer cet element ?')) {
            window.location.replace(url);
        }
    })
</script>
@endsection
