
<template>
	<div class="col-xs-12">
		<div class="col-xs-12 col-md-1 col-lg-1 content-item">
			<label for="inputFromCurrency" class="col-xs-12 input-label">
				From:
			</label>
			<select id="inputFromCurrency" class="">
			</select>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-4 content-item">
			<label for="inputValue" class="col-xs-12 input-label">
				Value:
			</label>
			<input id="inputValue" class="" type="number" step="any" name="fullname" value="" style="width: 100%; max-width: 300px;">
		</div>
		<div class="col-xs-12 col-md-1 col-lg-1 content-item">
			<label for="inputToCurrency" class="col-xs-12 input-label">
				To:
			</label>
			<select id="inputToCurrency" class="">
			</select>
		</div>
		<div class="col-xs-12 col-md-1 col-lg-3 content-item">
			<label for="outputResult" class="col-xs-12 input-label">
				Result:
			</label>
			<div id="outputResult" class="">0</div>
		</div>

		<div class="col-xs-12 col-lg-6" style="clear:both;"></div>
	</div>
</template>
