<?php

use Illuminate\Console\Command;
use App\Models\User;

class CleanDemoUsers extends Command
{
    protected $signature = 'clean:demo-users';
    protected $description = 'Delete demo users who have no orders';

    public function handle()
    {
        $count = User::doesntHave('orders')->count();

        // تنفيذ الحذف
        User::doesntHave('orders')->delete();

        $this->info("✅ تم حذف {$count} حساب تجريبي بنجاح.");
    }
}
