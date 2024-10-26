{{-- @php
    dump('Badge component loaded');
@endphp --}}
@if(!isset($show) || $show)
<span class="badge badge-{{$type ?? 'success'}}">
    {{ $slot }}
</span>
@endif

