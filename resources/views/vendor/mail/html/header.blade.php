@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Thegoalify')
<img src="{{ url('webImages/thegoalify-logo.png') }}" class="logo" alt="Thegoalify Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
