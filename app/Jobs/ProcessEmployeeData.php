<?php

namespace App\Jobs;

use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessEmployeeData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $employeeData;

    /**
     * Crea una nueva instancia del job.
     */
    public function __construct(array $employeeData)
    {
        $this->employeeData = $employeeData;
    }

    /**
     * Ejecuta el job.
     */
    public function handle(): void
    {
        try {
            Employee::create([
                'name' => $this->employeeData['employee_name'],
                'age' => $this->employeeData['employee_age'],
                'salary' => $this->employeeData['employee_salary'],
                'profile_picture' => $this->employeeData['profile_image'],
            ]);

            Log::info('Empleado insertado correctamente: ' . $this->employeeData['employee_name']);
        } catch (\Exception $e) {
            Log::error('Error al insertar empleado: ' . $e->getMessage(), ['data' => $this->employeeData]);
        }
    }
}
