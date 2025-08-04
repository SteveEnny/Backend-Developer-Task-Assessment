<?php

namespace Database\Seeders;

use App\Models\JobOpening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobOpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'user_id' => 1,
                'title' => 'Frontend Developer Needed',
                'company' => 'Hello Inc.',
                'company_logo' => null,
                'location' => 'Lagos',
                'category' => 'Tech',
                'salary' => 'N150,000 per Month',
                'description' => 'Hello Inc. is seeking a highly motivated and skilled Frontend Developer to join our growing engineering team. You will be responsible for building intuitive and responsive user interfaces using modern JavaScript frameworks such as Vue.js. Candidates should have strong experience with Tailwind CSS and understand the principles of clean UI/UX design. Responsibilities include working closely with backend engineers, implementing pixel-perfect designs, and optimizing applications for speed and responsiveness.',
                'benefits' => 'Free Meal, Paid Leave, Performance Bonus',
                'type' => 'Permanent',
                'work_condition' => 'Remote',
            ],
            [
                'user_id' => 1,
                'title' => 'Backend Laravel Developer',
                'company' => 'Softworks Ltd.',
                'company_logo' => null,
                'location' => 'Abuja',
                'category' => 'Tech',
                'salary' => 'N200,000 per Month',
                'description' => 'Softworks Ltd. is hiring a Backend Laravel Developer to build scalable APIs and microservices. The ideal candidate has 3+ years experience with Laravel and a strong understanding of RESTful architecture. You will work on designing and implementing APIs, integrating third-party services, managing MySQL databases, and ensuring high performance and availability of backend services. Experience with Docker and CI/CD pipelines is a plus.',
                'benefits' => 'Remote Stipend, Health Insurance, Flexible Hours',
                'type' => 'Contract',
                'work_condition' => 'Remote',
            ],
            [
                'user_id' => 1,
                'title' => 'Product Designer',
                'company' => 'DesignPro',
                'company_logo' => null,
                'location' => 'Remote',
                'category' => 'Design',
                'salary' => 'N180,000 per Month',
                'description' => 'DesignPro is looking for a creative and detail-oriented Product Designer with a passion for crafting intuitive digital experiences. The successful candidate will lead design efforts across multiple products, working closely with product managers and engineers. You should have a strong portfolio showcasing UI/UX work, proficiency in Figma, and experience conducting user research, prototyping, and usability testing. Attention to accessibility and mobile-first design is essential.',
                'benefits' => 'Health Insurance, Equipment Allowance, Annual Bonus',
                'type' => 'Permanent',
                'work_condition' => 'Remote',
            ],
    ];


        foreach ($jobs as $job) {
            JobOpening::create($job);
        }
    }
}