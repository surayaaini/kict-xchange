<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('faqs')->insert([
            [
                'category' => 'Eligibility',
                'question' => 'Who is eligible to participate in the mobility programme?',
                'answer' => 'All active undergraduate and postgraduate students who have completed at least one semester and have a good academic standing.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Application',
                'question' => 'How do I apply for the mobility programme?',
                'answer' => 'You can apply through the official IIUM Mobility portal. Make sure to check deadlines and required documents.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Application',
                'question' => 'When can I apply for the programme?',
                'answer' => 'The application period is usually announced before each semester. Please check the IIUM Mobility website or your kulliyyah for updates.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Application',
                'question' => 'What documents are required?',
                'answer' => 'Required documents usually include academic transcript, passport copy, recommendation letter, and a motivation letter. Exact documents may vary by programme.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Visa',
                'question' => 'Will I need a visa to participate?',
                'answer' => 'Yes, visa requirements depend on your destination country. IIUM will assist with the documentation, but you’re responsible for applying.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Funding',
                'question' => 'Is financial assistance available?',
                'answer' => 'Some mobility programmes are partially funded. IIUM occasionally offers mobility grants or scholarships. You’re encouraged to explore external funding too.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Funding',
                'question' => 'What costs are involved?',
                'answer' => 'Common costs include airfare, accommodation, insurance, visa fees, and daily expenses. Some partner universities may waive tuition fees.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Credit Transfer',
                'question' => 'Will I get credit for the courses I take abroad?',
                'answer' => 'Yes, provided the courses are approved by your kulliyyah and match your study plan. Discuss with your academic advisor before applying.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Accommodation',
                'question' => 'Is accommodation provided?',
                'answer' => 'Some host universities offer dormitories or help arrange accommodation. Students are responsible for confirming and securing their lodging.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Support',
                'question' => 'What support does IIUM provide during my mobility?',
                'answer' => 'IIUM offers administrative support, orientation sessions, and assistance with required documentation before and during your exchange.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'After Exchange',
                'question' => 'What happens when I return?',
                'answer' => 'You must submit a report and share your experience, usually through a presentation or written reflection. Credit transfer processing may also take place then.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
