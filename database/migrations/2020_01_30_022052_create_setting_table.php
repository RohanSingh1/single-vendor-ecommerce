se<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Setting;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->string('value')->nullable();
            $table->string('file')->nullable();
            $table->mediumText('text')->nullable();
            $table->string('active')->default(0);
            $table->timestamps();
        });
        Setting::create([
            'id' => 1,
            'slug' => 'sidebar-position',
            'value' => NULL,
            'file' => NULL,
            'text' => NULL,
            'active' => 1,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 02:23:09'
        ]);

        Setting::create([
            'id' => 2,
            'slug' => 'footer-position',
            'value' => NULL,
            'file' => NULL,
            'text' => NULL,
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-08-27 06:41:22'
        ]);

        Setting::create([
            'id' => 3,
            'slug' => 'header-position',
            'value' => NULL,
            'file' => NULL,
            'text' => NULL,
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 02:23:11'
        ]);

        Setting::create([
            'id' => 4,
            'slug' => 'header-color',
            'value' => 'bg-primary header-text-light',
            'file' => NULL,
            'text' => 'bg-primary',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:49:06'
        ]);

        Setting::create([
            'id' => 5,
            'slug' => 'header-color',
            'value' => 'bg-secondary header-text-light',
            'file' => NULL,
            'text' => 'bg-secondary',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 6,
            'slug' => 'header-color',
            'value' => 'bg-success header-text-dark',
            'file' => NULL,
            'text' => 'bg-success',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 7,
            'slug' => 'header-color',
            'value' => 'bg-info header-text-dark',
            'file' => NULL,
            'text' => 'bg-info',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 8,
            'slug' => 'header-color',
            'value' => 'bg-warning header-text-dark',
            'file' => NULL,
            'text' => 'bg-warning',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 9,
            'slug' => 'header-color',
            'value' => 'bg-danger header-text-light',
            'file' => NULL,
            'text' => 'bg-danger',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:53:32'
        ]);

        Setting::create([
            'id' => 10,
            'slug' => 'header-color',
            'value' => 'bg-light header-text-dark',
            'file' => NULL,
            'text' => 'bg-light',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:49:34'
        ]);

        Setting::create([
            'id' => 11,
            'slug' => 'header-color',
            'value' => 'bg-dark header-text-light',
            'file' => NULL,
            'text' => 'bg-dark',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 12,
            'slug' => 'header-color',
            'value' => 'bg-focus header-text-light',
            'file' => NULL,
            'text' => 'bg-focus',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-08-27 06:41:24'
        ]);

        Setting::create([
            'id' => 13,
            'slug' => 'header-color',
            'value' => 'bg-alternate header-text-light',
            'file' => NULL,
            'text' => 'bg-alternate',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:52:22'
        ]);

        Setting::create([
            'id' => 14,
            'slug' => 'header-color',
            'value' => 'bg-vicious-stance header-text-light',
            'file' => NULL,
            'text' => 'bg-vicious-stance',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:53:21'
        ]);

        Setting::create([
            'id' => 15,
            'slug' => 'header-color',
            'value' => 'bg-midnight-bloom header-text-light',
            'file' => NULL,
            'text' => 'bg-midnight-bloom',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 16,
            'slug' => 'header-color',
            'value' => 'bg-night-sky header-text-light',
            'file' => NULL,
            'text' => 'bg-night-sky',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 17,
            'slug' => 'header-color',
            'value' => 'bg-slick-carbon header-text-light',
            'file' => NULL,
            'text' => 'bg-slick-carbon',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:52:06'
        ]);

        Setting::create([
            'id' => 18,
            'slug' => 'header-color',
            'value' => 'bg-asteroid header-text-light',
            'file' => NULL,
            'text' => 'bg-asteroid',
            'active' => 1,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-08-27 06:41:24'
        ]);

        Setting::create([
            'id' => 19,
            'slug' => 'header-color',
            'value' => 'bg-royal header-text-light',
            'file' => NULL,
            'text' => 'bg-royal',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 18:35:45'
        ]);

        Setting::create([
            'id' => 20,
            'slug' => 'header-color',
            'value' => 'bg-warm-flame header-text-dark',
            'file' => NULL,
            'text' => 'bg-warm-flame',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 21,
            'slug' => 'header-color',
            'value' => 'bg-night-fade header-text-dark',
            'file' => NULL,
            'text' => 'bg-night-fade',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 22,
            'slug' => 'header-color',
            'value' => 'bg-sunny-morning header-text-dark',
            'file' => NULL,
            'text' => 'bg-sunny-morning',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 23,
            'slug' => 'header-color',
            'value' => 'bg-tempting-azure header-text-dark',
            'file' => NULL,
            'text' => 'bg-tempting-azure',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 24,
            'slug' => 'header-color',
            'value' => 'bg-amy-crisp header-text-dark',
            'file' => NULL,
            'text' => 'bg-amy-crisp',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 25,
            'slug' => 'header-color',
            'value' => 'bg-heavy-rain header-text-dark',
            'file' => NULL,
            'text' => 'bg-heavy-rain',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:52:15'
        ]);

        Setting::create([
            'id' => 26,
            'slug' => 'header-color',
            'value' => 'bg-mean-fruit header-text-dark',
            'file' => NULL,
            'text' => 'bg-mean-fruit',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 27,
            'slug' => 'header-color',
            'value' => 'bg-malibu-beach header-text-light',
            'file' => NULL,
            'text' => 'bg-malibu-beach',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 28,
            'slug' => 'header-color',
            'value' => 'bg-deep-blue header-text-dark',
            'file' => NULL,
            'text' => 'bg-deep-blue',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 29,
            'slug' => 'header-color',
            'value' => 'bg-ripe-malin header-text-light',
            'file' => NULL,
            'text' => 'bg-ripe-malin',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 30,
            'slug' => 'header-color',
            'value' => 'bg-arielle-smile header-text-light',
            'file' => NULL,
            'text' => 'bg-arielle-smile',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 31,
            'slug' => 'header-color',
            'value' => 'bg-plum-plate header-text-light',
            'file' => NULL,
            'text' => 'bg-plum-plate',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:49:46'
        ]);

        Setting::create([
            'id' => 32,
            'slug' => 'header-color',
            'value' => 'bg-happy-fisher header-text-dark',
            'file' => NULL,
            'text' => 'bg-happy-fisher',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 33,
            'slug' => 'header-color',
            'value' => 'bg-happy-itmeo header-text-light',
            'file' => NULL,
            'text' => 'bg-happy-itemo',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 34,
            'slug' => 'header-color',
            'value' => 'bg-mixed-hopes header-text-light',
            'file' => NULL,
            'text' => 'bg-mixed-hopes',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 35,
            'slug' => 'header-color',
            'value' => 'bg-strong-bliss header-text-light',
            'file' => NULL,
            'text' => 'bg-strong-bliss',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 36,
            'slug' => 'header-color',
            'value' => 'bg-grow-early header-text-light',
            'file' => NULL,
            'text' => 'bg-grow-early',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:49:56'
        ]);

        Setting::create([
            'id' => 37,
            'slug' => 'header-color',
            'value' => 'bg-love-kiss header-text-light',
            'file' => NULL,
            'text' => 'bg-love-kiss',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 38,
            'slug' => 'header-color',
            'value' => 'bg-premium-dark header-text-light',
            'file' => NULL,
            'text' => 'bg-premium-dark',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 39,
            'slug' => 'header-color',
            'value' => 'bg-happy-green header-text-light',
            'file' => NULL,
            'text' => 'bg-happy-green',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 40,
            'slug' => 'sidebar-color',
            'value' => 'bg-primary header-text-light',
            'file' => NULL,
            'text' => 'bg-primary',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 17:06:16'
        ]);

        Setting::create([
            'id' => 41,
            'slug' => 'sidebar-color',
            'value' => 'bg-secondary header-text-light',
            'file' => NULL,
            'text' => 'bg-secondary',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:48:58'
        ]);

        Setting::create([
            'id' => 42,
            'slug' => 'sidebar-color',
            'value' => 'bg-success header-text-dark',
            'file' => NULL,
            'text' => 'bg-success',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:49:33'
        ]);

        Setting::create([
            'id' => 43,
            'slug' => 'sidebar-color',
            'value' => 'bg-info header-text-dark',
            'file' => NULL,
            'text' => 'bg-info',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 08:02:55'
        ]);

        Setting::create([
            'id' => 44,
            'slug' => 'sidebar-color',
            'value' => 'bg-warning header-text-dark',
            'file' => NULL,
            'text' => 'bg-warning',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:49:54'
        ]);

        Setting::create([
            'id' => 45,
            'slug' => 'sidebar-color',
            'value' => 'bg-danger header-text-light',
            'file' => NULL,
            'text' => 'bg-danger',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 46,
            'slug' => 'sidebar-color',
            'value' => 'bg-light header-text-dark',
            'file' => NULL,
            'text' => 'bg-light',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 08:01:01'
        ]);

        Setting::create([
            'id' => 47,
            'slug' => 'sidebar-color',
            'value' => 'bg-dark header-text-light',
            'file' => NULL,
            'text' => 'bg-dark',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:53:38'
        ]);

        Setting::create([
            'id' => 48,
            'slug' => 'sidebar-color',
            'value' => 'bg-focus header-text-light',
            'file' => NULL,
            'text' => 'bg-focus',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:49:15'
        ]);

        Setting::create([
            'id' => 49,
            'slug' => 'sidebar-color',
            'value' => 'bg-alternate header-text-light',
            'file' => NULL,
            'text' => 'bg-alternate',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:49:29'
        ]);

        Setting::create([
            'id' => 50,
            'slug' => 'sidebar-color',
            'value' => 'bg-vicious-stance header-text-light',
            'file' => NULL,
            'text' => 'bg-vicious-stance',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 51,
            'slug' => 'sidebar-color',
            'value' => 'bg-midnight-bloom header-text-light',
            'file' => NULL,
            'text' => 'bg-midnight-bloom',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 52,
            'slug' => 'sidebar-color',
            'value' => 'bg-night-sky header-text-light',
            'file' => NULL,
            'text' => 'bg-night-sky',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:49:25'
        ]);

        Setting::create([
            'id' => 53,
            'slug' => 'sidebar-color',
            'value' => 'bg-slick-carbon header-text-light',
            'file' => NULL,
            'text' => 'bg-slick-carbon',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 54,
            'slug' => 'sidebar-color',
            'value' => 'bg-asteroid header-text-light',
            'file' => NULL,
            'text' => 'bg-asteroid',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 55,
            'slug' => 'sidebar-color',
            'value' => 'bg-royal header-text-light',
            'file' => NULL,
            'text' => 'bg-royal',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:49:22'
        ]);

        Setting::create([
            'id' => 56,
            'slug' => 'sidebar-color',
            'value' => 'bg-warm-flame header-text-dark',
            'file' => NULL,
            'text' => 'bg-warm-flame',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 57,
            'slug' => 'sidebar-color',
            'value' => 'bg-night-fade header-text-dark',
            'file' => NULL,
            'text' => 'bg-night-fade',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 58,
            'slug' => 'sidebar-color',
            'value' => 'bg-sunny-morning header-text-dark',
            'file' => NULL,
            'text' => 'bg-sunny-morning',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:49:18'
        ]);

        Setting::create([
            'id' => 59,
            'slug' => 'sidebar-color',
            'value' => 'bg-tempting-azure header-text-dark',
            'file' => NULL,
            'text' => 'bg-tempting-azure',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 60,
            'slug' => 'sidebar-color',
            'value' => 'bg-amy-crisp header-text-dark',
            'file' => NULL,
            'text' => 'bg-amy-crisp',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 61,
            'slug' => 'sidebar-color',
            'value' => 'bg-heavy-rain header-text-dark',
            'file' => NULL,
            'text' => 'bg-heavy-rain',
            'active' => 1,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:49:33'
        ]);

        Setting::create([
            'id' => 62,
            'slug' => 'sidebar-color',
            'value' => 'bg-mean-fruit header-text-dark',
            'file' => NULL,
            'text' => 'bg-mean-fruit',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 63,
            'slug' => 'sidebar-color',
            'value' => 'bg-malibu-beach header-text-light',
            'file' => NULL,
            'text' => 'bg-malibu-beach',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 64,
            'slug' => 'sidebar-color',
            'value' => 'bg-deep-blue header-text-dark',
            'file' => NULL,
            'text' => 'bg-deep-blue',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-07 00:49:02'
        ]);

        Setting::create([
            'id' => 65,
            'slug' => 'sidebar-color',
            'value' => 'bg-ripe-malin header-text-light',
            'file' => NULL,
            'text' => 'bg-ripe-malin',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 66,
            'slug' => 'sidebar-color',
            'value' => 'bg-arielle-smile header-text-light',
            'file' => NULL,
            'text' => 'bg-arielle-smile',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 67,
            'slug' => 'sidebar-color',
            'value' => 'bg-plum-plate header-text-light',
            'file' => NULL,
            'text' => 'bg-plum-plate',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 68,
            'slug' => 'sidebar-color',
            'value' => 'bg-happy-fisher header-text-dark',
            'file' => NULL,
            'text' => 'bg-happy-fisher',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 69,
            'slug' => 'sidebar-color',
            'value' => 'bg-happy-itmeo header-text-light',
            'file' => NULL,
            'text' => 'bg-happy-itemo',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 70,
            'slug' => 'sidebar-color',
            'value' => 'bg-mixed-hopes header-text-light',
            'file' => NULL,
            'text' => 'bg-mixed-hopes',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 71,
            'slug' => 'sidebar-color',
            'value' => 'bg-strong-bliss header-text-light',
            'file' => NULL,
            'text' => 'bg-strong-bliss',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 72,
            'slug' => 'sidebar-color',
            'value' => 'bg-grow-early header-text-light',
            'file' => NULL,
            'text' => 'bg-grow-early',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 73,
            'slug' => 'sidebar-color',
            'value' => 'bg-love-kiss header-text-light',
            'file' => NULL,
            'text' => 'bg-love-kiss',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 74,
            'slug' => 'sidebar-color',
            'value' => 'bg-premium-dark header-text-light',
            'file' => NULL,
            'text' => 'bg-premium-dark',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 75,
            'slug' => 'sidebar-color',
            'value' => 'bg-happy-green header-text-light',
            'file' => NULL,
            'text' => 'bg-happy-green',
            'active' => 0,
            'created_at' => '2020-02-06 07:37:37',
            'updated_at' => '2020-02-06 07:37:37'
        ]);

        Setting::create([
            'id' => 76,
            'slug' => 'image_post_max_size',
            'value' => '0',
            'file' => NULL,
            'text' => NULL,
            'active' => 0,
            'created_at' => '2020-08-27 07:10:13',
            'updated_at' => '2020-08-27 07:10:13'
        ]);

        Setting::create([
            'id' => 77,
            'slug' => 'file_post_max_size',
            'value' => '0',
            'file' => NULL,
            'text' => NULL,
            'active' => 0,
            'created_at' => '2020-08-27 07:12:53',
            'updated_at' => '2020-08-27 07:12:53'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
