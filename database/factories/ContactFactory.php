<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone'       => $this->faker->phoneNumber,
            'email'       => $this->faker->email,
            'working'     => $this->faker->date,
            'text_header' => $this->faker->text,
            'text_footer' => $this->faker->text,
            'facebook'    => $this->faker->url,
            'instagram'   => $this->faker->url,
            'logo' => $this->faker->image,
            'image' => $this->faker->image,
        ];
    }
}
