<table class="row note">
	<tr>
		<td class="wrapper last">
			<p>This is a Event Registration notification </p>
			<p>Following is the submitted details:</p>
			<table class="twelve columns" style="margin-bottom: 10px">
				<tr>
					<td class="panel">
						<table border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td>Event name</td><td>: <strong> {{ $dataEmail->event_name }}</strong></td>
							</tr>
							<tr>
								<td>Full name</td><td>: <strong>{{ $dataEmail->name }}</strong></td>
							</tr>
							<tr>
								<td>Email address</td><td>: <strong> {{ $dataEmail->email }} </strong></td>
							</tr>
							<tr>
								<td>Phone number</td><td>: <strong>{{ $dataEmail->phone }}</strong></td>
							</tr>
							<tr>
								<td>Address</td><td>: <strong>{{ $dataEmail->address }}</strong></td>
							</tr>
							<tr>
								<td>Gender</td><td>: <strong>{{ $dataEmail->gender }}</strong></td>
							</tr>
							<tr>
								<td valign="top">Note</td><td>: <strong>{{ $dataEmail->message }}</strong></td>
							</tr>
						</table>
					</td>
					<td class="expander">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>