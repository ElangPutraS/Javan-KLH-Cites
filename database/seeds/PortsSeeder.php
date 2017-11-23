<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PortsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::transaction(function () {
        	DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        	DB::statement('TRUNCATE TABLE ports');

        	$faker = Faker::create();

        	foreach ($this->jsonData() as $key => $item) {
        		//DB::table('ports')->insert($item);
        		DB::table('ports')->insert([
        			'port_code' => $item['port_code'],
        			'port_name' => $item['port_name'],
        			'created_at' => $faker->dateTime(),
        			'updated_at' => date('Y-m-d h:i:s')
        		]);
        	}
        });
    }

    public function jsonData() {
    	return json_decode("[
    		{
    			\"port_code\": \"IDAAS\",
    			\"port_name\": \"Apalapsili\"
    		},
    		{
    			\"port_code\": \"IDABU\",
    			\"port_name\": \"Atambua\"
    		},
    		{
    			\"port_code\": \"IDADB\",
    			\"port_name\": \"Adang Bay\"
    		},
    		{
    			\"port_code\": \"IDAEG\",
    			\"port_name\": \"Aekgodang\"
    		},
    		{
    			\"port_code\": \"IDAGD\",
    			\"port_name\": \"Anggi\"
    		},
    		{
    			\"port_code\": \"IDAHI\",
    			\"port_name\": \"Amahai\"
    		},
    		{
    			\"port_code\": \"IDAJN\",
    			\"port_name\": \"Arjuna, Java\"
    		},
    		{
    			\"port_code\": \"IDAKE\",
    			\"port_name\": \"Akeselaka\"
    		},
    		{
    			\"port_code\": \"IDAMA\",
    			\"port_name\": \"Amamapare, Ij\"
    		},
    		{
    			\"port_code\": \"IDAMB\",
    			\"port_name\": \"Ambon\"
    		},
    		{
    			\"port_code\": \"IDAMI\",
    			\"port_name\": \"Mataram  / Selaparang (u)\"
    		},
    		{
    			\"port_code\": \"IDAMP\",
    			\"port_name\": \"Ampenan\"
    		},
    		{
    			\"port_code\": \"IDAMQ\",
    			\"port_name\": \"Ambon / Pattimura/laha (u)\"
    		},
    		{
    			\"port_code\": \"IDAMU\",
    			\"port_name\": \"Amurang\"
    		},
    		{
    			\"port_code\": \"IDANG\",
    			\"port_name\": \"Angar\"
    		},
    		{
    			\"port_code\": \"IDANR\",
    			\"port_name\": \"Anyer Kidul\"
    		},
    		{
    			\"port_code\": \"IDAPI\",
    			\"port_name\": \"Apiapi\"
    		},
    		{
    			\"port_code\": \"IDAPN\",
    			\"port_name\": \"Ampana\"
    		},
    		{
    			\"port_code\": \"IDARB\",
    			\"port_name\": \"Aroe Bay\"
    		},
    		{
    			\"port_code\": \"IDARD\",
    			\"port_name\": \"Alor Island\"
    		},
    		{
    			\"port_code\": \"IDARJ\",
    			\"port_name\": \"Arjuna, Java\"
    		},
    		{
    			\"port_code\": \"IDARO\",
    			\"port_name\": \"Arosbaya\"
    		},
    		{
    			\"port_code\": \"IDASA\",
    			\"port_name\": \"Asam Asam\"
    		},
    		{
    			\"port_code\": \"IDASI\",
    			\"port_name\": \"Asike\"
    		},
    		{
    			\"port_code\": \"IDATA\",
    			\"port_name\": \"Atapupu\"
    		},
    		{
    			\"port_code\": \"IDAUN\",
    			\"port_name\": \"Blang Lancang (arun)\"
    		},
    		{
    			\"port_code\": \"IDAUT\",
    			\"port_name\": \"Atauro\"
    		},
    		{
    			\"port_code\": \"IDAYW\",
    			\"port_name\": \"Ayawasi\"
    		},
    		{
    			\"port_code\": \"IDBAA\",
    			\"port_name\": \"Baa\"
    		},
    		{
    			\"port_code\": \"IDBAD\",
    			\"port_name\": \"Banda Naira\"
    		},
    		{
    			\"port_code\": \"IDBAG\",
    			\"port_name\": \"Bagan Siapi-api\"
    		},
    		{
    			\"port_code\": \"IDBAJ\",
    			\"port_name\": \"Bajo'e\"
    		},
    		{
    			\"port_code\": \"IDBAK\",
    			\"port_name\": \"Batu Kilat\"
    		},
    		{
    			\"port_code\": \"IDBAL\",
    			\"port_name\": \"Balantang/malili\"
    		},
    		{
    			\"port_code\": \"IDBAN\",
    			\"port_name\": \"Banjarmasin\"
    		},
    		{
    			\"port_code\": \"IDBAO\",
    			\"port_name\": \"Bakongan\"
    		},
    		{
    			\"port_code\": \"IDBAR\",
    			\"port_name\": \"Bandar Khalipah\"
    		},
    		{
    			\"port_code\": \"IDBCH\",
    			\"port_name\": \"Baucau (u)\"
    		},
    		{
    			\"port_code\": \"IDBDJ\",
    			\"port_name\": \"Banjar Masin /samsudin Noor (u)\"
    		},
    		{
    			\"port_code\": \"IDBDL\",
    			\"port_name\": \"Bandul\"
    		},
    		{
    			\"port_code\": \"IDBDO\",
    			\"port_name\": \"Bandung / Husein Sastranegara (u)\"
    		},
    		{
    			\"port_code\": \"IDBDS\",
    			\"port_name\": \"Badas Sumbawa\"
    		},
    		{
    			\"port_code\": \"IDBEJ\",
    			\"port_name\": \"Berau\"
    		},
    		{
    			\"port_code\": \"IDBEK\",
    			\"port_name\": \"Bekapai\"
    		},
    		{
    			\"port_code\": \"IDBEN\",
    			\"port_name\": \"Benete\"
    		},
    		{
    			\"port_code\": \"IDBET\",
    			\"port_name\": \"Belida Terminal\"
    		},
    		{
    			\"port_code\": \"IDBGA\",
    			\"port_name\": \"Bosong Telaga\"
    		},
    		{
    			\"port_code\": \"IDBGG\",
    			\"port_name\": \"Banggai\"
    		},
    		{
    			\"port_code\": \"IDBIK\",
    			\"port_name\": \"Biak / Frans Kasiepo (u)\"
    		},
    		{
    			\"port_code\": \"IDBIN\",
    			\"port_name\": \"Bintoro\"
    		},
    		{
    			\"port_code\": \"IDBIR\",
    			\"port_name\": \"Biringkassi\"
    		},
    		{
    			\"port_code\": \"IDBIT\",
    			\"port_name\": \"Bitung\"
    		},
    		{
    			\"port_code\": \"IDBJG\",
    			\"port_name\": \"Bolaang\"
    		},
    		{
    			\"port_code\": \"IDBJU\",
    			\"port_name\": \"Banyuwangi\"
    		},
    		{
    			\"port_code\": \"IDBJW\",
    			\"port_name\": \"Bajawa\"
    		},
    		{
    			\"port_code\": \"IDBKA\",
    			\"port_name\": \"Bekasi\"
    		},
    		{
    			\"port_code\": \"IDBKH\",
    			\"port_name\": \"Bakauheni\"
    		},
    		{
    			\"port_code\": \"IDBKI\",
    			\"port_name\": \"Biring Kassi\"
    		},
    		{
    			\"port_code\": \"IDBKL\",
    			\"port_name\": \"Bangkalan\"
    		},
    		{
    			\"port_code\": \"IDBKM\",
    			\"port_name\": \"Bulukumba\"
    		},
    		{
    			\"port_code\": \"IDBKS\",
    			\"port_name\": \"Bengkulu / Padang Kemiling (u)\"
    		},
    		{
    			\"port_code\": \"IDBKU\",
    			\"port_name\": \"Bengkulu\"
    		},
    		{
    			\"port_code\": \"IDBLC\",
    			\"port_name\": \"Batu Licin\"
    		},
    		{
    			\"port_code\": \"IDBLG\",
    			\"port_name\": \"Balongan\"
    		},
    		{
    			\"port_code\": \"IDBLI\",
    			\"port_name\": \"Blinju, Banka\"
    		},
    		{
    			\"port_code\": \"IDBLJ\",
    			\"port_name\": \"Belinju\"
    		},
    		{
    			\"port_code\": \"IDBLL\",
    			\"port_name\": \"Blang Lancang, St\"
    		},
    		{
    			\"port_code\": \"IDBLS\",
    			\"port_name\": \"Bengkalis\"
    		},
    		{
    			\"port_code\": \"IDBLT\",
    			\"port_name\": \"Belitung\"
    		},
    		{
    			\"port_code\": \"IDBLV\",
    			\"port_name\": \"Beliling\"
    		},
    		{
    			\"port_code\": \"IDBLW\",
    			\"port_name\": \"Belawan\"
    		},
    		{
    			\"port_code\": \"IDBMT\",
    			\"port_name\": \"Bima Terminal, Jv\"
    		},
    		{
    			\"port_code\": \"IDBMU\",
    			\"port_name\": \"Bima\"
    		},
    		{
    			\"port_code\": \"IDBND\",
    			\"port_name\": \"Bandung (ptt/gede Bage)\"
    		},
    		{
    			\"port_code\": \"IDBNG\",
    			\"port_name\": \"Bonggala\"
    		},
    		{
    			\"port_code\": \"IDBNT\",
    			\"port_name\": \"Banta Eng\"
    		},
    		{
    			\"port_code\": \"IDBOA\",
    			\"port_name\": \"Benoa/loloan\"
    		},
    		{
    			\"port_code\": \"IDBOG\",
    			\"port_name\": \"Bogor\"
    		},
    		{
    			\"port_code\": \"IDBPD\",
    			\"port_name\": \"Belakang Padang\"
    		},
    		{
    			\"port_code\": \"IDBPN\",
    			\"port_name\": \"Balikpapan /sepinggan (u)\"
    		},
    		{
    			\"port_code\": \"IDBPP\",
    			\"port_name\": \"Balikpapan\"
    		},
    		{
    			\"port_code\": \"IDBTG\",
    			\"port_name\": \"Bontang\"
    		},
    		{
    			\"port_code\": \"IDBTH\",
    			\"port_name\": \"Batam / Hang Nadim (u)\"
    		},
    		{
    			\"port_code\": \"IDBTJ\",
    			\"port_name\": \"Aceh / Blang Bintang (u)\"
    		},
    		{
    			\"port_code\": \"IDBTM\",
    			\"port_name\": \"Batam Island\"
    		},
    		{
    			\"port_code\": \"IDBTN\",
    			\"port_name\": \"Bintuhan\"
    		},
    		{
    			\"port_code\": \"IDBTU\",
    			\"port_name\": \"Batu Ampar\"
    		},
    		{
    			\"port_code\": \"IDBTW\",
    			\"port_name\": \"Batulicin\"
    		},
    		{
    			\"port_code\": \"IDBUA\",
    			\"port_name\": \"Bula\"
    		},
    		{
    			\"port_code\": \"IDBUG\",
    			\"port_name\": \"Buleleng, Bali\"
    		},
    		{
    			\"port_code\": \"IDBUI\",
    			\"port_name\": \"Bokondini\"
    		},
    		{
    			\"port_code\": \"IDBUL\",
    			\"port_name\": \"Buleleng\"
    		},
    		{
    			\"port_code\": \"IDBUN\",
    			\"port_name\": \"Buatan\"
    		},
    		{
    			\"port_code\": \"IDBUR\",
    			\"port_name\": \"Batu Ampal\"
    		},
    		{
    			\"port_code\": \"IDBUW\",
    			\"port_name\": \"Bau-bau\"
    		},
    		{
    			\"port_code\": \"IDBXD\",
    			\"port_name\": \"Bade, Irian Jaya\"
    		},
    		{
    			\"port_code\": \"IDBXT\",
    			\"port_name\": \"Bonthan Bay, Sulawesi\"
    		},
    		{
    			\"port_code\": \"IDBYQ\",
    			\"port_name\": \"Bunyu\"
    		},
    		{
    			\"port_code\": \"IDCBN\",
    			\"port_name\": \"Cirebon\"
    		},
    		{
    			\"port_code\": \"IDCBW\",
    			\"port_name\": \"Celukan Bawang\"
    		},
    		{
    			\"port_code\": \"IDCDK\",
    			\"port_name\": \"Cilandak\"
    		},
    		{
    			\"port_code\": \"IDCEB\",
    			\"port_name\": \"Celukan Bawang, Bl\"
    		},
    		{
    			\"port_code\": \"IDCEN\",
    			\"port_name\": \"Cengkareng\"
    		},
    		{
    			\"port_code\": \"IDCER\",
    			\"port_name\": \"Cereweh\"
    		},
    		{
    			\"port_code\": \"IDCGD\",
    			\"port_name\": \"Cigading\"
    		},
    		{
    			\"port_code\": \"IDCGK\",
    			\"port_name\": \"Cengkareng / Sukarno Hatta (u)\"
    		},
    		{
    			\"port_code\": \"IDCIG\",
    			\"port_name\": \"Cigading\"
    		},
    		{
    			\"port_code\": \"IDCIK\",
    			\"port_name\": \"Cikampek\"
    		},
    		{
    			\"port_code\": \"IDCIN\",
    			\"port_name\": \"Cinta, Java\"
    		},
    		{
    			\"port_code\": \"IDCIW\",
    			\"port_name\": \"Ciwandan\"
    		},
    		{
    			\"port_code\": \"IDCLG\",
    			\"port_name\": \"Calang\"
    		},
    		{
    			\"port_code\": \"IDCML\",
    			\"port_name\": \"Cimalaya\"
    		},
    		{
    			\"port_code\": \"IDCOM\",
    			\"port_name\": \"Comal\"
    		},
    		{
    			\"port_code\": \"IDCSA\",
    			\"port_name\": \"Cape Sago\"
    		},
    		{
    			\"port_code\": \"IDCTT\",
    			\"port_name\": \"Ciputat\"
    		},
    		{
    			\"port_code\": \"IDCXP\",
    			\"port_name\": \"Cilacap\"
    		},
    		{
    			\"port_code\": \"IDDAS\",
    			\"port_name\": \"Singkep - Dabo\"
    		},
    		{
    			\"port_code\": \"IDDBO\",
    			\"port_name\": \"Dobo\"
    		},
    		{
    			\"port_code\": \"IDDGG\",
    			\"port_name\": \"Donggala\"
    		},
    		{
    			\"port_code\": \"IDDIL\",
    			\"port_name\": \"Dilli / Komoro (u)\"
    		},
    		{
    			\"port_code\": \"IDDIV\",
    			\"port_name\": \"Diviematra\"
    		},
    		{
    			\"port_code\": \"IDDJA\",
    			\"port_name\": \"Djankar\"
    		},
    		{
    			\"port_code\": \"IDDJB\",
    			\"port_name\": \"Jambi /palmerah/ Sulatan Taha (u)\"
    		},
    		{
    			\"port_code\": \"IDDJJ\",
    			\"port_name\": \"Jayapura / Sentani (u)\"
    		},
    		{
    			\"port_code\": \"IDDJM\",
    			\"port_name\": \"Jambi\"
    		},
    		{
    			\"port_code\": \"IDDMA\",
    			\"port_name\": \"Demta\"
    		},
    		{
    			\"port_code\": \"IDDOB\",
    			\"port_name\": \"Dobo\"
    		},
    		{
    			\"port_code\": \"IDDOG\",
    			\"port_name\": \"Donggala (u)\"
    		},
    		{
    			\"port_code\": \"IDDPS\",
    			\"port_name\": \"Denpasar / Ngurah Rai (u)\"
    		},
    		{
    			\"port_code\": \"IDDUM\",
    			\"port_name\": \"Dumai\"
    		},
    		{
    			\"port_code\": \"IDELA\",
    			\"port_name\": \"Elat\"
    		},
    		{
    			\"port_code\": \"IDEND\",
    			\"port_name\": \"Ende/ipi\"
    		},
    		{
    			\"port_code\": \"IDENE\",
    			\"port_name\": \"Ende / H.hasan Aroeboesman(u)\"
    		},
    		{
    			\"port_code\": \"IDENO\",
    			\"port_name\": \"Kuala Enok\"
    		},
    		{
    			\"port_code\": \"IDENT\",
    			\"port_name\": \"Entikong\"
    		},
    		{
    			\"port_code\": \"IDERT\",
    			\"port_name\": \"Eretan\"
    		},
    		{
    			\"port_code\": \"IDEWE\",
    			\"port_name\": \"Ewer\"
    		},
    		{
    			\"port_code\": \"IDEWI\",
    			\"port_name\": \"Enarotali , Rian Jaya\"
    		},
    		{
    			\"port_code\": \"IDFKQ\",
    			\"port_name\": \"Fak-fak\"
    		},
    		{
    			\"port_code\": \"IDFOO\",
    			\"port_name\": \"Numfoor\"
    		},
    		{
    			\"port_code\": \"IDFTG\",
    			\"port_name\": \"Pelabuhan Futong Terminal\"
    		},
    		{
    			\"port_code\": \"IDGAG\",
    			\"port_name\": \"Gag Island\"
    		},
    		{
    			\"port_code\": \"IDGAL\",
    			\"port_name\": \"Galala\"
    		},
    		{
    			\"port_code\": \"IDGEB\",
    			\"port_name\": \"Gebe\"
    		},
    		{
    			\"port_code\": \"IDGEE\",
    			\"port_name\": \"Gee I.\"
    		},
    		{
    			\"port_code\": \"IDGGT\",
    			\"port_name\": \"Giligenteng\"
    		},
    		{
    			\"port_code\": \"IDGIL\",
    			\"port_name\": \"Gilimanuk\"
    		},
    		{
    			\"port_code\": \"IDGLX\",
    			\"port_name\": \"Galela , Maluku\"
    		},
    		{
    			\"port_code\": \"IDGNS\",
    			\"port_name\": \"Gunung Sitoli\"
    		},
    		{
    			\"port_code\": \"IDGOR\",
    			\"port_name\": \"Gorontalo\"
    		},
    		{
    			\"port_code\": \"IDGRE\",
    			\"port_name\": \"Gresik\"
    		},
    		{
    			\"port_code\": \"IDGSR\",
    			\"port_name\": \"Geser\"
    		},
    		{
    			\"port_code\": \"IDGTO\",
    			\"port_name\": \"Gorontalo / Jalaluddin(u)\"
    		},
    		{
    			\"port_code\": \"IDHIN\",
    			\"port_name\": \"Hinako\"
    		},
    		{
    			\"port_code\": \"IDHLA\",
    			\"port_name\": \"Sukarnapura (western Irian)\"
    		},
    		{
    			\"port_code\": \"IDHLP\",
    			\"port_name\": \"Halim Perdana Kusuma (u)\"
    		},
    		{
    			\"port_code\": \"IDHLS\",
    			\"port_name\": \"Hulu Siau\"
    		},
    		{
    			\"port_code\": \"IDIAM\",
    			\"port_name\": \"Asam Asam\"
    		},
    		{
    			\"port_code\": \"IDIBL\",
    			\"port_name\": \"Bantul\"
    		},
    		{
    			\"port_code\": \"IDIBT\",
    			\"port_name\": \"Indonesia Bulk Terminal\"
    		},
    		{
    			\"port_code\": \"IDICU\",
    			\"port_name\": \"Cepu\"
    		},
    		{
    			\"port_code\": \"IDIDI\",
    			\"port_name\": \"Idi\"
    		},
    		{
    			\"port_code\": \"IDIGR\",
    			\"port_name\": \"Gianyar\"
    		},
    		{
    			\"port_code\": \"IDILA\",
    			\"port_name\": \"Illaga\"
    		},
    		{
    			\"port_code\": \"IDINA\",
    			\"port_name\": \"Inanwatan\"
    		},
    		{
    			\"port_code\": \"IDINO\",
    			\"port_name\": \"Inobonto\"
    		},
    		{
    			\"port_code\": \"IDISO\",
    			\"port_name\": \"Sawahlunto\"
    		},
    		{
    			\"port_code\": \"IDITN\",
    			\"port_name\": \"Tanjung Uban\"
    		},
    		{
    			\"port_code\": \"IDJBG\",
    			\"port_name\": \"Jatibarang\"
    		},
    		{
    			\"port_code\": \"IDJBK\",
    			\"port_name\": \"JABABEKA\"
    		},
    		{
    			\"port_code\": \"IDJBT\",
    			\"port_name\": \"Jabung Terminal\"
    		},
    		{
    			\"port_code\": \"IDJEM\",
    			\"port_name\": \"Jember\"
    		},
    		{
    			\"port_code\": \"IDJEP\",
    			\"port_name\": \"Jepara\"
    		},
    		{
    			\"port_code\": \"IDJKT\",
    			\"port_name\": \"Tg. Priok Jakarta\"
    		},
    		{
    			\"port_code\": \"IDJOG\",
    			\"port_name\": \"Yogyakarta / Adi Sucipto (u)\"
    		},
    		{
    			\"port_code\": \"IDJOK\",
    			\"port_name\": \"Yogyakarta (ptt)\"
    		},
    		{
    			\"port_code\": \"IDJTH\",
    			\"port_name\": \"Jatitujuh\"
    		},
    		{
    			\"port_code\": \"IDJUA\",
    			\"port_name\": \"Juata Tarakan\"
    		},
    		{
    			\"port_code\": \"IDKAB\",
    			\"port_name\": \"Kabil/panau\"
    		},
    		{
    			\"port_code\": \"IDKAH\",
    			\"port_name\": \"Kahayan Bay\"
    		},
    		{
    			\"port_code\": \"IDKAM\",
    			\"port_name\": \"Kambunong, Celebes\"
    		},
    		{
    			\"port_code\": \"IDKAR\",
    			\"port_name\": \"Karosa, Sulawesi\"
    		},
    		{
    			\"port_code\": \"IDKAS\",
    			\"port_name\": \"Kasim, Ij\"
    		},
    		{
    			\"port_code\": \"IDKAT\",
    			\"port_name\": \"Kalianget\"
    		},
    		{
    			\"port_code\": \"IDKAU\",
    			\"port_name\": \"Kau\"
    		},
    		{
    			\"port_code\": \"IDKBF\",
    			\"port_name\": \"Karubaga\"
    		},
    		{
    			\"port_code\": \"IDKBH\",
    			\"port_name\": \"Kalabahi\"
    		},
    		{
    			\"port_code\": \"IDKBU\",
    			\"port_name\": \"Kotabaru\"
    		},
    		{
    			\"port_code\": \"IDKCI\",
    			\"port_name\": \"Kon\"
    		},
    		{
    			\"port_code\": \"IDKDD\",
    			\"port_name\": \"Kedindi/reo\"
    		},
    		{
    			\"port_code\": \"IDKDI\",
    			\"port_name\": \"Kendari / Wolter Monginsidi (u)\"
    		},
    		{
    			\"port_code\": \"IDKDR\",
    			\"port_name\": \"Kendari\"
    		},
    		{
    			\"port_code\": \"IDKDW\",
    			\"port_name\": \"Kendawangan\"
    		},
    		{
    			\"port_code\": \"IDKEA\",
    			\"port_name\": \"Keisah\"
    		},
    		{
    			\"port_code\": \"IDKEI\",
    			\"port_name\": \"Kepi, Irian\"
    		},
    		{
    			\"port_code\": \"IDKEM\",
    			\"port_name\": \"Kempo, Sb\"
    		},
    		{
    			\"port_code\": \"IDKEN\",
    			\"port_name\": \"Kuala Enok\"
    		},
    		{
    			\"port_code\": \"IDKEQ\",
    			\"port_name\": \"Kebar, Irian Jaya\"
    		},
    		{
    			\"port_code\": \"IDKGD\",
    			\"port_name\": \"Kuala Gaung\"
    		},
    		{
    			\"port_code\": \"IDKGN\",
    			\"port_name\": \"Kangean\"
    		},
    		{
    			\"port_code\": \"IDKHY\",
    			\"port_name\": \"Kahyangan\"
    		},
    		{
    			\"port_code\": \"IDKID\",
    			\"port_name\": \"Pulau Kijang\"
    		},
    		{
    			\"port_code\": \"IDKIJ\",
    			\"port_name\": \"Kijang\"
    		},
    		{
    			\"port_code\": \"IDKJL\",
    			\"port_name\": \"Kuala Jelai\"
    		},
    		{
    			\"port_code\": \"IDKJN\",
    			\"port_name\": \"Kajang\"
    		},
    		{
    			\"port_code\": \"IDKKA\",
    			\"port_name\": \"Kuala Kapuas, Kl\"
    		},
    		{
    			\"port_code\": \"IDKKB\",
    			\"port_name\": \"Kunak, Borneo\"
    		},
    		{
    			\"port_code\": \"IDKKP\",
    			\"port_name\": \"Kuala Kapuas\"
    		},
    		{
    			\"port_code\": \"IDKLA\",
    			\"port_name\": \"Kamp. Laut\"
    		},
    		{
    			\"port_code\": \"IDKLB\",
    			\"port_name\": \"Kalibaru\"
    		},
    		{
    			\"port_code\": \"IDKLD\",
    			\"port_name\": \"Kolonedale (u)\"
    		},
    		{
    			\"port_code\": \"IDKLG\",
    			\"port_name\": \"Kalianget\"
    		},
    		{
    			\"port_code\": \"IDKLP\",
    			\"port_name\": \"Kuala Lipan\"
    		},
    		{
    			\"port_code\": \"IDKLQ\",
    			\"port_name\": \"Keluang\"
    		},
    		{
    			\"port_code\": \"IDKLS\",
    			\"port_name\": \"Kuala Langsa\"
    		},
    		{
    			\"port_code\": \"IDKLT\",
    			\"port_name\": \"Kaltim\"
    		},
    		{
    			\"port_code\": \"IDKMA\",
    			\"port_name\": \"Kuala Mandah\"
    		},
    		{
    			\"port_code\": \"IDKML\",
    			\"port_name\": \"Kamal\"
    		},
    		{
    			\"port_code\": \"IDKMM\",
    			\"port_name\": \"Kimam, Irian Jaya\"
    		},
    		{
    			\"port_code\": \"IDKND\",
    			\"port_name\": \"Kalianda\"
    		},
    		{
    			\"port_code\": \"IDKNG\",
    			\"port_name\": \"Kaimana\"
    		},
    		{
    			\"port_code\": \"IDKNL\",
    			\"port_name\": \"Kolonodale\"
    		},
    		{
    			\"port_code\": \"IDKNO\",
    			\"port_name\": \"Kuala Namu\"
    		},
    		{
    			\"port_code\": \"IDKOD\",
    			\"port_name\": \"Kotabangun\"
    		},
    		{
    			\"port_code\": \"IDKOE\",
    			\"port_name\": \"Kupang / El-tari (u)\"
    		},
    		{
    			\"port_code\": \"IDKOJ\",
    			\"port_name\": \"Koja\"
    		},
    		{
    			\"port_code\": \"IDKOK\",
    			\"port_name\": \"Kokonau\"
    		},
    		{
    			\"port_code\": \"IDKOL\",
    			\"port_name\": \"Kolaka\"
    		},
    		{
    			\"port_code\": \"IDKOX\",
    			\"port_name\": \"Kokonao\"
    		},
    		{
    			\"port_code\": \"IDKPB\",
    			\"port_name\": \"Kuala Pembuang\"
    		},
    		{
    			\"port_code\": \"IDKPN\",
    			\"port_name\": \"Kotapinang, Baru\"
    		},
    		{
    			\"port_code\": \"IDKPT\",
    			\"port_name\": \"Kuala Penet\"
    		},
    		{
    			\"port_code\": \"IDKRC\",
    			\"port_name\": \"Kerinci\"
    		},
    		{
    			\"port_code\": \"IDKRG\",
    			\"port_name\": \"Kariangau\"
    		},
    		{
    			\"port_code\": \"IDKRI\",
    			\"port_name\": \"Krui\"
    		},
    		{
    			\"port_code\": \"IDKRU\",
    			\"port_name\": \"Krueng Raja Malahayati\"
    		},
    		{
    			\"port_code\": \"IDKSE\",
    			\"port_name\": \"Kassue\"
    		},
    		{
    			\"port_code\": \"IDKSO\",
    			\"port_name\": \"Kalbut Situbondo\"
    		},
    		{
    			\"port_code\": \"IDKTA\",
    			\"port_name\": \"Kota Agung\"
    		},
    		{
    			\"port_code\": \"IDKTB\",
    			\"port_name\": \"Kotabaru\"
    		},
    		{
    			\"port_code\": \"IDKTG\",
    			\"port_name\": \"Ketapang Kalimantan Barat\"
    		},
    		{
    			\"port_code\": \"IDKTJ\",
    			\"port_name\": \"Kuala Tanjung\"
    		},
    		{
    			\"port_code\": \"IDKTK\",
    			\"port_name\": \"Kuala Tungkal\"
    		},
    		{
    			\"port_code\": \"IDKTP\",
    			\"port_name\": \"Ketapang Jawa Timur\"
    		},
    		{
    			\"port_code\": \"IDKUA\",
    			\"port_name\": \"Kuandang\"
    		},
    		{
    			\"port_code\": \"IDKUM\",
    			\"port_name\": \"Kumai\"
    		},
    		{
    			\"port_code\": \"IDKWA\",
    			\"port_name\": \"Kwanyar\"
    		},
    		{
    			\"port_code\": \"IDLAB\",
    			\"port_name\": \"Labuha Maluku\"
    		},
    		{
    			\"port_code\": \"IDLAH\",
    			\"port_name\": \"Labuhan, Java\"
    		},
    		{
    			\"port_code\": \"IDLAJ\",
    			\"port_name\": \"Labuhan\"
    		},
    		{
    			\"port_code\": \"IDLAL\",
    			\"port_name\": \"Labuhan Alas\"
    		},
    		{
    			\"port_code\": \"IDLAS\",
    			\"port_name\": \"Langsa, Sumatra\"
    		},
    		{
    			\"port_code\": \"IDLAT\",
    			\"port_name\": \"Lalang Terminal, St\"
    		},
    		{
    			\"port_code\": \"IDLBI\",
    			\"port_name\": \"Labuhan Bilik\"
    		},
    		{
    			\"port_code\": \"IDLBJ\",
    			\"port_name\": \"Labuanbajo\"
    		},
    		{
    			\"port_code\": \"IDLBM\",
    			\"port_name\": \"Lobam\"
    		},
    		{
    			\"port_code\": \"IDLBW\",
    			\"port_name\": \"Long Bawan\"
    		},
    		{
    			\"port_code\": \"IDLEI\",
    			\"port_name\": \"Leidong\"
    		},
    		{
    			\"port_code\": \"IDLEM\",
    			\"port_name\": \"Lembar\"
    		},
    		{
    			\"port_code\": \"IDLHA\",
    			\"port_name\": \"Labuhan Haji, Ntb\"
    		},
    		{
    			\"port_code\": \"IDLHI\",
    			\"port_name\": \"Lereh\"
    		},
    		{
    			\"port_code\": \"IDLHJ\",
    			\"port_name\": \"Labuhan Haji Aceh\"
    		},
    		{
    			\"port_code\": \"IDLHK\",
    			\"port_name\": \"Lhok Nga\"
    		},
    		{
    			\"port_code\": \"IDLHW\",
    			\"port_name\": \"Lahewa\"
    		},
    		{
    			\"port_code\": \"IDLIF\",
    			\"port_name\": \"Lifamatola\"
    		},
    		{
    			\"port_code\": \"IDLII\",
    			\"port_name\": \"Mulia\"
    		},
    		{
    			\"port_code\": \"IDLIN\",
    			\"port_name\": \"Lingkas Tarakan\"
    		},
    		{
    			\"port_code\": \"IDLIR\",
    			\"port_name\": \"Lirung\"
    		},
    		{
    			\"port_code\": \"IDLKA\",
    			\"port_name\": \"Larantuka\"
    		},
    		{
    			\"port_code\": \"IDLKI\",
    			\"port_name\": \"Loki\"
    		},
    		{
    			\"port_code\": \"IDLKS\",
    			\"port_name\": \"Lombok\"
    		},
    		{
    			\"port_code\": \"IDLLA\",
    			\"port_name\": \"Lawe-Lawe, Kl\"
    		},
    		{
    			\"port_code\": \"IDLLN\",
    			\"port_name\": \"Kelila\"
    		},
    		{
    			\"port_code\": \"IDLLY\",
    			\"port_name\": \"Labuhan Layar\"
    		},
    		{
    			\"port_code\": \"IDLMA\",
    			\"port_name\": \"Labuhan Maringgai\"
    		},
    		{
    			\"port_code\": \"IDLMB\",
    			\"port_name\": \"Lombok Strait\"
    		},
    		{
    			\"port_code\": \"IDLOB\",
    			\"port_name\": \"Lower Buchanan\"
    		},
    		{
    			\"port_code\": \"IDLOL\",
    			\"port_name\": \"Loli\"
    		},
    		{
    			\"port_code\": \"IDLOM\",
    			\"port_name\": \"Lombok\"
    		},
    		{
    			\"port_code\": \"IDLPU\",
    			\"port_name\": \"Long Apung\"
    		},
    		{
    			\"port_code\": \"IDLRT\",
    			\"port_name\": \"Larat\"
    		},
    		{
    			\"port_code\": \"IDLSW\",
    			\"port_name\": \"Lhok Seumawe\"
    		},
    		{
    			\"port_code\": \"IDLSX\",
    			\"port_name\": \"Lhok Sukon\"
    		},
    		{
    			\"port_code\": \"IDLUB\",
    			\"port_name\": \"Lubuk Besar Bangka\"
    		},
    		{
    			\"port_code\": \"IDLUK\",
    			\"port_name\": \"Labuhan Uki\"
    		},
    		{
    			\"port_code\": \"IDLUV\",
    			\"port_name\": \"Tual\"
    		},
    		{
    			\"port_code\": \"IDLUW\",
    			\"port_name\": \"Luwuk\"
    		},
    		{
    			\"port_code\": \"IDLWE\",
    			\"port_name\": \"Lewoleba\"
    		},
    		{
    			\"port_code\": \"IDLYK\",
    			\"port_name\": \"Lunyuk\"
    		},
    		{
    			\"port_code\": \"IDMAD\",
    			\"port_name\": \"Madiun / Iswahyudi (u)\"
    		},
    		{
    			\"port_code\": \"IDMAI\",
    			\"port_name\": \"Mapia I.s\"
    		},
    		{
    			\"port_code\": \"IDMAJ\",
    			\"port_name\": \"Majene\"
    		},
    		{
    			\"port_code\": \"IDMAK\",
    			\"port_name\": \"Makassar\"
    		},
    		{
    			\"port_code\": \"IDMAL\",
    			\"port_name\": \"Mangole\"
    		},
    		{
    			\"port_code\": \"IDMAN\",
    			\"port_name\": \"Manggar\"
    		},
    		{
    			\"port_code\": \"IDMAR\",
    			\"port_name\": \"Marabahan\"
    		},
    		{
    			\"port_code\": \"IDMAU\",
    			\"port_name\": \"Mau Hau (u)\"
    		},
    		{
    			\"port_code\": \"IDMBK\",
    			\"port_name\": \"Muara Bangkong\"
    		},
    		{
    			\"port_code\": \"IDMBS\",
    			\"port_name\": \"Muara Bungus\"
    		},
    		{
    			\"port_code\": \"IDMDC\",
    			\"port_name\": \"Menado / Sam Ratulangi (u)\"
    		},
    		{
    			\"port_code\": \"IDMDP\",
    			\"port_name\": \"Mindiptanah\"
    		},
    		{
    			\"port_code\": \"IDMDR\",
    			\"port_name\": \"Madura Terminal\"
    		},
    		{
    			\"port_code\": \"IDMEM\",
    			\"port_name\": \"Mempawah\"
    		},
    		{
    			\"port_code\": \"IDMEQ\",
    			\"port_name\": \"Meulaboh\"
    		},
    		{
    			\"port_code\": \"IDMES\",
    			\"port_name\": \"Medan / Polonia (u)\"
    		},
    		{
    			\"port_code\": \"IDMGB\",
    			\"port_name\": \"Manggis\"
    		},
    		{
    			\"port_code\": \"IDMIT\",
    			\"port_name\": \"Misool Terminal\"
    		},
    		{
    			\"port_code\": \"IDMJU\",
    			\"port_name\": \"Mamuju\"
    		},
    		{
    			\"port_code\": \"IDMJY\",
    			\"port_name\": \"Mangunjaya\"
    		},
    		{
    			\"port_code\": \"IDMKJ\",
    			\"port_name\": \"Mangkajang\"
    		},
    		{
    			\"port_code\": \"IDMKQ\",
    			\"port_name\": \"Merauke\"
    		},
    		{
    			\"port_code\": \"IDMKW\",
    			\"port_name\": \"Manokwari\"
    		},
    		{
    			\"port_code\": \"IDMLG\",
    			\"port_name\": \"Malang / Abdulrachman Saleh (u)\"
    		},
    		{
    			\"port_code\": \"IDMLI\",
    			\"port_name\": \"Malili, Sulawesi\"
    		},
    		{
    			\"port_code\": \"IDMNA\",
    			\"port_name\": \"Sangir Talaud / Melangguane (u)\"
    		},
    		{
    			\"port_code\": \"IDMND\",
    			\"port_name\": \"Manado\"
    		},
    		{
    			\"port_code\": \"IDMNT\",
    			\"port_name\": \"Mantang, Riau\"
    		},
    		{
    			\"port_code\": \"IDMOF\",
    			\"port_name\": \"Maumere\"
    		},
    		{
    			\"port_code\": \"IDMOR\",
    			\"port_name\": \"Moro Sulit\"
    		},
    		{
    			\"port_code\": \"IDMPA\",
    			\"port_name\": \"Muara Padang\"
    		},
    		{
    			\"port_code\": \"IDMPC\",
    			\"port_name\": \"Muko-Muko\"
    		},
    		{
    			\"port_code\": \"IDMPS\",
    			\"port_name\": \"Muara Pasir\"
    		},
    		{
    			\"port_code\": \"IDMPT\",
    			\"port_name\": \"Maliana\"
    		},
    		{
    			\"port_code\": \"IDMRB\",
    			\"port_name\": \"Merantibunting, Sumatra\"
    		},
    		{
    			\"port_code\": \"IDMRI\",
    			\"port_name\": \"Musi River, Sumatra\"
    		},
    		{
    			\"port_code\": \"IDMRK\",
    			\"port_name\": \"Merak\"
    		},
    		{
    			\"port_code\": \"IDMSA\",
    			\"port_name\": \"Muara Sabak\"
    		},
    		{
    			\"port_code\": \"IDMSB\",
    			\"port_name\": \"Muara Siberut\"
    		},
    		{
    			\"port_code\": \"IDMSI\",
    			\"port_name\": \"Masalembo\"
    		},
    		{
    			\"port_code\": \"IDMTU\",
    			\"port_name\": \"Muturi\"
    		},
    		{
    			\"port_code\": \"IDMUB\",
    			\"port_name\": \"Muara Berau\"
    		},
    		{
    			\"port_code\": \"IDMUD\",
    			\"port_name\": \"Muara Djawa\"
    		},
    		{
    			\"port_code\": \"IDMUF\",
    			\"port_name\": \"Muting\"
    		},
    		{
    			\"port_code\": \"IDMUN\",
    			\"port_name\": \"Muncar\"
    		},
    		{
    			\"port_code\": \"IDMUO\",
    			\"port_name\": \"Muntok\"
    		},
    		{
    			\"port_code\": \"IDMUP\",
    			\"port_name\": \"Muara Pegah\"
    		},
    		{
    			\"port_code\": \"IDMWK\",
    			\"port_name\": \"Matak\"
    		},
    		{
    			\"port_code\": \"IDMXB\",
    			\"port_name\": \"Masamba\"
    		},
    		{
    			\"port_code\": \"IDNAF\",
    			\"port_name\": \"Banaina\"
    		},
    		{
    			\"port_code\": \"IDNAH\",
    			\"port_name\": \"Tahuna / Naha (u) - Sulut\"
    		},
    		{
    			\"port_code\": \"IDNAM\",
    			\"port_name\": \"Namlea\"
    		},
    		{
    			\"port_code\": \"IDNAT\",
    			\"port_name\": \"Natal\"
    		},
    		{
    			\"port_code\": \"IDNBF\",
    			\"port_name\": \"Nanga Badau\"
    		},
    		{
    			\"port_code\": \"IDNBX\",
    			\"port_name\": \"Nabire , Irian Jaya\"
    		},
    		{
    			\"port_code\": \"IDNDA\",
    			\"port_name\": \"Bandanaira\"
    		},
    		{
    			\"port_code\": \"IDNEG\",
    			\"port_name\": \"Negara\"
    		},
    		{
    			\"port_code\": \"IDNIP\",
    			\"port_name\": \"Nipah Panjang\"
    		},
    		{
    			\"port_code\": \"IDNKD\",
    			\"port_name\": \"Sinak\"
    		},
    		{
    			\"port_code\": \"IDNNX\",
    			\"port_name\": \"Nunukan\"
    		},
    		{
    			\"port_code\": \"IDNON\",
    			\"port_name\": \"Nongsa\"
    		},
    		{
    			\"port_code\": \"IDNPL\",
    			\"port_name\": \"North Pulau Laut\"
    		},
    		{
    			\"port_code\": \"IDNPO\",
    			\"port_name\": \"Nangapinoh\"
    		},
    		{
    			\"port_code\": \"IDNRE\",
    			\"port_name\": \"Namrole\"
    		},
    		{
    			\"port_code\": \"IDNTI\",
    			\"port_name\": \"Bintuni, Irian Jaya\"
    		},
    		{
    			\"port_code\": \"IDNTX\",
    			\"port_name\": \"Natuna Ranai\"
    		},
    		{
    			\"port_code\": \"IDOBD\",
    			\"port_name\": \"Obano\"
    		},
    		{
    			\"port_code\": \"IDOBI\",
    			\"port_name\": \"Obi Island\"
    		},
    		{
    			\"port_code\": \"IDOEC\",
    			\"port_name\": \"Ocussi\"
    		},
    		{
    			\"port_code\": \"IDOJA\",
    			\"port_name\": \"Olah Jasa Andal/Jakarta\"
    		},
    		{
    			\"port_code\": \"IDOKA\",
    			\"port_name\": \"Karimun Besar Offshore\"
    		},
    		{
    			\"port_code\": \"IDOKL\",
    			\"port_name\": \"Oksibil\"
    		},
    		{
    			\"port_code\": \"IDOKQ\",
    			\"port_name\": \"Okaba, Irian Jaya\"
    		},
    		{
    			\"port_code\": \"IDOLO\",
    			\"port_name\": \"Ulee Lheue\"
    		},
    		{
    			\"port_code\": \"IDONI\",
    			\"port_name\": \"Moanamani\"
    		},
    		{
    			\"port_code\": \"IDORA\",
    			\"port_name\": \"Oransbari\"
    		},
    		{
    			\"port_code\": \"IDOZI\",
    			\"port_name\": \"Morotai I\"
    		},
    		{
    			\"port_code\": \"IDPAC\",
    			\"port_name\": \"Pacitan\"
    		},
    		{
    			\"port_code\": \"IDPAD\",
    			\"port_name\": \"Padang (ptt)\"
    		},
    		{
    			\"port_code\": \"IDPAG\",
    			\"port_name\": \"Pegatan\"
    		},
    		{
    			\"port_code\": \"IDPAI\",
    			\"port_name\": \"Panipahan\"
    		},
    		{
    			\"port_code\": \"IDPAJ\",
    			\"port_name\": \"Panjalai\"
    		},
    		{
    			\"port_code\": \"IDPAK\",
    			\"port_name\": \"Pekan Baru\"
    		},
    		{
    			\"port_code\": \"IDPAL\",
    			\"port_name\": \"Palimanan\"
    		},
    		{
    			\"port_code\": \"IDPAO\",
    			\"port_name\": \"Paloh\"
    		},
    		{
    			\"port_code\": \"IDPAP\",
    			\"port_name\": \"Pare-pare\"
    		},
    		{
    			\"port_code\": \"IDPAR\",
    			\"port_name\": \"Pangkalan Air (u)\"
    		},
    		{
    			\"port_code\": \"IDPAS\",
    			\"port_name\": \"Pasir Panjang\"
    		},
    		{
    			\"port_code\": \"IDPAT\",
    			\"port_name\": \"Pantoloan\"
    		},
    		{
    			\"port_code\": \"IDPAZ\",
    			\"port_name\": \"Pasuruan\"
    		},
    		{
    			\"port_code\": \"IDPBA\",
    			\"port_name\": \"Pulau Baai\"
    		},
    		{
    			\"port_code\": \"IDPBG\",
    			\"port_name\": \"Perbaungan\"
    		},
    		{
    			\"port_code\": \"IDPBJ\",
    			\"port_name\": \"Pulo Bunju, Borneo\"
    		},
    		{
    			\"port_code\": \"IDPBL\",
    			\"port_name\": \"Pulau Buluh\"
    		},
    		{
    			\"port_code\": \"IDPBN\",
    			\"port_name\": \"Pulau Banyak\"
    		},
    		{
    			\"port_code\": \"IDPBW\",
    			\"port_name\": \"Palibelo\"
    		},
    		{
    			\"port_code\": \"IDPCB\",
    			\"port_name\": \"Pondok Cabe\"
    		},
    		{
    			\"port_code\": \"IDPDB\",
    			\"port_name\": \"Padang Baai\"
    		},
    		{
    			\"port_code\": \"IDPDG\",
    			\"port_name\": \"Padang / Tabing (u)\"
    		},
    		{
    			\"port_code\": \"IDPDJ\",
    			\"port_name\": \"Tandjang\"
    		},
    		{
    			\"port_code\": \"IDPDO\",
    			\"port_name\": \"Pangkalan Dode\"
    		},
    		{
    			\"port_code\": \"IDPDU\",
    			\"port_name\": \"Pangkal Duri\"
    		},
    		{
    			\"port_code\": \"IDPEF\",
    			\"port_name\": \"Penfui (u)\"
    		},
    		{
    			\"port_code\": \"IDPEK\",
    			\"port_name\": \"Pekanbaru (rumbai)\"
    		},
    		{
    			\"port_code\": \"IDPEM\",
    			\"port_name\": \"Pemangkat\"
    		},
    		{
    			\"port_code\": \"IDPEN\",
    			\"port_name\": \"Pemanukan\"
    		},
    		{
    			\"port_code\": \"IDPER\",
    			\"port_name\": \"Perawang\"
    		},
    		{
    			\"port_code\": \"IDPET\",
    			\"port_name\": \"Petta\"
    		},
    		{
    			\"port_code\": \"IDPEU\",
    			\"port_name\": \"Penuba\"
    		},
    		{
    			\"port_code\": \"IDPEX\",
    			\"port_name\": \"Pekalongan\"
    		},
    		{
    			\"port_code\": \"IDPGA\",
    			\"port_name\": \"Pagerungan\"
    		},
    		{
    			\"port_code\": \"IDPGE\",
    			\"port_name\": \"Pulau Gebe\"
    		},
    		{
    			\"port_code\": \"IDPGK\",
    			\"port_name\": \"Pangkal Pinang (u)\"
    		},
    		{
    			\"port_code\": \"IDPGM\",
    			\"port_name\": \"Pagimana\"
    		},
    		{
    			\"port_code\": \"IDPGX\",
    			\"port_name\": \"Pangkal Balam /pkl.pinang\"
    		},
    		{
    			\"port_code\": \"IDPIN\",
    			\"port_name\": \"Pinrang\"
    		},
    		{
    			\"port_code\": \"IDPIR\",
    			\"port_name\": \"Piru\"
    		},
    		{
    			\"port_code\": \"IDPJG\",
    			\"port_name\": \"Panjang (lampung, Sumatra)\"
    		},
    		{
    			\"port_code\": \"IDPJM\",
    			\"port_name\": \"Pandjung Mani\"
    		},
    		{
    			\"port_code\": \"IDPKN\",
    			\"port_name\": \"Pangkalan Bun\"
    		},
    		{
    			\"port_code\": \"IDPKR\",
    			\"port_name\": \"Pangkalan Brandan\"
    		},
    		{
    			\"port_code\": \"IDPKS\",
    			\"port_name\": \"Pangkalan Susu, Sumatra\"
    		},
    		{
    			\"port_code\": \"IDPKU\",
    			\"port_name\": \"Pekan Baru / Simpang Tiga (u)\"
    		},
    		{
    			\"port_code\": \"IDPKY\",
    			\"port_name\": \"Palangkaraya/ Panarung (u)/ Tjilik  Riwut (u)\"
    		},
    		{
    			\"port_code\": \"IDPLA\",
    			\"port_name\": \"Palembang - Plaju\"
    		},
    		{
    			\"port_code\": \"IDPLM\",
    			\"port_name\": \"Palembang /talang Betutu /sm.badaruddin (u)\"
    		},
    		{
    			\"port_code\": \"IDPLS\",
    			\"port_name\": \"Palembang -  Kertapati\"
    		},
    		{
    			\"port_code\": \"IDPLW\",
    			\"port_name\": \"Palu / Mutiara (u)\"
    		},
    		{
    			\"port_code\": \"IDPMA\",
    			\"port_name\": \"Pegatan Mendawai\"
    		},
    		{
    			\"port_code\": \"IDPMC\",
    			\"port_name\": \"Pante Macassar\"
    		},
    		{
    			\"port_code\": \"IDPMG\",
    			\"port_name\": \"Meneng\"
    		},
    		{
    			\"port_code\": \"IDPMK\",
    			\"port_name\": \"Pomako\"
    		},
    		{
    			\"port_code\": \"IDPNG\",
    			\"port_name\": \"Penuba\"
    		},
    		{
    			\"port_code\": \"IDPNJ\",
    			\"port_name\": \"Panjang\"
    		},
    		{
    			\"port_code\": \"IDPNK\",
    			\"port_name\": \"Pontianak / Supadio (u)\"
    		},
    		{
    			\"port_code\": \"IDPNN\",
    			\"port_name\": \"Pamanukan, Java\"
    		},
    		{
    			\"port_code\": \"IDPNT\",
    			\"port_name\": \"Prointal, Jv\"
    		},
    		{
    			\"port_code\": \"IDPOE\",
    			\"port_name\": \"Polewali\"
    		},
    		{
    			\"port_code\": \"IDPOL\",
    			\"port_name\": \"Poleng\"
    		},
    		{
    			\"port_code\": \"IDPON\",
    			\"port_name\": \"Pontianak\"
    		},
    		{
    			\"port_code\": \"IDPOT\",
    			\"port_name\": \"Poto Tano\"
    		},
    		{
    			\"port_code\": \"IDPPA\",
    			\"port_name\": \"Pulau Palas\"
    		},
    		{
    			\"port_code\": \"IDPPJ\",
    			\"port_name\": \"Pulau Panjang\"
    		},
    		{
    			\"port_code\": \"IDPPO\",
    			\"port_name\": \"Palopo\"
    		},
    		{
    			\"port_code\": \"IDPPR\",
    			\"port_name\": \"Pasir Pangarayan\"
    		},
    		{
    			\"port_code\": \"IDPPS\",
    			\"port_name\": \"Pulang Pisau\"
    		},
    		{
    			\"port_code\": \"IDPRA\",
    			\"port_name\": \"Perigi Raja\"
    		},
    		{
    			\"port_code\": \"IDPRG\",
    			\"port_name\": \"Parigi\"
    		},
    		{
    			\"port_code\": \"IDPRN\",
    			\"port_name\": \"Panarukan\"
    		},
    		{
    			\"port_code\": \"IDPRO\",
    			\"port_name\": \"Probolinggo (kalibuntu)\"
    		},
    		{
    			\"port_code\": \"IDPSB\",
    			\"port_name\": \"Jakarta / Pos Pasar Baru (ptt)\"
    		},
    		{
    			\"port_code\": \"IDPSE\",
    			\"port_name\": \"Pulau Sembilan\"
    		},
    		{
    			\"port_code\": \"IDPSJ\",
    			\"port_name\": \"Posso\"
    		},
    		{
    			\"port_code\": \"IDPSS\",
    			\"port_name\": \"Pulau Sambu\"
    		},
    		{
    			\"port_code\": \"IDPSU\",
    			\"port_name\": \"Pangkalan Susu\"
    		},
    		{
    			\"port_code\": \"IDPTE\",
    			\"port_name\": \"Pulau Tello\"
    		},
    		{
    			\"port_code\": \"IDPTL\",
    			\"port_name\": \"Pantoloan, Sv\"
    		},
    		{
    			\"port_code\": \"IDPTO\",
    			\"port_name\": \"Port Okha\"
    		},
    		{
    			\"port_code\": \"IDPTR\",
    			\"port_name\": \"Puteran\"
    		},
    		{
    			\"port_code\": \"IDPUM\",
    			\"port_name\": \"Pomalaa\"
    		},
    		{
    			\"port_code\": \"IDPUR\",
    			\"port_name\": \"Purwakarta\"
    		},
    		{
    			\"port_code\": \"IDPUT\",
    			\"port_name\": \"Pulau Laut\"
    		},
    		{
    			\"port_code\": \"IDPWG\",
    			\"port_name\": \"Perawang, Sumatra\"
    		},
    		{
    			\"port_code\": \"IDPWL\",
    			\"port_name\": \"Purwokerto\"
    		},
    		{
    			\"port_code\": \"IDRAA\",
    			\"port_name\": \"Raas\"
    		},
    		{
    			\"port_code\": \"IDRAB\",
    			\"port_name\": \"Raba\"
    		},
    		{
    			\"port_code\": \"IDRAM\",
    			\"port_name\": \"Rambipuji Jember\"
    		},
    		{
    			\"port_code\": \"IDRAN\",
    			\"port_name\": \"Ranai\"
    		},
    		{
    			\"port_code\": \"IDRAQ\",
    			\"port_name\": \"Raha, Sul.tengg.\"
    		},
    		{
    			\"port_code\": \"IDRDE\",
    			\"port_name\": \"Merdey\"
    		},
    		{
    			\"port_code\": \"IDREM\",
    			\"port_name\": \"Rembang\"
    		},
    		{
    			\"port_code\": \"IDREO\",
    			\"port_name\": \"Reo\"
    		},
    		{
    			\"port_code\": \"IDRGA\",
    			\"port_name\": \"Rengat\"
    		},
    		{
    			\"port_code\": \"IDRGT\",
    			\"port_name\": \"Rengat/ Japura (u)\"
    		},
    		{
    			\"port_code\": \"IDRKI\",
    			\"port_name\": \"Rokot\"
    		},
    		{
    			\"port_code\": \"IDRKO\",
    			\"port_name\": \"Sipora\"
    		},
    		{
    			\"port_code\": \"IDRNI\",
    			\"port_name\": \"Ranai\"
    		},
    		{
    			\"port_code\": \"IDRPA\",
    			\"port_name\": \"Rantau Panjang\"
    		},
    		{
    			\"port_code\": \"IDRSK\",
    			\"port_name\": \"Ransiki\"
    		},
    		{
    			\"port_code\": \"IDRTG\",
    			\"port_name\": \"Ruteng, Flores\"
    		},
    		{
    			\"port_code\": \"IDRTI\",
    			\"port_name\": \"Roti\"
    		},
    		{
    			\"port_code\": \"IDRUF\",
    			\"port_name\": \"Yuruf\"
    		},
    		{
    			\"port_code\": \"IDRUN\",
    			\"port_name\": \"Rungkut\"
    		},
    		{
    			\"port_code\": \"IDSAB\",
    			\"port_name\": \"Sabang - Sulawesi\"
    		},
    		{
    			\"port_code\": \"IDSAD\",
    			\"port_name\": \"Sadau, Borneo\"
    		},
    		{
    			\"port_code\": \"IDSAE\",
    			\"port_name\": \"Sangir\"
    		},
    		{
    			\"port_code\": \"IDSAG\",
    			\"port_name\": \"Sangit\"
    		},
    		{
    			\"port_code\": \"IDSAK\",
    			\"port_name\": \"Sangkapura / Bawean\"
    		},
    		{
    			\"port_code\": \"IDSAM\",
    			\"port_name\": \"Sampang\"
    		},
    		{
    			\"port_code\": \"IDSAN\",
    			\"port_name\": \"Sanang, Celebes\"
    		},
    		{
    			\"port_code\": \"IDSAP\",
    			\"port_name\": \"Sungai Apit\"
    		},
    		{
    			\"port_code\": \"IDSAR\",
    			\"port_name\": \"Sarangan\"
    		},
    		{
    			\"port_code\": \"IDSAS\",
    			\"port_name\": \"Sasayap\"
    		},
    		{
    			\"port_code\": \"IDSAT\",
    			\"port_name\": \"Santan Terminal, Kl\"
    		},
    		{
    			\"port_code\": \"IDSAU\",
    			\"port_name\": \"Sawu\"
    		},
    		{
    			\"port_code\": \"IDSBG\",
    			\"port_name\": \"Aceh - Sabang\"
    		},
    		{
    			\"port_code\": \"IDSBJ\",
    			\"port_name\": \"Semboja\"
    		},
    		{
    			\"port_code\": \"IDSBM\",
    			\"port_name\": \"Subaim\"
    		},
    		{
    			\"port_code\": \"IDSBR\",
    			\"port_name\": \"Sungai Brombang\"
    		},
    		{
    			\"port_code\": \"IDSBS\",
    			\"port_name\": \"Sambas\"
    		},
    		{
    			\"port_code\": \"IDSDA\",
    			\"port_name\": \"Sungai Danai\"
    		},
    		{
    			\"port_code\": \"IDSDJ\",
    			\"port_name\": \"Sidoarjo\"
    		},
    		{
    			\"port_code\": \"IDSDU\",
    			\"port_name\": \"Sungai Duri\"
    		},
    		{
    			\"port_code\": \"IDSEB\",
    			\"port_name\": \"Sebangan Bay, Kalimantan\"
    		},
    		{
    			\"port_code\": \"IDSEG\",
    			\"port_name\": \"Segama, Borneo\"
    		},
    		{
    			\"port_code\": \"IDSEH\",
    			\"port_name\": \"Senggeh\"
    		},
    		{
    			\"port_code\": \"IDSEM\",
    			\"port_name\": \"Sembakung\"
    		},
    		{
    			\"port_code\": \"IDSEN\",
    			\"port_name\": \"Senipah\"
    		},
    		{
    			\"port_code\": \"IDSEQ\",
    			\"port_name\": \"Sungai Pakning\"
    		},
    		{
    			\"port_code\": \"IDSER\",
    			\"port_name\": \"Serang\"
    		},
    		{
    			\"port_code\": \"IDSGO\",
    			\"port_name\": \"Port Segoro Fajar Satryo/Jakarta\"
    		},
    		{
    			\"port_code\": \"IDSGQ\",
    			\"port_name\": \"Sanggata\"
    		},
    		{
    			\"port_code\": \"IDSGU\",
    			\"port_name\": \"Sanggau\"
    		},
    		{
    			\"port_code\": \"IDSIA\",
    			\"port_name\": \"Siak Yechil, Riau\"
    		},
    		{
    			\"port_code\": \"IDSID\",
    			\"port_name\": \"Sidangoli\"
    		},
    		{
    			\"port_code\": \"IDSIG\",
    			\"port_name\": \"Sigli\"
    		},
    		{
    			\"port_code\": \"IDSIM\",
    			\"port_name\": \"Simandulang\"
    		},
    		{
    			\"port_code\": \"IDSIN\",
    			\"port_name\": \"Sinabang\"
    		},
    		{
    			\"port_code\": \"IDSIQ\",
    			\"port_name\": \"Singkep/ Dabo (u)\"
    		},
    		{
    			\"port_code\": \"IDSIW\",
    			\"port_name\": \"Sibisa\"
    		},
    		{
    			\"port_code\": \"IDSKE\",
    			\"port_name\": \"Sungai Kembung\"
    		},
    		{
    			\"port_code\": \"IDSKI\",
    			\"port_name\": \"Sangkulirang, Kalimantan\"
    		},
    		{
    			\"port_code\": \"IDSKK\",
    			\"port_name\": \"Soengei Kolak\"
    		},
    		{
    			\"port_code\": \"IDSKL\",
    			\"port_name\": \"Singkel\"
    		},
    		{
    			\"port_code\": \"IDSKP\",
    			\"port_name\": \"Sekupang\"
    		},
    		{
    			\"port_code\": \"IDSKR\",
    			\"port_name\": \"Sekura\"
    		},
    		{
    			\"port_code\": \"IDSKT\",
    			\"port_name\": \"Surakarta\"
    		},
    		{
    			\"port_code\": \"IDSKW\",
    			\"port_name\": \"Singkawang\"
    		},
    		{
    			\"port_code\": \"IDSLG\",
    			\"port_name\": \"Sibolga\"
    		},
    		{
    			\"port_code\": \"IDSLI\",
    			\"port_name\": \"Sungai Liat\"
    		},
    		{
    			\"port_code\": \"IDSLK\",
    			\"port_name\": \"Selakau\"
    		},
    		{
    			\"port_code\": \"IDSLY\",
    			\"port_name\": \"Selayar\"
    		},
    		{
    			\"port_code\": \"IDSMB\",
    			\"port_name\": \"Semangka Bay, St\"
    		},
    		{
    			\"port_code\": \"IDSMD\",
    			\"port_name\": \"Semuda\"
    		},
    		{
    			\"port_code\": \"IDSME\",
    			\"port_name\": \"Simpang Empat\"
    		},
    		{
    			\"port_code\": \"IDSMK\",
    			\"port_name\": \"Semplak\"
    		},
    		{
    			\"port_code\": \"IDSMQ\",
    			\"port_name\": \"Sampit\"
    		},
    		{
    			\"port_code\": \"IDSMR\",
    			\"port_name\": \"Semarang (ptt)\"
    		},
    		{
    			\"port_code\": \"IDSNB\",
    			\"port_name\": \"Sinaboi\"
    		},
    		{
    			\"port_code\": \"IDSNG\",
    			\"port_name\": \"Sinabang\"
    		},
    		{
    			\"port_code\": \"IDSNK\",
    			\"port_name\": \"Simbur Naik\"
    		},
    		{
    			\"port_code\": \"IDSNN\",
    			\"port_name\": \"Sanana\"
    		},
    		{
    			\"port_code\": \"IDSNR\",
    			\"port_name\": \"Sanur\"
    		},
    		{
    			\"port_code\": \"IDSOC\",
    			\"port_name\": \"Solo / Jebres / Adi Sumarmo (u)\"
    		},
    		{
    			\"port_code\": \"IDSOQ\",
    			\"port_name\": \"Sorong / Jefman (u)\"
    		},
    		{
    			\"port_code\": \"IDSOR\",
    			\"port_name\": \"Sorong\"
    		},
    		{
    			\"port_code\": \"IDSPA\",
    			\"port_name\": \"Selat Panjang\"
    		},
    		{
    			\"port_code\": \"IDSPD\",
    			\"port_name\": \"Sapudi\"
    		},
    		{
    			\"port_code\": \"IDSPH\",
    			\"port_name\": \"Sapeh\"
    		},
    		{
    			\"port_code\": \"IDSPI\",
    			\"port_name\": \"Sungai Pinyuh\"
    		},
    		{
    			\"port_code\": \"IDSPK\",
    			\"port_name\": \"Sepekan\"
    		},
    		{
    			\"port_code\": \"IDSPL\",
    			\"port_name\": \"Sepulu\"
    		},
    		{
    			\"port_code\": \"IDSPT\",
    			\"port_name\": \"Sapat\"
    		},
    		{
    			\"port_code\": \"IDSQG\",
    			\"port_name\": \"Sintang\"
    		},
    		{
    			\"port_code\": \"IDSQN\",
    			\"port_name\": \"Sanana\"
    		},
    		{
    			\"port_code\": \"IDSQR\",
    			\"port_name\": \"Soroako\"
    		},
    		{
    			\"port_code\": \"IDSRD\",
    			\"port_name\": \"Samarinda\"
    		},
    		{
    			\"port_code\": \"IDSRG\",
    			\"port_name\": \"Semarang / Achmad Yani (u)\"
    		},
    		{
    			\"port_code\": \"IDSRI\",
    			\"port_name\": \"Samarinda / Temindung (u)\"
    		},
    		{
    			\"port_code\": \"IDSRN\",
    			\"port_name\": \"Serasan\"
    		},
    		{
    			\"port_code\": \"IDSSE\",
    			\"port_name\": \"Sungai Selatan\"
    		},
    		{
    			\"port_code\": \"IDSSI\",
    			\"port_name\": \"Siak Sri Indrapura\"
    		},
    		{
    			\"port_code\": \"IDSSO\",
    			\"port_name\": \"Soe Soe/susu\"
    		},
    		{
    			\"port_code\": \"IDSST\",
    			\"port_name\": \"Sunda Strait (penj)\"
    		},
    		{
    			\"port_code\": \"IDSTG\",
    			\"port_name\": \"Salatiga Semarang\"
    		},
    		{
    			\"port_code\": \"IDSTT\",
    			\"port_name\": \"Sintete\"
    		},
    		{
    			\"port_code\": \"IDSTU\",
    			\"port_name\": \"Satui\"
    		},
    		{
    			\"port_code\": \"IDSUA\",
    			\"port_name\": \"Suaran\"
    		},
    		{
    			\"port_code\": \"IDSUB\",
    			\"port_name\": \"Surabaya /juanda (u)\"
    		},
    		{
    			\"port_code\": \"IDSUG\",
    			\"port_name\": \"Sungai Gerong\"
    		},
    		{
    			\"port_code\": \"IDSUK\",
    			\"port_name\": \"Sukamara\"
    		},
    		{
    			\"port_code\": \"IDSUM\",
    			\"port_name\": \"Sumenep\"
    		},
    		{
    			\"port_code\": \"IDSUN\",
    			\"port_name\": \"Sungsang\"
    		},
    		{
    			\"port_code\": \"IDSUP\",
    			\"port_name\": \"Sumenep, Madura\"
    		},
    		{
    			\"port_code\": \"IDSUQ\",
    			\"port_name\": \"Sungai Guntung\"
    		},
    		{
    			\"port_code\": \"IDSUR\",
    			\"port_name\": \"Surabaya (ptt)\"
    		},
    		{
    			\"port_code\": \"IDSUS\",
    			\"port_name\": \"Susoh\"
    		},
    		{
    			\"port_code\": \"IDSVP\",
    			\"port_name\": \"Sevivara Point\"
    		},
    		{
    			\"port_code\": \"IDSWQ\",
    			\"port_name\": \"Sumbawa/ Brang-biji (u)\"
    		},
    		{
    			\"port_code\": \"IDSWT\",
    			\"port_name\": \"Salawati Terminal\"
    		},
    		{
    			\"port_code\": \"IDSXK\",
    			\"port_name\": \"Saumlaki\"
    		},
    		{
    			\"port_code\": \"IDSYK\",
    			\"port_name\": \"Surungyukung\"
    		},
    		{
    			\"port_code\": \"IDSZH\",
    			\"port_name\": \"Senipah\"
    		},
    		{
    			\"port_code\": \"IDTAB\",
    			\"port_name\": \"Taboneo\"
    		},
    		{
    			\"port_code\": \"IDTAL\",
    			\"port_name\": \"Tanah Laut\"
    		},
    		{
    			\"port_code\": \"IDTAN\",
    			\"port_name\": \"Tanjung Uban\"
    		},
    		{
    			\"port_code\": \"IDTAR\",
    			\"port_name\": \"Tarjun\"
    		},
    		{
    			\"port_code\": \"IDTAX\",
    			\"port_name\": \"Taliabu, Celebes\"
    		},
    		{
    			\"port_code\": \"IDTBA\",
    			\"port_name\": \"Tanjung Bara, Kl\"
    		},
    		{
    			\"port_code\": \"IDTBG\",
    			\"port_name\": \"Teluk Betung, Sumatra\"
    		},
    		{
    			\"port_code\": \"IDTBK\",
    			\"port_name\": \"Tanjung Balai Karimun\"
    		},
    		{
    			\"port_code\": \"IDTBM\",
    			\"port_name\": \"Tumbang Samba\"
    		},
    		{
    			\"port_code\": \"IDTBN\",
    			\"port_name\": \"Tuban, Jv\"
    		},
    		{
    			\"port_code\": \"IDTBO\",
    			\"port_name\": \"Tobelo\"
    		},
    		{
    			\"port_code\": \"IDTBR\",
    			\"port_name\": \"Tanjung Beringin\"
    		},
    		{
    			\"port_code\": \"IDTBT\",
    			\"port_name\": \"Tanjung Batu, Riau\"
    		},
    		{
    			\"port_code\": \"IDTBU\",
    			\"port_name\": \"Tanjung Buli\"
    		},
    		{
    			\"port_code\": \"IDTBY\",
    			\"port_name\": \"Padang/tl.bayur\"
    		},
    		{
    			\"port_code\": \"IDTDL\",
    			\"port_name\": \"Teluk Dalam\"
    		},
    		{
    			\"port_code\": \"IDTEG\",
    			\"port_name\": \"Tegal\"
    		},
    		{
    			\"port_code\": \"IDTEM\",
    			\"port_name\": \"Tembilahan\"
    		},
    		{
    			\"port_code\": \"IDTEN\",
    			\"port_name\": \"Tenau\"
    		},
    		{
    			\"port_code\": \"IDTER\",
    			\"port_name\": \"Terempa\"
    		},
    		{
    			\"port_code\": \"IDTES\",
    			\"port_name\": \"Tanjung Emas\"
    		},
    		{
    			\"port_code\": \"IDTGD\",
    			\"port_name\": \"Tagulandang\"
    		},
    		{
    			\"port_code\": \"IDTGK\",
    			\"port_name\": \"Tanjung Kedabu\"
    		},
    		{
    			\"port_code\": \"IDTGR\",
    			\"port_name\": \"Pasir/tanah Grogot\"
    		},
    		{
    			\"port_code\": \"IDTIM\",
    			\"port_name\": \"Amamapare\"
    		},
    		{
    			\"port_code\": \"IDTJA\",
    			\"port_name\": \"Tanjung Aru\"
    		},
    		{
    			\"port_code\": \"IDTJB\",
    			\"port_name\": \"Tanjung Balai Asahan\"
    		},
    		{
    			\"port_code\": \"IDTJG\",
    			\"port_name\": \"Tanjung Warukin\"
    		},
    		{
    			\"port_code\": \"IDTJP\",
    			\"port_name\": \"Tanjungperak\"
    		},
    		{
    			\"port_code\": \"IDTJQ\",
    			\"port_name\": \"Tanjung Pandan / Buluh Tumbang (u)\"
    		},
    		{
    			\"port_code\": \"IDTJS\",
    			\"port_name\": \"Tanjung Selor\"
    		},
    		{
    			\"port_code\": \"IDTKA\",
    			\"port_name\": \"Telok Air\"
    		},
    		{
    			\"port_code\": \"IDTKB\",
    			\"port_name\": \"Teluk Betung\"
    		},
    		{
    			\"port_code\": \"IDTKG\",
    			\"port_name\": \"Tanjung Karang / Branti (u)\"
    		},
    		{
    			\"port_code\": \"IDTKS\",
    			\"port_name\": \"Teluk Kasim/salawati\"
    		},
    		{
    			\"port_code\": \"IDTLI\",
    			\"port_name\": \"Toli-toli\"
    		},
    		{
    			\"port_code\": \"IDTLL\",
    			\"port_name\": \"Tanjung Lumba-lumba\"
    		},
    		{
    			\"port_code\": \"IDTLN\",
    			\"port_name\": \"Tanjung Leneng\"
    		},
    		{
    			\"port_code\": \"IDTLS\",
    			\"port_name\": \"Talise\"
    		},
    		{
    			\"port_code\": \"IDTMB\",
    			\"port_name\": \"Tambak\"
    		},
    		{
    			\"port_code\": \"IDTMC\",
    			\"port_name\": \"Tambolaka\"
    		},
    		{
    			\"port_code\": \"IDTMD\",
    			\"port_name\": \"Tanjung Medang\"
    		},
    		{
    			\"port_code\": \"IDTME\",
    			\"port_name\": \"Tanjung Merangas\"
    		},
    		{
    			\"port_code\": \"IDTMG\",
    			\"port_name\": \"Tanjung Mangaidar\"
    		},
    		{
    			\"port_code\": \"IDTMH\",
    			\"port_name\": \"Tanah Merah, Irian\"
    		},
    		{
    			\"port_code\": \"IDTMK\",
    			\"port_name\": \"Tamako\"
    		},
    		{
    			\"port_code\": \"IDTMO\",
    			\"port_name\": \"Telok Melano\"
    		},
    		{
    			\"port_code\": \"IDTMU\",
    			\"port_name\": \"Teluk Mengkudu\"
    		},
    		{
    			\"port_code\": \"IDTMY\",
    			\"port_name\": \"Tiom\"
    		},
    		{
    			\"port_code\": \"IDTNB\",
    			\"port_name\": \"Tanah Grogot\"
    		},
    		{
    			\"port_code\": \"IDTNG\",
    			\"port_name\": \"Tangerang\"
    		},
    		{
    			\"port_code\": \"IDTNJ\",
    			\"port_name\": \"Tanjung Pinang / Kijang (u)\"
    		},
    		{
    			\"port_code\": \"IDTOB\",
    			\"port_name\": \"Tobelo\"
    		},
    		{
    			\"port_code\": \"IDTOL\",
    			\"port_name\": \"Toboali\"
    		},
    		{
    			\"port_code\": \"IDTPD\",
    			\"port_name\": \"Tanjung Pandan\"
    		},
    		{
    			\"port_code\": \"IDTPE\",
    			\"port_name\": \"Tanjung Perak\"
    		},
    		{
    			\"port_code\": \"IDTPK\",
    			\"port_name\": \"Tapaktuan\"
    		},
    		{
    			\"port_code\": \"IDTPN\",
    			\"port_name\": \"Tanjung Pinang\"
    		},
    		{
    			\"port_code\": \"IDTPP\",
    			\"port_name\": \"Tanjung Priok\"
    		},
    		{
    			\"port_code\": \"IDTPR\",
    			\"port_name\": \"Tanjung Pura\"
    		},
    		{
    			\"port_code\": \"IDTRD\",
    			\"port_name\": \"Tanjung Redep\"
    		},
    		{
    			\"port_code\": \"IDTRG\",
    			\"port_name\": \"Tangerang\"
    		},
    		{
    			\"port_code\": \"IDTRH\",
    			\"port_name\": \"Tarahan\"
    		},
    		{
    			\"port_code\": \"IDTRK\",
    			\"port_name\": \"Tarakan (u)\"
    		},
    		{
    			\"port_code\": \"IDTSB\",
    			\"port_name\": \"Teluk Sebangau\"
    		},
    		{
    			\"port_code\": \"IDTSE\",
    			\"port_name\": \"Tanjung Seliu\"
    		},
    		{
    			\"port_code\": \"IDTSG\",
    			\"port_name\": \"Tanjung Sangata\"
    		},
    		{
    			\"port_code\": \"IDTSK\",
    			\"port_name\": \"Tanjung Samalantakan\"
    		},
    		{
    			\"port_code\": \"IDTSM\",
    			\"port_name\": \"Tanjung Samak\"
    		},
    		{
    			\"port_code\": \"IDTSO\",
    			\"port_name\": \"Tanjung Sekong\"
    		},
    		{
    			\"port_code\": \"IDTST\",
    			\"port_name\": \"Tanjung Santan\"
    		},
    		{
    			\"port_code\": \"IDTSX\",
    			\"port_name\": \"Tanjung Santan\"
    		},
    		{
    			\"port_code\": \"IDTSY\",
    			\"port_name\": \"Tasikmalaya\"
    		},
    		{
    			\"port_code\": \"IDTTE\",
    			\"port_name\": \"Ternate\"
    		},
    		{
    			\"port_code\": \"IDTTG\",
    			\"port_name\": \"Tebing Tinggi (ska)\"
    		},
    		{
    			\"port_code\": \"IDTTI\",
    			\"port_name\": \"Tebingtinggi\"
    		},
    		{
    			\"port_code\": \"IDTTM\",
    			\"port_name\": \"Tanjung Tiram\"
    		},
    		{
    			\"port_code\": \"IDTTR\",
    			\"port_name\": \"Tana Toraja\"
    		},
    		{
    			\"port_code\": \"IDTUA\",
    			\"port_name\": \"Tual\"
    		},
    		{
    			\"port_code\": \"IDTUB\",
    			\"port_name\": \"Tuban\"
    		},
    		{
    			\"port_code\": \"IDTUL\",
    			\"port_name\": \"Tulehu\"
    		},
    		{
    			\"port_code\": \"IDTWR\",
    			\"port_name\": \"Tanjung/warukin (u)\"
    		},
    		{
    			\"port_code\": \"IDTXM\",
    			\"port_name\": \"Teminabuan\"
    		},
    		{
    			\"port_code\": \"IDUAI\",
    			\"port_name\": \"Suai\"
    		},
    		{
    			\"port_code\": \"IDUBR\",
    			\"port_name\": \"Ubrub\"
    		},
    		{
    			\"port_code\": \"IDUGU\",
    			\"port_name\": \"Zugapa\"
    		},
    		{
    			\"port_code\": \"IDUJU\",
    			\"port_name\": \"Ujungpandang\"
    		},
    		{
    			\"port_code\": \"IDUNA\",
    			\"port_name\": \"Udang Natuna\"
    		},
    		{
    			\"port_code\": \"IDUOL\",
    			\"port_name\": \"Buol\"
    		},
    		{
    			\"port_code\": \"IDUPG\",
    			\"port_name\": \"Ujung Pandang / Hasanuddin (u)\"
    		},
    		{
    			\"port_code\": \"IDUTC\",
    			\"port_name\": \"Jakarta UTC1\"
    		},
    		{
    			\"port_code\": \"IDUTE\",
    			\"port_name\": \"Jakarta UTC3\"
    		},
    		{
    			\"port_code\": \"IDVIQ\",
    			\"port_name\": \"Viqueque\"
    		},
    		{
    			\"port_code\": \"IDWAI\",
    			\"port_name\": \"Wainibe\"
    		},
    		{
    			\"port_code\": \"IDWAN\",
    			\"port_name\": \"Wani\"
    		},
    		{
    			\"port_code\": \"IDWAR\",
    			\"port_name\": \"Waris\"
    		},
    		{
    			\"port_code\": \"IDWBA\",
    			\"port_name\": \"Wahai\"
    		},
    		{
    			\"port_code\": \"IDWED\",
    			\"port_name\": \"Weda\"
    		},
    		{
    			\"port_code\": \"IDWET\",
    			\"port_name\": \"Wagethe (u)\"
    		},
    		{
    			\"port_code\": \"IDWGP\",
    			\"port_name\": \"Waingapu\"
    		},
    		{
    			\"port_code\": \"IDWKI\",
    			\"port_name\": \"Kep. Wakai (togian)\"
    		},
    		{
    			\"port_code\": \"IDWKL\",
    			\"port_name\": \"Waikelo\"
    		},
    		{
    			\"port_code\": \"IDWMX\",
    			\"port_name\": \"Wamena (u)\"
    		},
    		{
    			\"port_code\": \"IDWON\",
    			\"port_name\": \"Wonosari\"
    		},
    		{
    			\"port_code\": \"IDWSP\",
    			\"port_name\": \"Way Seputih\"
    		},
    		{
    			\"port_code\": \"IDWSR\",
    			\"port_name\": \"Wasior\"
    		},
    		{
    			\"port_code\": \"IDWSS\",
    			\"port_name\": \"Waisarisa\"
    		},
    		{
    			\"port_code\": \"IDZEG\",
    			\"port_name\": \"Senggo\"
    		},
    		{
    			\"port_code\": \"IDZKL\",
    			\"port_name\": \"Steenkool\"
    		},
    		{
    			\"port_code\": \"IDZRI\",
    			\"port_name\": \"Serui\"
    		},
    		{
    			\"port_code\": \"IDZRM\",
    			\"port_name\": \"Sarmi\"
    		},
    		{
    			\"port_code\": \"XZSYG\",
    			\"port_name\": \"Sygna Tandjung Gerem\"
    		}
    	]", JSON_OBJECT_AS_ARRAY);
	}
}
