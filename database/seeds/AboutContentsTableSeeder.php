<?php

use Illuminate\Database\Seeder;

class AboutContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('about_contents')->insert([
            [
                'image_path' => '/img/welcome-2.png',
                'title' => 'Tentang Pemilik',
                'content' => 
                json_encode(
                    'Lusy Wahyudi was born in Jakarta Indonesia.  Her interest in floral arrangement began in 1978 starting with European design and futher studies of Ikebana.  in 1988, she continued developing her knowledge of Ikebana Ikenobo attending workshops in both Indonesia and Japan.  Her first book " The Art of Floral Arrangement" was published in 2008, followed by a revised publication in 2015.

                    In 2017 she published "Perfect Imperfection"  an Ikebana Ikenobo floral design with her own photographs and illustrations

                    She served as President of the Indonesia Ikebana Ikenobo Association from 2011 to 2014; and she is still a teacher of Ikebana Ikenobo.  Her knowledge of Ikebana now extends of other handicrafts of which one can enjoy at her web site www.lusywahyudi.com'),
                'is_class' => false,
            ],
            [
            	'image_path' => '/img/welcome-1.jpg',
            	'title' => 'Ikebana Ikenobo',
            	'content' => 
            	json_encode(
                    'Ikebana is a Japanese art of flower arrangement started 555 years ago. The word "ikebana (生け花)” drives from “ikeru (生ける),” which means ‘to arrange, to put, alive’, and “hana (花) or bana”, refer to ‘flowers’. Therefore Ikebana represents fresh or live floral arrangement.

                    The oldest Ikebana school is Ikenobo which located in Kyoto at Rokkokudo temple.

                    It is considered as the birthplace of Ikebana and as of today it is still utilized as a learning center. The school is led by Sen’ei Ikenobo, the 45th generation headmaster, and will be passed down to the next designated heiress, the 46 th generation Senko Ikenobo.

                    www.ikenobo.jp

                    The Ikebana Ikenobo class is scheduled once a week either Thursday or Friday.

                    Courses are offered for beginner, intermediate, advance and for those who choose to pursue a teaching degree. Each student will have a Ikebana Ikenobo Japan certificate upon completion of each course.'),
            	'is_class' => true,
            ],
            [
            	'image_path' => '/img/welcome-1.jpg',
            	'title' => 'handicraft',
            	'content' => 
            	json_encode(
                    'Handicraft is an art that requires skillful hands and sharp eyes to create a wonderful piece of object.

                    It is also another form of art that express our sense of tranquility and bring joy to ourselves and other.

                    For those who enjoy this unique art, it also can be another means of additional income. These beautiful art can be sold commercially.'),
            	'is_class' => true,
            ],
        ]);
    }
}
