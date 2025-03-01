@props(['url'])
<tr>
<td class="header">
	<table style="width: 100%;">
		<tr>
			<td >
				<div class="tarjeta">
					{{ $slot }}
				</div>
			</td>
			<td class="header_sub2">
				<img src="{{ asset('logo.png') }}" class="logo1" alt="Leukoplast">
			</td>
		</tr>
	</table>
<!--<a href="{{ $url }}" style="display: inline-block; width: 100%;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else

	<div style="width:50%;">
		
	</div>
	<div style="width:50%;">
		
	</div>


@endif
</a>-->
</td>
</tr>
