<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cidade;
use App\Models\Medico;
use App\Models\MedicoPaciente;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Emílio C. Marques',
            'email' => 'emilio@example.com',
        ]);

        $cidades = Cidade::factory()->count(11)
            ->state(new Sequence(
                    [ 'nome' => 'Santo Antônio de Pádua', 'estado' => 'Rio de Janeiro'],
                    [ 'nome' => 'Aperibé', 'estado' => 'Rio de Janeiro'],
                    [ 'nome' => 'Itaocara', 'estado' => 'Rio de Janeiro'],
                    [ 'nome' => 'Miracema', 'estado' => 'Rio de Janeiro'],
                    [ 'nome' => 'Palma', 'estado' => 'Minas Gerais'],
                    [ 'nome' => 'Além Paraíba', 'estado' => 'Minas Gerais'],
                    [ 'nome' => 'Juiz de Fora', 'estado' => 'Minas Gerais'],
                    [ 'nome' => 'Vitória', 'estado' => 'Espirito Santo'],
                    [ 'nome' => 'Guarapai', 'estado' => 'Espirito Santo'],
                    [ 'nome' => 'Piúma', 'estado' => 'Espirito Santo'],
                    [ 'nome' => 'Marataízes', 'estado' => 'Espirito Santo'],
            ))
            ->create();

        $pacientes = Paciente::factory()
            ->count(10)
            ->create();

        $medicos = Medico::factory()
            ->count(20)
            ->recycle($cidades)
            ->create();

        MedicoPaciente::factory()
            ->recycle($medicos)
            ->recycle($pacientes)
            ->count(5)
            ->create();
    }
}
