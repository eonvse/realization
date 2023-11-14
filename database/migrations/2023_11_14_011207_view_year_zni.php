<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

       \DB::statement($this->createView());

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        \DB::statement($this->dropView());
        
    }

    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW ZNI_year AS
            SELECT DISTINCT YEAR(dateZni) as yearZni  FROM clusters
            ORDER BY yearZNI desc
            SQL;
    }

    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `ZNI_year`;
            SQL;
    }
};
