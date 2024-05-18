<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\Group;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        user::factory()->create([
            'name' => 'Alex',
            'email' => 'Alex@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);
        User::factory()->create([
            'name' => 'Jane',
            'email' => 'Jane@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory(10)->create();

        for($i = 0; $i <5; $i++) {
            $group = Group::factory()->create([
                'owner_id' => 1,
            ]);

            $users = User::inRandomOrder() -> limit(rand(2, 5)) -> pluck('id');
            $group -> users() -> attach(array_unique([1, ...$users]));
        }

        Message::factory(1000)->create();
        $messages = Message::whereNull('group_id')->orderBy('created_at')->get();

        $conversations = $messages->groupBy(function($message) {
            return collect([$message->sender_id, $message->receiver_id])->sort()->import('_');
        })->map(function($groupedMessages){
            return [
                'user_id1' => $groupedMessages -> first()-> sender_id,
                'user_id2' => $groupedMessages -> first()-> sender_id,
                'last_message_id' => $groupedMessages -> last()-> id,
                'created-at' => new Carbon(),
                'updated_at' => new Carbon(),
            ];
        })->values();

        Conversation::insertOrIgnore($conversations -> toArray());
    }
}
