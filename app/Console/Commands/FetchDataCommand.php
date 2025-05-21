<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessEmployeeData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class FetchDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtiene datos de empleados del API y los despacha a la cola para almacenar.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Obteniendo datos de la API...');

        try {
            $response = Http::get('http://dummy.restapiexample.com/api/v1/employees');

            if ($response->successful()) {
                $employees = $response->json()['data'];

                if (empty($employees)) {
                    $this->warn('No se encontraron datos de empleados en la respuesta de la API.');
                    return Command::SUCCESS;
                }

                foreach ($employees as $employee) {
                    ProcessEmployeeData::dispatch($employee);
                    $this->info("Empleado '{$employee['employee_name']}' despachado a la cola.");
                }

                $this->info('Todos los datos de empleados despachados a la cola exitosamente.');
            } else {
                $this->error('No se pudieron obtener datos de la API. Estado: ' . $response->status());
                Log::error('Fallo al obtener datos de la API', ['status' => $response->status(), 'response' => $response->body()]);
                return Command::FAILURE;
            }
        } catch (\Exception $e) {
            $this->error('Ocurrió un error: ' . $e->getMessage());
            Log::error('Error en FetchDataCommand', ['exception' => $e->getMessage()]);
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
