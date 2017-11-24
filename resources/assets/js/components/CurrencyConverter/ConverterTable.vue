
<template>
	<div class="col-xs-12">
		<button id="updateCurrenciesButton" class="btn btn-default">
			Update Currencies
		</button>
		<button id="clearCurrenciesButton" class="btn btn-default">
			Clean
		</button>

		<br /><br />

		<table id="currenciesTable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>ISO 4217</th>
					<th>Name</th>
					<th>Date Created</th>
					<th>Date Modified</th>
					<th>Rate</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>AED</td>
					<td>Emiratisk Dirham</td>
					<td>2015-01-01 00:00:00</td>
					<td>2015-01-01 00:00:00</td>
					<td>3.672626</td>
				</tr>
				<tr>
					<td>ALL</td>
					<td>Albanian Lek</td>
					<td>2015-01-01 00:00:00</td>
					<td>2015-01-01 00:00:00</td>
					<td>48.3775</td>
				</tr>
				<tr>
					<td>ANG</td>
					<td>Neth Antilles Guilder</td>
					<td>2015-01-01 00:00:00</td>
					<td>2015-01-01 00:00:00</td>
					<td>110.223333</td>
				</tr>
			</tbody>
		</table>
		
		<div id="testDiv">
			
		</div>
	</div>
</template>
