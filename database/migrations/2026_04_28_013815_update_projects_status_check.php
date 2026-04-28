<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
// database/migrations/xxxx_xx_xx_update_projects_status_check.php

public function up()
{
    // On supprime l'ancien check pour en mettre un nouveau complet
    DB::statement("ALTER TABLE projects DROP CONSTRAINT IF EXISTS projects_status_check");
    DB::statement("ALTER TABLE projects ADD CONSTRAINT projects_status_check CHECK (status IN ('draft', 'onboarding', 'filled', 'developing', 'live'))");
}

public function down()
{
    DB::statement("ALTER TABLE projects DROP CONSTRAINT IF EXISTS projects_status_check");
    DB::statement("ALTER TABLE projects ADD CONSTRAINT projects_status_check CHECK (status IN ('draft', 'onboarding', 'developing', 'live'))");
}
};
