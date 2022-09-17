<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
             ['id'=> 1, 'code'=>'۰۴۱', 'name'=>'آذربایجان شرقی', 'slug'=>'aze']
            ,['id'=> 2, 'code'=>'۰۴۴', 'name'=>'آذربایجان غربی', 'slug'=>'azw']
            ,['id'=> 3, 'code'=>'۰۴۵', 'name'=>'اردبیل', 'slug'=>'ard']
            ,['id'=> 4, 'code'=>'۰۳۱', 'name'=>'اصفهان', 'slug'=>'isf']
            ,['id'=> 5, 'code'=>'۰۲۶', 'name'=>'البرز', 'slug'=>'alb']
            ,['id'=> 6, 'code'=>'۰۸۴', 'name'=>'ایلام', 'slug'=>'ilm']
            ,['id'=> 7, 'code'=>'۰۷۷', 'name'=>'بوشهر', 'slug'=>'bsh']
            ,['id'=> 8, 'code'=>'۰۲۱', 'name'=>'تهران', 'slug'=>'teh']
            ,['id'=> 9, 'code'=>'۰۳۸', 'name'=>'چهارمحال و بختیاری', 'slug'=>'cob']
            ,['id'=> 10, 'code'=>'۰۵۶', 'name'=>'خراسان جنوبی', 'slug'=>'khj']
            ,['id'=> 11, 'code'=>'۰۵۱', 'name'=>'خراسان رضوی', 'slug'=>'khr']
            ,['id'=> 12, 'code'=>'۰۵۸', 'name'=>'خراسان شمالی', 'slug'=>'khs']
            ,['id'=> 13, 'code'=>'۰۶۱', 'name'=>'خوزستان', 'slug'=>'khz']
            ,['id'=> 14, 'code'=>'۰۲۴', 'name'=>'زنجان', 'slug'=>'zaj']
            ,['id'=> 15, 'code'=>'۰۲۳', 'name'=>'سمنان', 'slug'=>'sem']
            ,['id'=> 16, 'code'=>'۰۵۴', 'name'=>'سیستان و بلوچستان', 'slug'=>'sob']
            ,['id'=> 17, 'code'=>'۰۷۱', 'name'=>'فارس', 'slug'=>'far']
            ,['id'=> 18, 'code'=>'۰۲۸', 'name'=>'قزوین', 'slug'=>'qaz']
            ,['id'=> 19, 'code'=>'۰۲۵', 'name'=>'قم', 'slug'=>'qom']
            ,['id'=> 20, 'code'=>'۰۸۷', 'name'=>'کردستان', 'slug'=>'kor']
            ,['id'=> 21, 'code'=>'۰۳۴', 'name'=>'کرمان', 'slug'=>'ker']
            ,['id'=> 22, 'code'=>'۰۸۳', 'name'=>'کرمانشاه', 'slug'=>'ksh']
            ,['id'=> 23, 'code'=>'۰۷۴', 'name'=>'کهگیلویه وبویراحمد', 'slug'=>'kob']
            ,['id'=> 24, 'code'=>'۰۱۷', 'name'=>'گلستان', 'slug'=>'gol']
            ,['id'=> 25, 'code'=>'۰۱۳', 'name'=>'گیلان', 'slug'=>'gil']
            ,['id'=> 26, 'code'=>'۰۶۶', 'name'=>'لرستان', 'slug'=>'lor']
            ,['id'=> 27, 'code'=>'۰۱۱', 'name'=>'مازندران', 'slug'=>'maz']
            ,['id'=> 28, 'code'=>'۰۸۶', 'name'=>'مرکزی', 'slug'=>'mrk']
            ,['id'=> 29, 'code'=>'۰۷۶', 'name'=>'هرمزگان', 'slug'=>'hor']
            ,['id'=> 30, 'code'=>'۰۸۱', 'name'=>'همدان', 'slug'=>'ham']
            ,['id'=> 31, 'code'=>'۰۳۵', 'name'=>'یزد', 'slug'=>'yzd']
        ];
        
        foreach ($items as $item)
            Province::create($item);
    }

}
