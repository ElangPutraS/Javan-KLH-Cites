<?php

use Illuminate\Database\Seeder;
use App\Source;

class SourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Source::create([
            'source_code' => 'W',
            'source_description' => 'Spesimen diambil dari alam.',
        ]);

        Source::create([
            'source_code' => 'R',
            'source_description' => 'Spesimen hasil pembesaran.',
        ]);

        Source::create([
            'source_code' => 'D',
            'source_description' => 'Satwa hasil penangkaran dan tumbuhan hasil budidaa yang termasuk dalam Appendiks I untuk tujuan komersial, termasuk bagian-bagiannya. Diekspor berdasarkan ketentuan Artikel VII, paragraf ke 4 dari konvensi.',
        ]);

        Source::create([
            'source_code' => 'A',
            'source_description' => 'Tumbuhan hasil budidaya sesuai dengan ketentuan dalam Res. Conf. 9.18 (Rev) Paragraf a) termasuk didalamnya bagian-bagiannya dan turunannya, yang diekspor berdasarkan ketentuan dari Artikel VII, paragraf 5, dari konvensi (spesimen dari spesies hasil budidaya yang termasuk dalam Appendiks I untuk tujuan non komersial dan spesimen dari spesies yang termasuk Appendiks II dan III).',
        ]);

        Source::create([
            'source_code' => 'C',
            'source_description' => 'Satwa hasil penangkaran sesuai dengan ketentuan dalam Res. Conf. 10.16 termasuk didalamnya bagian-bagiannya dan turunannya, yang diekspor berdasarkan ketentuan Artikel VII, pragraf 5 dari konvensi (spesimen dari species haisl penangkaran yang termasuk dalam Appendiks I untuk tujuan non komersial dan spesimen dari spesies yang termasuk Appendiks II dan III).',
        ]);

        Source::create([
            'source_code' => 'F',
            'source_description' => 'Satwa yang lahir di penangkaran (generasi turunan pertama dan generasi seterusnya) yang tidak memenuhi persyaratan dari ketentuan yang ditetapkan dalam Resolusi Conf. 10.16 termasuk bagian dan turunannya.',
        ]);

        Source::create([
            'source_code' => 'U',
            'source_description' => 'Sumber tidak diketahui (harus diberikan alasan).',
        ]);

        Source::create([
            'source_code' => 'I',
            'source_description' => 'Spesimen hasil sitaan.',
        ]);

        Source::create([
            'source_code' => 'W',
            'source_description' => 'Spesimen sebelum Konvensi.',
        ]);
    }
}
