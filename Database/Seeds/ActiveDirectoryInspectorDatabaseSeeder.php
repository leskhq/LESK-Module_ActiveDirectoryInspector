<?php
namespace App\Modules\ActiveDirectoryInspector\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ActiveDirectoryInspectorDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\ActiveDirectoryInspector\Database\Seeds\FoobarTableSeeder');
	}

}
