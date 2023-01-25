<?php

namespace Database\Factories;

use App\Models\Branches;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchesFactory extends Factory
{
    protected $model = Branches::class;

    public function definition(): array
    {
        $user_id = User::all()->pluck('user_id')->toArray();
    	return [
            'branch_id' => $this->faker->uuid(),
    	    'branch_name' => $this->faker->company(),
            'leader_name' => $this->faker->name(),
            'contact' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'user_id' => $this->faker->randomElement($user_id)
            // 'login_username' => $this->faker->word(),
            // 'login_password' => $this->faker->word(),
    	];
    }
}
