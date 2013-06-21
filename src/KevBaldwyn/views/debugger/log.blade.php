<style>
	.debugger__output {
		padding: 20px;
		background-color: #FFF;
		border-top:3px solid #CCC;
		margin-top:20px;
	}
	.debugger__output table, .debugger__output h3 {
		color: #777;
		font: 12px 'Source Code Pro', Monaco, Consolas, "Lucida Console", monospace;
	}
	.debugger__output table {
		margin-bottom: 30px;
		width: 100%;
	}
	.debugger__output h3 {
		border-bottom: 1px solid #CCC;
		color: #ED591A;
		font-size: 24px;
		padding-bottom: 8px;
		margin-top: 0px;
	}
	.debugger__output table .key {
		width: 20%;
		min-width: 170px;
		color: #333;
	}
	.debugger__output table td {
		vertical-align: top;
		text-align: left;
	}
</style>
<div class="debugger__output">
	<div class="background inline">
	<?php 
	$data = array('Server/Request Data'   => $_SERVER,
                  'GET Data'              => $_GET,
                  'POST Data'             => $_POST,
                  'Files'                 => $_FILES,
                  'Cookies'               => $_COOKIE,
                  'Session'               => isset($_SESSION) ? $_SESSION : array(),
                  'Environment Variables' => $_ENV);
	?>
	
	@foreach($data as $heading => $array)
		<h3>{{ $heading }}</h3>
		<table>
			@foreach($array as $key => $value)
			<tr>
				<td class="key">{{ $key }}</td>
				<td>
					@if(is_array($value)) 
						<pre>
							{{ print_r($value) }}
						</pre>
					@else
						{{ $value }}
					@endif
			</tr>
			@endforeach
		</table>
	@endforeach
	</div>
</div>