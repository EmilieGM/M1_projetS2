<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Geneset;

class GeneSetFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fichier=file('storage/Data/geneset_example_with_reactome.txt');

        foreach ($fichier as $key => $value) {
    		if(strpos($value, "$")===0){
				$value=str_replace('$','', $value);
				Geneset::firstOrCreate([
					'name' => $value
				]);

    		}
    		//else{
    		//	$value=explode("\t", $value);
    		//	foreach ($value as $gene=>$bam) {
    		//		$gene=str_replace('"', '', $gene);
    				//DB::table('genes')->insert([
    				//	'uniprot'=>($gene),
    		//		]);
    		//	}
    		//}
    	}
    }
}
