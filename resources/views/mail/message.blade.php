<table class="row note">
	<tr>
		<td class="wrapper last">
			<p>This is a new message <p>
			<p>Following is the submitted details:</p>
			<table class="twelve columns" style="margin-bottom: 10px">
				<tr>
					<td class="panel">
						<table border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td>Name</td><td>: <strong>{{ $dataEmail->name }}</strong></td>
							</tr>
							<tr>
								<td>Email address</td><td>: <strong>{{ $dataEmail->email }}</strong></td>
							</tr>
							<tr>
								<td>Phone number</td><td>: <strong>{{ $dataEmail->phone }}</strong></td>
							</tr>
							<tr>
								<td valign="top">Message</td><td>: <strong>{{ $dataEmail->message }}</strong></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>