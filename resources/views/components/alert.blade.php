@props(['type' => 'success', 'dismissible' => true])

<div class="alert alert-{{ $type }} {{ $dismissible ? 'alert-dismissible fade show' : '' }} border-0 shadow-sm mb-4" role="alert" style="border-radius: 0.5rem;">
    {{ $slot }}
    @if($dismissible)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    @endif
</div>
