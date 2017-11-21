
<template>
	<div id="currencyConverter">
		<div class="title col-xs-12">
			Currency Converter
		</div>
		<hr class="gradient col-xs-12" />
		<ConverterTop></ConverterTop>
		<hr class="gradient col-xs-12" />
		<ConverterBottom></ConverterBottom>
	</div>
</template>

<script>
	import ConverterBottom from './ConverterBottom'
	import ConverterTop from './ConverterTop'
	export default {
		name: 'CurrencyConverter',
		components: {
		  ConverterTop,
		  ConverterBottom
		}
	}
</script>
