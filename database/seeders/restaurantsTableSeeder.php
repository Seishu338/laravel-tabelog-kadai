<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;


class restaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurant_names=[
        '中古屋 湖畔の宰相',
        '不平屋配達店',
        '卓越したジャーメイン・ガラス商',
        '細目の薬草屋',
        'イェフキネンとリュッタース市場',
        '服屋 攻城戦ゾッペラーリ',
        'ニネカのかがり火本屋',
        '皇太子の古書店',
        '宝石細工 男爵',
        'タニロ万屋'];

        foreach($restaurant_names as $name){
            Restaurant::create([
                'name'=>$name,
                'description'=>'そこはいったい誤解ののからお料簡もするがいでたございたて、十一の次に全く云ったという失敗ないで、それでその知事の自分で嫌うれば、私かが私の教授を養成をあってくれるたろ訳なますと落第見るて発展なる切らましない。飯の及び大森君がしかしぴたり考えあるのたますまし',
                'starting_time'=>9,
                'ending_time'=>22,
                'price'=>1000,
                'postal_code'=>112000,
                'address'=>'東京都文京区後楽1-3',
                'phone'=>00000000,
                'closing_day'=>'日曜日',
                'category_id'=>1
            ]);
        }
    }
}
