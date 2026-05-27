<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear carreras con nombre, código, descripción y estado activo
        $careers = [
            [
                'name' => 'Ingeniería de Sistemas',
                'code' => 'SIS-001',
                'description' => 'Forma profesionales en desarrollo de software, arquitectura de sistemas, bases de datos, redes y gestión de proyectos tecnológicos. Capacidad para liderar equipos de TI y solucionar problemas complejos.',
                'is_active' => true
            ],
            [
                'name' => 'Ingeniería Civil',
                'code' => 'CIV-002',
                'description' => 'Forma especialistas en diseño, construcción y mantenimiento de infraestructuras como puentes, carreteras, edificios y sistemas hidráulicos. Enfoque en seguridad, sostenibilidad y gestión de obras.',
                'is_active' => true
            ],
            [
                'name' => 'Administración de Empresas',
                'code' => 'ADM-003',
                'description' => 'Prepara líderes capaces de gestionar organizaciones, optimizar recursos, dirigir equipos humanos y tomar decisiones estratégicas. Áreas clave: finanzas, marketing, operaciones y RRHH.',
                'is_active' => true
            ],
            [
                'name' => 'Contabilidad',
                'code' => 'CON-004',
                'description' => 'Forma expertos en registros financieros, auditoría, impuestos y análisis contable. Capacidad para interpretar estados financieros y asesorar en la toma de decisiones económicas.',
                'is_active' => true
            ],
            [
                'name' => 'Derecho',
                'code' => 'DER-005',
                'description' => 'Forma profesionales con sólidos conocimientos en leyes, normas jurídicas y procedimientos legales. Capacidad para ejercer litigios, asesoría legal, derecho corporativo o judicial.',
                'is_active' => true
            ],
            [
                'name' => 'Medicina',
                'code' => 'MED-006',
                'description' => 'Forma médicos cirujanos capacitados para diagnosticar, tratar y prevenir enfermedades. Énfasis en ética profesional, investigación clínica y atención humanizada al paciente.',
                'is_active' => true
            ],
            [
                'name' => 'Psicología',
                'code' => 'PSI-007',
                'description' => 'Estudia el comportamiento humano y los procesos mentales. Capacita para intervenir en salud mental, orientación vocacional, psicología clínica, educativa u organizacional.',
                'is_active' => true
            ],
            [
                'name' => 'Marketing Digital',
                'code' => 'MKT-008',
                'description' => 'Forma expertos en estrategias de publicidad online, SEO, SEM, redes sociales, email marketing y analítica web. Capacidad para gestionar la presencia digital de marcas y empresas.',
                'is_active' => true
            ],
            [
                'name' => 'Ingeniería Industrial',
                'code' => 'IND-009',
                'description' => 'Optimiza procesos productivos, cadenas de suministro y sistemas logísticos. Enfoque en eficiencia, calidad, gestión de operaciones y mejora continua en entornos industriales.',
                'is_active' => true
            ],
            [
                'name' => 'Arquitectura',
                'code' => 'ARQ-010',
                'description' => 'Forma profesionales en diseño y planificación de espacios arquitectónicos. Combina creatividad, funcionalidad, sostenibilidad y conocimiento técnico-constructivo.',
                'is_active' => true
            ],
            [
                'name' => 'Enfermería',
                'code' => 'ENF-011',
                'description' => 'Prepara profesionales para el cuidado integral de la salud, asistencia en procedimientos médicos y promoción de hábitos saludables. Énfasis en atención humanizada y trabajo en equipo.',
                'is_active' => true
            ],
            [
                'name' => 'Ciencia de Datos',
                'code' => 'DAT-012',
                'description' => 'Forma expertos en análisis de grandes volúmenes de datos, machine learning, inteligencia artificial y visualización. Capacidad para extraer insights valiosos y apoyar decisiones empresariales basadas en datos.',
                'is_active' => true
            ],
        ];

        foreach ($careers as $career) {
            Career::create($career);
        }
    }
}
