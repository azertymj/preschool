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

        new DataTable('#example', {
                responsive: true,
                    layout: {
                        topStart: {
                            buttons: ['colvis']
                        }
                    }
            });
    })
</script>

<script>
    document.getElementById('selectAll').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.document-checkbox');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    document.getElementById('bulkDeleteBtn').addEventListener('click', function () {
        const selectedIds = Array.from(document.querySelectorAll('.document-checkbox:checked')).map((checkbox) => checkbox.value);
        if (selectedIds.length === 0) {
            alert('Please select at least one document to delete.');
            return;
        }

        if (!confirm('Are you sure you want to delete the selected documents?')) {
            return;
        }

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('document.bulkDelete') }}';
        form.style.display = 'none';

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        selectedIds.forEach((id) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = id;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    });
</script>
@endsection
