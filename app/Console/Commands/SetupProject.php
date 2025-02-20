<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupProject extends Command
{
  protected $signature = 'project:setup';
  protected $description = 'Configuración inicial del proyecto';

  public function handle()
  {
    $this->info('📦 Instalando dependencias...');
    shell_exec('composer install');

    $this->info('📂 Copiando .env...');
    if(!file_exists('.env')) {
      copy('.env.example', '.env');
    }

    $this->info('🔑 Generando APP_KEY...');
    $this->call('key:generate');

    $this->info('💾 Ejecutando migraciones...');
    $this->call('migrate');

    $this->info('🌱 Ejecutando seeders personalizados...');
    $this->call('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
    $this->call('db:seed', ['--class' => 'AdminUserSeeder']);

    $this->info('🗑️ Limpiando caché...');
    $this->call('cache:clear');
    $this->call('config:clear');
    $this->call('route:clear');

    $this->info('✅ Proyecto configurado correctamente.');
  }
}
