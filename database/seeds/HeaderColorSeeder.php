<?php

use Database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeaderColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use TruncateTable;
    public function run()
    {
        $this->truncate('settings');
        $headerColors = [
            [
                'value' => 'bg-primary header-text-light',
                'text' => 'bg-primary',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-secondary header-text-light',
                'text' => 'bg-secondary',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-success header-text-dark',
                'text' => 'bg-success',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-info header-text-dark',
                'text' => 'bg-info',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-warning header-text-dark',
                'text' => 'bg-warning',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-danger header-text-light',
                'text' => 'bg-danger',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-light header-text-dark',
                'text' => 'bg-light',
                'slug' => 'header-color',
                'active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-dark header-text-light',
                'text' => 'bg-dark',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-focus header-text-light',
                'text' => 'bg-focus',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-alternate header-text-light',
                'text' => 'bg-alternate',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-vicious-stance header-text-light',
                'text' => 'bg-vicious-stance',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-midnight-bloom header-text-light',
                'text' => 'bg-midnight-bloom',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-night-sky header-text-light',
                'text' => 'bg-night-sky',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-slick-carbon header-text-light',
                'text' => 'bg-slick-carbon',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-asteroid header-text-light',
                'text' => 'bg-asteroid',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-royal header-text-light',
                'text' => 'bg-royal',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-warm-flame header-text-dark',
                'text' => 'bg-warm-flame',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-night-fade header-text-dark',
                'text' => 'bg-night-fade',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-sunny-morning header-text-dark',
                'text' => 'bg-sunny-morning',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-tempting-azure header-text-dark',
                'text' => 'bg-tempting-azure',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-amy-crisp header-text-dark',
                'text' => 'bg-amy-crisp',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-heavy-rain header-text-dark',
                'text' => 'bg-heavy-rain',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-mean-fruit header-text-dark',
                'text' => 'bg-mean-fruit',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-malibu-beach header-text-light',
                'text' => 'bg-malibu-beach',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-deep-blue header-text-dark',
                'text' => 'bg-deep-blue',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-ripe-malin header-text-light',
                'text' => 'bg-ripe-malin',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-arielle-smile header-text-light',
                'text' => 'bg-arielle-smile',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-plum-plate header-text-light',
                'text' => 'bg-plum-plate',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-happy-fisher header-text-dark',
                'text' => 'bg-happy-fisher',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-happy-itmeo header-text-light',
                'text' => 'bg-happy-itemo',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-mixed-hopes header-text-light',
                'text' => 'bg-mixed-hopes',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-strong-bliss header-text-light',
                'text' => 'bg-strong-bliss',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-grow-early header-text-light',
                'text' => 'bg-grow-early',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-love-kiss header-text-light',
                'text' => 'bg-love-kiss',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-premium-dark header-text-light',
                'text' => 'bg-premium-dark',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-happy-green header-text-light',
                'text' => 'bg-happy-green',
                'slug' => 'header-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        $sidebarColors = [
            [
                'value' => 'bg-primary header-text-light',
                'text' => 'bg-primary',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-secondary header-text-light',
                'text' => 'bg-secondary',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-success header-text-dark',
                'text' => 'bg-success',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-info header-text-dark',
                'text' => 'bg-info',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-warning header-text-dark',
                'text' => 'bg-warning',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-danger header-text-light',
                'text' => 'bg-danger',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-light header-text-dark',
                'text' => 'bg-light',
                'slug' => 'sidebar-color',
                'active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-dark header-text-light',
                'text' => 'bg-dark',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-focus header-text-light',
                'text' => 'bg-focus',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-alternate header-text-light',
                'text' => 'bg-alternate',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-vicious-stance header-text-light',
                'text' => 'bg-vicious-stance',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-midnight-bloom header-text-light',
                'text' => 'bg-midnight-bloom',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-night-sky header-text-light',
                'text' => 'bg-night-sky',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-slick-carbon header-text-light',
                'text' => 'bg-slick-carbon',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-asteroid header-text-light',
                'text' => 'bg-asteroid',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-royal header-text-light',
                'text' => 'bg-royal',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-warm-flame header-text-dark',
                'text' => 'bg-warm-flame',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-night-fade header-text-dark',
                'text' => 'bg-night-fade',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-sunny-morning header-text-dark',
                'text' => 'bg-sunny-morning',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-tempting-azure header-text-dark',
                'text' => 'bg-tempting-azure',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-amy-crisp header-text-dark',
                'text' => 'bg-amy-crisp',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-heavy-rain header-text-dark',
                'text' => 'bg-heavy-rain',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-mean-fruit header-text-dark',
                'text' => 'bg-mean-fruit',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-malibu-beach header-text-light',
                'text' => 'bg-malibu-beach',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-deep-blue header-text-dark',
                'text' => 'bg-deep-blue',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-ripe-malin header-text-light',
                'text' => 'bg-ripe-malin',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-arielle-smile header-text-light',
                'text' => 'bg-arielle-smile',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-plum-plate header-text-light',
                'text' => 'bg-plum-plate',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-happy-fisher header-text-dark',
                'text' => 'bg-happy-fisher',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-happy-itmeo header-text-light',
                'text' => 'bg-happy-itemo',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-mixed-hopes header-text-light',
                'text' => 'bg-mixed-hopes',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-strong-bliss header-text-light',
                'text' => 'bg-strong-bliss',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-grow-early header-text-light',
                'text' => 'bg-grow-early',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-love-kiss header-text-light',
                'text' => 'bg-love-kiss',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-premium-dark header-text-light',
                'text' => 'bg-premium-dark',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'value' => 'bg-happy-green header-text-light',
                'text' => 'bg-happy-green',
                'slug' => 'sidebar-color',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        $headerPosition = [
            [
                'slug' => 'header-position',
                'active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        $footerPosition = [
            [
                'slug' => 'footer-position',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        $sidebarPosition = [
            [
                'slug' => 'sidebar-position',
                'active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('settings')->insert($sidebarPosition);
        DB::table('settings')->insert($footerPosition);
        DB::table('settings')->insert($headerPosition);
        DB::table('settings')->insert($headerColors);
        DB::table('settings')->insert($sidebarColors);
    }
}
