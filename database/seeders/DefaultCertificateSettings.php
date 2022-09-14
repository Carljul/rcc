<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DefaultCertificate;

class DefaultCertificateSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DefaultCertificate::create([
            'cemetery_administrator' => 'Ma. Victoria C. Morano',
            'parish_office_staff' => 'JOHN E. GIMENEZ',
            'parish_team_moderator' => 'REV. FR. JOSELITO E. DANAO',
            'parish_team_member' => 'REV. FR. LORETO S. JUMAO-AS',
        ]);
    }
}
