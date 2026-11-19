<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Só cria a coluna se ela ainda não existir.
        if (!Schema::hasColumn('users', 'user_type')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('user_type')
                    ->default(2)
                    ->after('password');
            });
        } else {
            // Se já existir, garante a posição e a definição.
            DB::statement("
                ALTER TABLE users
                MODIFY COLUMN user_type INT NOT NULL DEFAULT 2
                AFTER password
            ");
        }

        // Define os administradores.
        DB::table('users')
            ->whereIn('email', [
                'sara@gmail.com',
                'admin@gmail.com'
            ])
            ->update(['user_type' => 1]);
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'user_type')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('user_type');
            });
        }
    }
};
