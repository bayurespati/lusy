<table class="row note">
	<tr>
		<td class="wrapper last">
			<p>This is a Class Registration notification </p>
			<p>Following is the submitted details:</p>
			<table class="twelve columns" style="margin-bottom: 10px">
				<tr>
					<td class="panel">
						<table border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td>Class</td><td>: <strong>{{ $dataEmail->class_name }}</strong></td>
							</tr>
							<tr>
								<td>Full name</td><td>: <strong>{{ $dataEmail->name }}</strong></td>
							</tr>
							<tr>
								<td>Place of Birth</td><td>: <strong>{{ $dataEmail->place_of_birth }}</strong></td>
							</tr>
							<tr>
								<td>Date of birth</td><td>: <strong>{{ $dataEmail->date_of_birth }}</strong></td>
							</tr>
							<tr>
								<td>Address</td><td>: <strong>{{ $dataEmail->address }}</strong></td>
							</tr>
							<tr>
								<td>Email</td><td>: <strong>{{ $dataEmail->email }}</strong></td>
							</tr>
							<tr>
								<td>Telephone number</td><td>: <strong>{{ $dataEmail->telephone }}</strong></td>
							</tr>
							<tr>
								<td>Phone number</td><td>: <strong>{{ $dataEmail->mobile }}</strong></td>
							</tr>
							<tr>
								<td>Fax</td><td>: <strong>{{ $dataEmail->fax }}</strong></td>
							</tr>
							<tr>
								<td>Gender</td><td>: <strong>{{ $dataEmail->gender }}</strong></td>
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