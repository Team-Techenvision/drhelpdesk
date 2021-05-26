<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlug extends Migration
{
    private $tables = [
        'blogs' => 'blog_title',
        'categories' => 'category_name',
        'products' => 'product_name',
        'packages' => 'package_name',
        'brands' => 'brand_name',
        'banners' => 'banner_name',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach($this->tables as $key => $tab){
            Schema::table($key, function (Blueprint $table) use ($key) {
                if (!Schema::hasColumn($key, 'slug')) {
                    $table->string('slug')->unique()->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach($this->tables as $tab){
            Schema::table($tab, function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
}
