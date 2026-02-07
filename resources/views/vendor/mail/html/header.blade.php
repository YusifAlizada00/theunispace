@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'TheUniSpace')
<img src="{{ url('webImages/theunispace-logo-tiny.png') }}" class="logo" alt="TheUniSpace Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
