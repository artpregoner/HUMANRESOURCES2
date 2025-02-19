<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EmployeeRequest;
use App\Models\User;

class EmployeeRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->optional()->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'civil_status' => $this->faker->randomElement(['single', 'married', 'divorced', 'widowed', 'separated', 'engaged']),
            'address' => $this->faker->address,
            'social_media' => $this->faker->optional()->url,
            'department' => $this->faker->randomElement(['admin', 'hr1', 'hr2', 'hr3', 'finance', 'logistic1', 'logistic2', 'core1', 'core2', 'core3']),
            'role' => 'employee', // Change based on your application roles

            // Emergency Contact
            'emergency_name' => $this->faker->name,
            'emergency_address' => $this->faker->address,
            'emergency_phone' => $this->faker->phoneNumber,
            'emergency_relationship' => $this->faker->randomElement(['Parent', 'Sibling', 'Spouse', 'Friend', 'Guardian']),

            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'approved_by' => User::factory()->create()->id, // Creating a user for approval
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
