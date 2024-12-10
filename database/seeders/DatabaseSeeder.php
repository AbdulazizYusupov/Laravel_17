<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Nationsal meals',
            'sort' => 1,
        ]);
        Category::create([
            'name' => 'Fast food',
            'sort' => 2,
        ]);
        Category::create([
            'name' => 'Deserts',
            'sort' => 3,
        ]);
        Category::create([
            'name' => 'Drinks',
            'sort' => 4,
        ]);
        Food::create([
            'name' => 'Lavash',
            'price' => 32000,
            'category_id' => 2,
            'image' => 'images/lavash.jpg'
        ]);
        Food::create([
            'name' => 'Gamburger',
            'price' => 28000,
            'category_id' => 2,
            'image' => 'images/hamburger.jpg'
        ]);
        Food::create([
            'name' => 'Hot dog',
            'price' => 16000,
            'category_id' => 2,
            'image' => 'images/hot-dog.jpg'
        ]);
        Food::create([
            'name' => 'Palov',
            'price' => 27000,
            'category_id' => 1,
            'image' => 'images/palov.jpg'
        ]);
        Food::create([
            'name' => 'Somsa',
            'price' => 9000,
            'category_id' => 1,
            'image' => 'images/somsa.jpg'
        ]);
        Food::create([
            'name' => 'Shashlik',
            'price' => 18000,
            'category_id' => 1,
            'image' => 'images/shashlik.jpg'
        ]);
        Food::create([
            'name' => 'Teromiso',
            'price' => 24000,
            'category_id' => 3,
            'image' => 'images/teromiso.jpg'
        ]);
        Food::create([
            'name' => 'Medovik',
            'price' => 21000,
            'category_id' => 3,
            'image' => 'images/medovik.jpg'
        ]);
        Food::create([
            'name' => 'Napoleon',
            'price' => 23000,
            'category_id' => 3,
            'image' => 'images/napoleon.jpg'
        ]);
        Food::create([
            'name' => 'Coffee',
            'price' => 14000,
            'category_id' => 4,
            'image' => 'images/coffee.jpg'
        ]);
        Food::create([
            'name' => 'Tea',
            'price' => 4000,
            'category_id' => 4,
            'image' => 'images/tea.jpg'
        ]);
        Food::create([
            'name' => 'Water',
            'price' => 3000,
            'category_id' => 4,
            'image' => 'images/water.jpg'
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '+998888888888',
            'role' => 'admin',
            'password' => Hash::make(123456789),
            'image' => 'images/admin.jpg',
        ]);
        User::create([
            'name' => 'Chef-1',
            'email' => 'chef1@gmail.com',
            'phone' => '+998111111111',
            'role' => 'chef',
            'password' => Hash::make(123456789),
            'image' => 'images/chef-1.jpg',
        ]);
        User::create([
            'name' => 'Chef-2',
            'email' => 'chef2@gmail.com',
            'phone' => '+998222222222',
            'role' => 'chef',
            'password' => Hash::make(123456789),
            'image' => 'images/chef-2.jpg',
        ]);
        User::create([
            'name' => 'Chef-3',
            'email' => 'chef3@gmail.com',
            'phone' => '+998333333333',
            'role' => 'chef',
            'password' => Hash::make(123456789),
            'image' => 'images/chef-3.jpg',
        ]);
        User::create([
            'name' => 'Chef-4',
            'email' => 'chef4@gmail.com',
            'phone' => '+9984444444444',
            'role' => 'chef',
            'password' => Hash::make(123456789),
            'image' => 'images/chef-4.jpg',
        ]);
        User::create([
            'name' => 'Waiter-1',
            'email' => 'waiter1@gmail.com',
            'phone' => '+998911111111',
            'role' => 'waiter',
            'password' => Hash::make(123456789),
            'image' => 'images/waiter-1.jpg',
        ]);
        User::create([
            'name' => 'Waiter-2',
            'email' => 'waiter2@gmail.com',
            'phone' => '+998922222222',
            'role' => 'waiter',
            'password' => Hash::make(123456789),
            'image' => 'images/waiter-2.jpg',
        ]);
        User::create([
            'name' => 'Waiter-3',
            'email' => 'waiter3@gmail.com',
            'phone' => '+998933333333',
            'role' => 'waiter',
            'password' => Hash::make(123456789),
            'image' => 'images/waiter-3.jpg',
        ]);
        User::create([
            'name' => 'Waiter-4',
            'email' => 'waiter4@gmail.com',
            'phone' => '+9989444444444',
            'role' => 'waiter',
            'password' => Hash::make(123456789),
            'image' => 'images/waiter-4.jpg',
        ]);
        User::create([
            'name' => 'Meneger',
            'email' => 'meneger@gmail.com',
            'phone' => '+99877777777',
            'role' => 'meneger',
            'password' => Hash::make(123456789),
            'image' => 'images/meneger.jpg',
        ]);
        User::create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'phone' => '+998555555555',
            'role' => 'operator',
            'password' => Hash::make(123456789),
            'image' => 'images/operator.jpg',
        ]);
        User::create([
            'name' => 'hr',
            'email' => 'hr@gmail.com',
            'phone' => '+9986666666666',
            'role' => 'hr',
            'password' => Hash::make(123456789),
            'image' => 'images/hr.jpg',
        ]);
    }
}
