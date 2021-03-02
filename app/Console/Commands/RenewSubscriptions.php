<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use App\Mail\PlanRenewed;
use App\Mail\PlanRenewFailed;
use App\Mail\AdminRenewSummary;
use Illuminate\Console\Command;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class RenewSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:renew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renew all users subscriptions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Renovando planes de usuarios...');
        Cache::flush();
        // $this->error('Display this on the screen');
        // $this->line('Display this on the screen');
        $users = User::get();

        $payments = [
            'success' => [],
            'failed' => [],
            'omitted' => [],
        ];

        foreach ($users as $key => $user) {
            $subscription = app('rinvex.subscriptions.plan_subscription')
                ->where('user_type', 'App\User')
                ->where('user_id', $user->id)
                ->where('name->es', 'main')
                ->whereNull('canceled_at')
                // ->whereDate('ends_at', '>=', Carbon::now()->startOfDay())
                ->whereDate('ends_at', '<=', Carbon::now()->format('Y-m-d'))
                ->first();

            if (!$subscription) {
                $this->line('Usuario ' . $user->email . ' no tiene suscripción que caduque hoy o en días pasados');
                continue;
            }

            $plan = app('rinvex.subscriptions.plan')->with('features')->find($subscription->plan_id);
            if ($plan->isFree()) {
              $this->info('Plan ' . $plan->name . ' es gratuito, renovando automáticamente...');
              $subscription->renew();
              continue;
            }



            $this->line('Plan de usuario ' . $user->email . ' caduca en ' . $subscription->ends_at);
            // $this->line($subscription);
            $this->line('Revisando Usuario: ' . $user->email);
            // $this->line(Carbon::now()->startOfDay());

            $renewed = $user->renewPlanSubscription($plan, $subscription);

            if (isset($renewed['error'])) {
                $message = 'No se pudo renovar el plan: ' . $renewed['error'];
                $this->error($message);

                $payments['failed'][] = [
                    'user' => $user->id,
                    'subscription' => $subscription->id,
                    'error' => $message,
                    'result' => json_encode($renewed),
                ];
                Mail::to($user)->send(new PlanRenewFailed($user, $plan, $subscription));
                continue;
            }


            $payments['success'][] = [
                'user' => $user->id,
                'subscription' => $subscription->id,
                'result' => json_encode($renewed),
            ];
            Mail::to($user)->send(new PlanRenewed($user, $plan, $subscription));
            $this->info('Plan renovado exitosamente');
        }

        $this->info('Planes renovados');
        // $this->info(($payments));

        Mail::to(User::whereIs('super-user')->get())->send(new AdminRenewSummary($payments));
    }
}
