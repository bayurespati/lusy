<table class="row note">
	<tr>
		<td class="wrapper last">
			<p>This is a Shop Order </p>
			<p>Following is the submitted details:</p>
			<table class="twelve columns" style="margin-bottom: 10px">
				<tr>
					<td class="panel">
						<table border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td>Item Name</td><td>: <strong>{{ $dataEmail->item_name }}</strong></td>
							</tr>
							<tr>
								<td>Quantity</td><td>: <strong>{{ $dataEmail->quantity }}</strong></td>
							</tr>
							<tr>
								<td>Full name</td><td>: <strong>{{ $dataEmail->buyer_name }}</strong></td>
							</tr>
							<tr>
								<td>Email address</td><td>: <strong> {{ $dataEmail->email }} </strong></td>
							</tr>
							<tr>
								<td>Phone number</td><td>: <strong> {{ $dataEmail->phone }} </strong></td>
							</tr>
							<tr>
								<td>Address</td><td>: <strong> {{ $dataEmail->address }} </strong></td>
							</tr>
							<tr>
								<td>City</td><td>: <strong> {{ $dataEmail->city }} </strong></td>
							</tr>
							<tr>
								<td>State/Province</td><td>: <strong> {{ $dataEmail->state_province }} </strong></td>
							</tr>
							<tr>
								<td>Postal Code</td><td>: <strong> {{ $dataEmail->postal_code }} </strong></td>
							</tr>
							<tr>
								<td>Gender</td><td>: <strong> {{ $dataEmail->gender }} </strong></td>
							</tr>
							<tr>
								<td valign="top">Note</td><td>: <strong> {{ $dataEmail->notes }} </strong></td>
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