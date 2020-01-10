<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\AccountType;
use App\Parameter;
use App\ParameterAccountType;
use App\Account;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        // $this->call(AccountsTableSeeder::class);


        $cat = ['Opening', 'Solution Information', 'Telephony Skills', 'Soft Skills', 'Closing', 'Non-Voice Parameters'];
        foreach ($cat as $item) {
          Category::create([
            'category_name' => $item
          ]);
        }

        $acc = ['Inbound', 'Outbound'];
        foreach ($acc as $item) {
          AccountType::create([
            'account_type_name' => $item
          ]);
        }

        $accounts = ["Z Shopping", "Xavierville - Voice", "Webify", "Unified", "TJX NV", "Syntegral", "Spearhead Solutions", "Smart Resolution", "SOR - US - CALLBACK", "SOR - QVI, Ariix, Posadas Inbound", "SOR - Non Voice", "SOR ICE Verification", "SOR - Flight Team  ", "SOR - ES", "SOR DreamTrips", "SOR - Concierge", "Skyline Brokerage", "Surgimon", "Recruitment", "Review Boost WinBack", "Review Boost - Restaurant", "RB Plumber and HVAC", "Review Boost - Hotel Motel", "Review Boost Flatworld Mixed", "RevBoost Dentist", "Catering and Bed  Breakfast", "Review Boost - Autobody", "RevBoost Batch 5", "Review Boost - Salon Spa", "Project World", "Primary Residential Mortgage, Inc", "Pulse Pixel", "Mantoria - US", "Lifestyle - US", "LIVINGSTON", "LIVINGSTON MTL", "LIVINGSTON GTA", "LIVINGSTON FTE", "IT-test", "Iguana Med  ", "Issuer Direct", "Humanitravel", "Hack House US", "HFB Technologies USA", "FLATWORLD-INTERNAL", "FW-DME", "Euro Travel", "Edge Realty ISA", "Edge Realty", "ENT Specialists", "Doctors Network", "DHD Hospitality - USA", "DC Dental", "Driver Contact Centre", "Cybertech - Mae Llemit", "Cybertech - April Palanca", "Cybertech", "Chicago Scrubs", "Customs Brokerage", "CAD Marketing Solutions", "Blaire Online Luxe Vape", "Blaire Online Fem Things", "Audatex - Saskatchewan", "Audatex - Ontario", "Audatex - Nova Scotia", "Audatex - New Brunswick", "Audatex - Manitoba", "Audatex - British Columbia", "Audatex - Alberta", "Alcova - USA", "Alberta Insurance Council", "Affiliated"];
        foreach ($accounts as $item) {
          Account::create([
            'account_name' => $item,
            'is_custom' => 0,
          ]);
        }

        $data[] = [];

        $data[0] = [
            'Did the agent adhere with the opening spiel and timeliness?', 
            'Did the agent mention the company name?',
            'Did the agent mention his/ her name?',
            'Did the agent ask for / confirm the caller\'s name?',
            'Did the agent ask for/ confirm the caller\'s company Name?',
            'Did the agent ask for / confirm the caller\'s telephone number?',
            'Did the agent ask for/ confirm the customer\'s account number properly?',
            'Did the agent advise the caller of the reason for call?',
        ];

        $data[1] = [
            'Did the agent took ownership of the transaction?',
            'Did the agent asked for all appropriate questions?',
            'Did the agent answered customer questions correctly?',
            'Did the agent offered / provide the most appropriate solution?',
            'Did the agent use effective line of questioning (LOQ) to identify the customers concern?',
            'Did the agent paraphrase the customer\'s issue appropriately ?',
            'Did the agent answer all the queries / questions raised on the transaction?',
            'Did the agent offered an appropriate timescale for a solution?',
            'Did the agent offered / provided transaction, reference or confirmation number?',
            'Did the agent displayed knowledge of previous transaction?',
            'Did the agent highlighted the features and benefits the product when needed? ',
            'Was the customer notified of all relevant documentation?',
            'Was the agent able to retain the customer?',
            'Did the agent successfully closed the sale?',
            'Was the trasfer valid?',
            'Did the agent suggested self-help options (link, apps, hotline, etc)?',
        ];

        $data[2] = [
            'Did the agent follow the correct procedures for transferring interaction?',
            'Did the agent avoid long silences during the call (Use of Mute)?',
            'Did the agent follow the correct procedures for placing a customer on hold',
            'Did the agent follow correct procedures for escalating a call to their supervisor/manager?',
            'Does the agent has full control of the interaction?',
        ];

        $data[3] = [
            'Did the agent displayed a professional manner throughout the interaction?',
            'Did the agent pro-actively added value throughout the interaction?',
            'Did the agent sound clear and confident throughout the interaction?',
            'Did the agent sounded upbeat and enthusiastic?',
            'Did the agent refrained from using jargon words throughout interaction?',
            'Did the agent sound friendly, polite and welcoming?',
            'Did the agent build genuine rapport with the customer?',
            'Did the agent provide empathy when needed?',
            'Did the agent provide sincere apology when needed?',
            'Did the agent avoid interrupting or talking over the customer?',
            'Did the agent demonstrate active listening?',
            'Did the agent went the extra mile for best customer experience?',
        ];

        $data[4] = [
            'Did the agent offer asditonal assistance to the customer?',
            'Did the agent provide complete documentation in the system tool?',
            'Did the agent use the correct disposition?',
            'Did the agent end the call properly?',
            'Was the customer satisfied?',
        ];

        $data[5] = [
            'Did the agent use correct grammar and sentence construction?',
            'Did the agent used the correct / prescribed macro(s)?',
            'Did the agent use correct spelling, punctuations and capitalization?',
        ];


        for($x = 0; $x < 6; $x++) {
            foreach ($data[$x] as $item) {
                $result = Parameter::create([
                    'parameter_name' => $item,
                    'description' => $item,
                    'category_id' => ($x + 1),
                ]);

                ParameterAccountType::create([
                    'parameter_id' => $result->id,
                    'account_type_id' => 1,
                ]);
                ParameterAccountType::create([
                    'parameter_id' => $result->id,
                    'account_type_id' => 2,
                ]);
            }
        }
    }
}
