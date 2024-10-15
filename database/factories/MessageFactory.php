<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $senderId = $this->faker->randomElement([0,1]);
        if($senderId === 0) {
            $senderId = $this->faker->randomElement(\App\Models\User::where
            ('sender_id','!=',1)->pluck
            ('id')->toArray());
            $reciverId = 1;
        }else{
            $$senderId = $this->faker->randomElement(\App\Models\User::pluck
            ('id')->toArray());
        }

        $groupId = null;
        if($this->faker->boolean(50)){
            $groupId = $this->faker->randomElement(\App\Models\Group::pluck
            ('id')->toArray());
            $group = Group::find($groupId);
            $senderId = $this->faker->randomElement($group->users::pluck
            ('id')->toArray());
            $reciverId = null ;
        }

        return [
            'message' => $this->faker->paragraph,
            'sender_id' => $senderId,
            'receiver_id' => $reciverId,
            'group_id' => Group::factory()->optional(),
            'conversation_id' => Conversation::factory()->optional(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
