<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\ContactRepository;

class ContactSeeder extends Seeder
{
    /**
     * @var ContactRepository
     */
    private ContactRepository $contactRepository;

    /**
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->contactRepository->createFakeContact(1);
    }
}
