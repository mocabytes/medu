<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicinas', function (Blueprint $table) {
            if (! Schema::hasColumn('medicinas', 'created_by')) {
                $table->foreignId('created_by')->nullable()->after('precio_venta')->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('medicinas', 'updated_by')) {
                $table->foreignId('updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('medicinas', function (Blueprint $table) {
            if (Schema::hasColumn('medicinas', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }
            if (Schema::hasColumn('medicinas', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });
    }
};
