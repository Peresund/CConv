
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
			</tbody>
		</table>
	</div>
</template>
