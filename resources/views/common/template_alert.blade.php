{{-- alert --}}
@php
$message = session()->get('success') ?? session()->get('error');
session()->forget(['success', 'error']);
@endphp

@if($message)
<div class="alert alert-{{ $message[1] }} alert-dismissible fade show" role="alert">
    <strong>{{ $message[0] }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@push('js')
<script>
    // temporary implementation
    setTimeout(() => {
        $('.alert-dismissible > .btn-close').trigger('click')
    }, 1500);
</script>
@endpush
