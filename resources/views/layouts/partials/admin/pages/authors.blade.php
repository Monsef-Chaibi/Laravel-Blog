@extends('layouts.app')

@section('title', 'Authors')

@section('content')
    @livewire('authors')
@endsection

@push('scripts')
    <script>
        $(window).on('hidden.bs.modal', function() {
            Livewire.emit('resetForm');
        });
        window.addEventListener('hide-modal', function(event) {
            $('#add_author_modal').modal('hide');
        });
        window.addEventListener('hide_edit_author_modal', function(event) {
            $('#edit_author_modal').modal("hide");
        });
        window.addEventListener('deleteAuthorAction', function(event) {
            $('#delete_modal').modal("hide");
        });
    </script>
@endpush
