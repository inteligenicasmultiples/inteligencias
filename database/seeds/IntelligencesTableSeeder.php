<?php

use App\Intelligence;
use Illuminate\Database\Seeder;

class IntelligencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intelligences = ['Lingüística',
            'Lógico-matemática',
            'Espacial',
            'Musical',
            'Corporal-cinestésica',
            'Intrapersonal',
            'Interpersonal',
            'Naturalista'];

        $slugs = ['linguistica',
            'logico-matematica',
            'espacial',
            'musical',
            'corporal-cinestesica',
            'intrapersonal',
            'interpersonal',
            'naturalista'];

        $descriptions = ['La función del lenguaje es universal, y su desarrollo en los niños es sorprendentemente similar en todas las culturas. Incluso en el caso de personas sordas a las que no se les ha enseñado explícitamente una lengua de signos, a menudo independientemente de una cierta modalidad en ello tienen dificultades para construir frases más sencillas. Al mismo tiempo, otros procesos mentales pueden quedar completamente ilesos.',
            'En los seres humanos dotados de esta forma de inteligencia, el proceso de resolución de problemas abstractos a menudo es extraordinariamente rápido: el matemático y científico en general competente maneja simultáneamente muchas variables y crea numerosas hipótesis que son evaluadas sucesivamente y, posteriormente, son aceptadas o rechazadas.',
            'La resolución de problemas espaciales se aplica a la navegación y al uso de mapas como sistema notacional. Otro tipo de solución a los problemas espaciales, aparece en la visualización de un objeto visto desde un ángulo diferente y en el juego del ajedrez. También se emplea este tipo de inteligencia en las artes visuales.',
            'Los datos procedentes de diversas culturas hablan de la universalidad de la noción musical. Incluso, los estudios sobre el desarrollo infantil sugieren que existe habilidad natural y una percepción auditiva (oído y cerebro) innata en la primera infancia hasta que existe la habilidad de interactuar con instrumentos y aprender sus sonidos, su naturaleza y sus capacidades.',
            'La evolución de los movimientos corporales especializados es de importancia obvia para la especie; en los humanos esta adaptación se extiende al uso de herramientas. El movimiento del cuerpo sigue un desarrollo claramente definido en los niños y no hay duda de su universalidad cultural.',
            'La inteligencia intrapersonal es el conocimiento de los aspectos internos de una persona: el acceso a la propia vida emocional, a la propia gama de sentimiento, la capacidad de efectuar discriminaciones entre ciertas emociones y, finalmente, ponerles un nombre y recurrir a ellas como medio de interpretar y orientar la propia conducta.',
            'La inteligencia interpersonal se constituye a partir de la capacidad nuclear para sentir distinciones entre los demás, en particular, contrastes en sus estados de ánimo, temperamento, motivaciones e intenciones. Esta inteligencia le permite a un adulto hábil, leer las intenciones y los deseos de los demás, aunque se los hayan ocultado. Esta capacidad se da de forma muy sofisticada en los líderes religiosos, políticos, terapeutas y maestros. Esta forma de inteligencia no depende necesariamente del lenguaje.',
            'Esta inteligencia la utilizamos cuando observamos la naturaleza o los elementos que se encuentran a nuestro alrededor. Se describe como la competencia para percibir las relaciones que existen entre varias especies o grupos de objetos y personas, así como reconocer y establecer si existen distinciones y semejanzas entre ellos.'];

        foreach ($intelligences as $index => $intelligence) {
            factory('App\Intelligence')
                ->create([
                    'name' => $intelligence,
                    'slug' => $slugs[$index],
                    'description' => $descriptions[$index],
                ]);

        }


    }
}
