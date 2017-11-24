
<template>
	<div id="currencyConverter">
		<div class="title col-xs-12">
			Currency Converter
		</div>
		<hr class="gradient col-xs-12" />
		<ConverterInput></ConverterInput>
		<hr class="gradient col-xs-12" />
		<ConverterTable></ConverterTable>
	</div>
</template>

<script>
	import ConverterTable from './ConverterTable'
	import ConverterInput from './ConverterInput'
	export default {
		name: 'CurrencyConverter',
		components: {
		  ConverterInput,
		  ConverterTable
		}
	}
</script>
