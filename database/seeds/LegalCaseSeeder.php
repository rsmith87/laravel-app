<?php

use Illuminate\Database\Seeder;

class LegalCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $case_types = [
            'estate_planning',
            'probate',
            'divorce',
            'child_custody',
            'child_support',
            'adoption',
            'name_changes',
            'criminal',
            'personal_injury',
            'real_estate',
            'bankruptcy',
            'immigration',
            'tenancy',
            'social_security',
            'tax',
            'other'
        ];

        
    }
}
