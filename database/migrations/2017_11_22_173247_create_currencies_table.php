<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\CurrencyConverter\Currency;

class CreateCurrenciesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('currencies', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('iso_4217', Currency::ISO_4217_LENGTH)->unique();
			$table->string('name', Currency::NAME_LENGTH);
			$table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('date_modified')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			$table->double('rate');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('currencies');
	}

}
