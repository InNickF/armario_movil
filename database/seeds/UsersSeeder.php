<?php

use App\User;
use App\Ubigeo;
use App\Models\Address;
use App\Models\UserStore;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {



        // $customer = factory(User::class)->create([
        //     'first_name' => 'User',
        //     'last_name' => 'Quito',
        //     'email' => 'quito@user.com',
        //     'password' => bcrypt('123123'),
        //     'city' => 'QUITO'
        // ]);
        // $customer->assign('user');

        // $this->createUserRelatedData($customer);

        // $customer = factory(User::class)->create([
        //     'first_name' => 'User',
        //     'last_name' => 'Ecuador',
        //     'email' => 'ecuador@user.com',
        //     'password' => bcrypt('123123'),
        //     'city' => 'CUENCA'
        // ]);
        // $customer->assign('user');

        // $this->createUserRelatedData($customer);




        //  /** ROPERO */
        //  $user = factory(User::class)->create([
        //     'first_name' => 'User',
        //     'last_name' => 'Ropero',
        //     'email' => 'ropero@user.com',
        //     'password' => bcrypt('123123'),
        //     'city' => 'QUITO'
        // ]);
        // $user->assign('user');

        // $this->createUserRelatedData($user, 'ropero');



        // /** CLOSET */
        // $user = factory(User::class)->create([
        //     'first_name' => 'User',
        //     'last_name' => 'Closet',
        //     'email' => 'closet@user.com',
        //     'password' => bcrypt('123123'),
        //     'city' => 'QUITO'
        // ]);
        // $user->assign('user');

        // $this->createUserRelatedData($user, 'closet');




        // /** ARMARIO */
        // $user = factory(User::class)->create([
        //     'first_name' => 'User',
        //     'last_name' => 'Armario',
        //     'email' => 'armario@user.com',
        //     'password' => bcrypt('123123'),
        //     'city' => 'QUITO'
        // ]);
        // $user->assign('user');

        // $this->createUserRelatedData($user, 'armario');

        /** MORE RANDOM USERS */
        factory(User::class, 20)->create()->each(function ($user) {
            $user->assign('user');
            $this->createUserRelatedData($user, null, true);
        });
    }




    public function createUserRelatedData($user, $planSlug = null, $createStore = true)
    {

        $faker = Faker\Factory::create();

        if ($createStore) {
            $this->createUserStore($user);
        }
        $plan =  $plan = app('rinvex.subscriptions.plan')->where('slug', $planSlug ?? 'ropero')->first();
        $user->newSubscription('main', $plan);

        Mail::fake();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->content_type = 'plan_subscription';
        $transaction->content_id = $user->getSubscription()->id;
        $transaction->amount = $plan->price;
        $transaction->status = 'success';
        $transaction->transaction_id = '12312313r3211121242341341';
        $transaction->authorization_code = 'aer23r4t5e4w3235tet343565325';
        $transaction->description = 'Pago de plan de suscripción ' . $plan->name;
        $transaction->address_id = 1;
        $transaction->card_token = 'sdg2wr321455432345yt4wrg543r45re5t4w45r54';
        $transaction->save();
        $this->createUserAddresses($user);

        if (UserStore::all()->count()) {
            $storeToFollow = UserStore::find($faker->numberBetween(1, UserStore::all()->count()));
            $user->follow($storeToFollow);
        }
    }

    public function createUserStore($user)
    {
        $store = factory(UserStore::class)->create([
            'user_id' => $user->id,
        ]);

        $faker = Faker\Factory::create();

        $state = 'PICHINCHA';
        $city = 'QUITO';
        $district = $faker->randomElement(App\Ubigeo::where('city', $city)->pluck('district')->unique()->toArray());

        $ubigeo_id = Ubigeo::where('state', $state)
            ->where('city', $city)
            ->where('district', $district)
            ->first()->id ?? $faker->numberBetween(1, 300);


        $input = [
            'label' => 'Default Address',
            'given_name' => $faker->firstName(),
            'family_name' => $faker->lastName(),
            'organization' => $faker->word,
            'country_code' => 'ec',
            'document_number' => '1712345678001',
            'document_type' => 'RUC',
            'street' => $faker->streetAddress,
            'secondary_street' => $faker->streetAddress,
            'reference' => $faker->streetName,
            'property_number' => $faker->numberBetween(234534, 4513423),
            'state' => $state,
            'city' => $city,
            'district' => $district,
            'ubigeo_id' => $ubigeo_id,
            'postal_code' => $faker->postcode,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'is_primary' => true,
            'is_billing' => true,
            'is_shipping' => false,
            'phone' => '0981234567'
        ];

        $store->address()->updateOrCreate($input);
    }

    public function createUserAddresses($user)
    {

        $faker = Faker\Factory::create();

        $state = $faker->randomElement(App\Ubigeo::pluck('state')->unique()->toArray());
        $city = $faker->randomElement(App\Ubigeo::where('state', $state)->pluck('city')->unique()->toArray());
        $district = $faker->randomElement(App\Ubigeo::where('city', $city)->pluck('district')->unique()->toArray());

        $ubigeo_id = Ubigeo::where('state', $state)
            ->where('city', $city)
            ->where('district', $district)
            ->first()->id ?? $faker->numberBetween(1, 300);


        $input = [
            'label' => 'Default Address',
            'given_name' => $faker->firstName(),
            'family_name' => $faker->lastName(),
            'organization' => $faker->word,
            'country_code' => 'ec',
            'street' => $faker->streetAddress,
            'state' => $state,
            'city' => $city,
            'district' => $district,
            'ubigeo_id' => $ubigeo_id,
            'postal_code' => $faker->postcode,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'is_primary' => true,
            'is_billing' => true,
            'is_shipping' => false,
        ];

        $address = $user->addresses()->create($input);
        $input = [
            'label' => 'Default Address',
            'given_name' => $faker->firstName(),
            'family_name' => $faker->lastName(),
            'organization' => $faker->word,
            'country_code' => 'ec',
            'street' => $faker->streetAddress,
            'state' => $state,
            'city' => $city,
            'district' => $district,
            'ubigeo_id' => $ubigeo_id,
            'postal_code' => $faker->postcode,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'is_primary' => true,
            'is_billing' => false,
            'is_shipping' => true,
        ];
        $address = $user->addresses()->create($input);
    }
}