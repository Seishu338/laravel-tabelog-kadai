<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_names =[
            '和食', '日本料理', '寿司', '海鮮・魚介', 'そば（蕎麦）', 'うなぎ', '焼き鳥', 'お好み焼き', 'もんじゃ焼き', '洋食', 'フレンチ', 'イタリアン', 'スペイン料理', 'ステーキ', '中華料理', '韓国料理', 
            'タイ料理', 'ラーメン', 'カレー', '鍋', 'もつ鍋', '居酒屋', 'パン', 'スイーツ', 'バー・お酒', '天ぷら', '焼肉', '料理旅館', 'ビストロ', 'ハンバーグ', 'とんかつ', '串揚げ', 'うどん', 'しゃぶしゃぶ',
             '沖縄料理', 'ハンバーガー', 'パスタ', 'ピザ', '餃子', 'ホルモン', 'カフェ', '喫茶店', 'ケーキ', 'タピオカ', '食堂', 'ビュッフェ・バイキング'
        ];

       foreach($category_names as $category_name){
        Category::create([
            'name'=>$category_name
        ]);
       }
    }
}
