<?php

namespace Database\Seeders;

use App\Models\Ejercicio;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EjerciciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->ejercicios as $ejercicio) {
            try {
                $e = new Ejercicio();
                $e->nombre_ejercicio = $ejercicio['nombre_ejercicio'];
                $e->slug = Str::slug($ejercicio['nombre_ejercicio']);
                $e->musculo = $ejercicio['musculo'];
                $e->aprobado = $ejercicio['aprobado'];
                $e->explicacion = $ejercicio['explicacion'];
                $e->imagen = "public/assets/{$ejercicio['imagen']}";
                $e->save();
            } catch (Exception $e) {
                $this->command->error('Error al insertar datos: ' . $e->getMessage());
            }
        }
        $this->command->info('Tabla ejercicios inicializada con datos');
    }

    private $ejercicios = array(
        [
            'nombre_ejercicio' => 'Peso muerto con mancuernas',
            'musculo' => 'pierna',
            'imagen' => 'peso_muerto1.jpeg',
            'aprobado' => true,
            'explicacion' => 'Agáchate y coge la barra con las manos separadas el ancho de los hombros. Contrae el abdomen y los glúteos, mantén la espalda recta, el pecho erguido y la mirada al frente y levanta la barra del suelo. Para levantar la barra del suelo, impúlsate con las piernas en lugar de tirar de la barra.'
        ],
        [
            'nombre_ejercicio' => 'Zancadas',
            'musculo' => 'pierna',
            'imagen' => 'zancadas.jpeg',
            'aprobado' => true,
            'explicacion' => 'Da un gran paso hacia adelante con una pierna y flexiona ambas rodillas hasta que la pierna de atrás casi toque el suelo. Luego, empuja con el talón de la pierna delantera para volver a la posición inicial.'
        ],
        [
            'nombre_ejercicio' => 'Prensa de piernas',
            'musculo' => 'pierna',
            'imagen' => 'prensa.png',
            'aprobado' => true,
            'explicacion' => 'Sentado en la máquina de prensa de piernas, coloca los pies en el soporte y empuja hacia afuera hasta que las piernas estén casi completamente extendidas. Luego, baja el peso controladamente hasta que las rodillas estén en un ángulo de 90 grados.'
        ],
        [
            'nombre_ejercicio' => 'Peso muerto rumano',
            'musculo' => 'pierna',
            'imagen' => 'peso_muerto_rumano.png',
            'aprobado' => true,
            'explicacion' => 'Con una barra o mancuernas, inclínate hacia adelante desde las caderas manteniendo las piernas casi rectas y la espalda recta. Baja el peso hacia el suelo manteniendo los músculos de la espalda y los glúteos contraídos, y luego vuelve a la posición inicial.'
        ],
        [
            'nombre_ejercicio' => 'Extensiones de cuádriceps',
            'musculo' => 'pierna',
            'imagen' => 'extensiones_cuadriceps.jpeg',
            'aprobado' => true,
            'explicacion' => 'Sentado en una máquina de extensiones de piernas, coloca los tobillos detrás del rodillo y extiende las piernas hacia afuera hasta que estén casi completamente extendidas. Luego, baja las piernas controladamente hasta la posición inicial.'
        ],
        [
            'nombre_ejercicio' => 'Peso muerto sumo',
            'musculo' => 'pierna',
            'imagen' => 'peso_muerto_sumo.jpeg',
            'aprobado' => true,
            'explicacion' => 'Con una postura amplia y los pies apuntando hacia afuera, agarra una barra o mancuernas y baja el peso hacia el suelo manteniendo la espalda recta y los glúteos contraídos. Luego, vuelve a la posición inicial empujando con los talones.'
        ],
        [
            'nombre_ejercicio' => 'Sentadilla búlgara',
            'musculo' => 'pierna',
            'imagen' => 'sentadilla_bulgara.jpeg',
            'aprobado' => true,
            'explicacion' => 'Sujeta una mancuerna en cada mano y coloca un pie en un banco detrás de ti. Flexiona la pierna delantera hasta que el muslo esté paralelo al suelo, manteniendo la espalda recta, y luego vuelve a la posición inicial.'
        ],
        [
            'nombre_ejercicio' => 'Elevación de talones de pie',
            'musculo' => 'pierna',
            'imagen' => 'gemelos.png',
            'aprobado' => true,
            'explicacion' => 'De pie, con los pies separados al ancho de los hombros y los talones en el suelo. Levanta los talones lo más alto posible mientras mantienes las piernas estiradas. Mantén la posición elevada por un momento y luego baja lentamente los talones de vuelta al suelo.'
        ],
        [
            'nombre_ejercicio' => 'Caminata de granjero',
            'musculo' => 'pierna',
            'imagen' => 'caminata_granjero.jpeg',
            'aprobado' => true,
            'explicacion' => 'Sujeta una pesa en cada mano y camina con pasos largos y controlados, manteniendo la espalda recta. Este ejercicio no solo trabaja las piernas, sino también los músculos de la parte superior del cuerpo.'
        ],
        [
            'nombre_ejercicio' => ' Curl de Femoral Sentado',
            'musculo' => 'pierna',
            'imagen' => 'caminata_granjero.jpeg',
            'aprobado' => true,
            'explicacion' => 'Siéntate en una máquina de curl de femoral con las almohadillas ajustadas a tus pantorrillas. Flexiona las rodillas hacia el pecho, manteniendo la espalda recta. Extiende las piernas lentamente y repite.'
        ],
        //ejercicio triceps
        array(
            'nombre_ejercicio' => 'Fondos en paralelas',
            'musculo' => 'triceps',
            'imagen' => 'fondos_paralelas.jpeg',
            'aprobado' => true,
            'explicacion' => 'Colócate entre dos barras paralelas, sosteniéndote con los brazos extendidos y los pies cruzados. Baja lentamente el cuerpo doblando los codos, luego vuelve a la posición inicial extendiendo los brazos.'
        ),
        array(
            'nombre_ejercicio' => 'Press francés',
            'musculo' => 'triceps',
            'imagen' => 'press_frances.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acuéstate sobre un banco plano y sostén una barra con las manos separadas al ancho de los hombros. Flexiona los codos para bajar la barra hacia la frente, manteniendo los brazos perpendiculares al suelo, luego extiéndelos para volver a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Patada de tríceps con mancuerna',
            'musculo' => 'triceps',
            'imagen' => 'patada_triceps_mancuerna.png',
            'aprobado' => true,
            'explicacion' => 'De pie, inclínate ligeramente hacia adelante y sostén una mancuerna en cada mano. Flexiona los codos para llevar las mancuernas hacia atrás, luego extiéndelos para volver a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Extensiones de tríceps en polea alta',
            'musculo' => 'triceps',
            'imagen' => 'extension_triceps_polea_alta.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie frente a una polea alta con una cuerda o barra, agarra el asa con ambas manos y lleva los codos hacia arriba. Extiende los brazos hacia abajo hasta que estén completamente rectos, luego vuelve a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Flexiones diamante',
            'musculo' => 'triceps',
            'imagen' => 'flexiones_diamante.jpeg',
            'aprobado' => true,
            'explicacion' => 'Realiza una flexión con las manos juntas formando un diamante debajo del pecho. Baja el cuerpo flexionando los codos, manteniendo los codos pegados al torso, luego vuelve a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Press de tríceps con barra',
            'musculo' => 'triceps',
            'imagen' => 'press_triceps_barra.png',
            'aprobado' => true,
            'explicacion' => 'Acuéstate sobre un banco plano y sostén una barra con las manos separadas al ancho de los hombros. Flexiona los codos para bajar la barra hacia la frente, manteniendo los brazos perpendiculares al suelo, luego extiéndelos para volver a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Extensiones de tríceps en polea baja',
            'musculo' => 'triceps',
            'imagen' => 'extension_triceps_polea_baja.jpg',
            'aprobado' => true,
            'explicacion' => 'De pie frente a una polea baja con una barra corta o cuerda, agarra el asa con ambas manos y lleva los codos hacia abajo. Extiende los brazos hacia adelante hasta que estén completamente rectos, luego vuelve a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Press cerrado',
            'musculo' => 'triceps',
            'imagen' => 'press_cerrado.jpeg',
            'aprobado' => true,
            'explicacion' => 'Sostén una barra con las manos separadas al ancho de los hombros o más cerca. Flexiona los codos para bajar la barra hacia el pecho, manteniendo los codos cerca del torso, luego extiéndelos para volver a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Flexiones de tríceps con banco',
            'musculo' => 'triceps',
            'imagen' => 'flexiones_triceps_banco.png',
            'aprobado' => true,
            'explicacion' => 'Colócate frente a un banco con las manos sobre el borde del asiento y los pies extendidos frente a ti. Flexiona los codos para bajar el cuerpo hacia el suelo, manteniendo los codos cerca del torso, luego extiéndelos para volver a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Jalones de tríceps en polea alta',
            'musculo' => 'triceps',
            'imagen' => 'jalones_triceps_polea_alta.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie frente a una polea alta con una barra o cuerda, agarra el asa con ambas manos y lleva los codos hacia abajo. Extiende los brazos hacia adelante hasta que estén completamente rectos, luego vuelve a la posición inicial.'
        ),
        //ejercicios biceps
        array(
            'nombre_ejercicio' => 'Curl de bíceps con barra',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_barra.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie, sostén una barra con las manos separadas al ancho de los hombros y los brazos extendidos. Flexiona los codos para levantar la barra hacia los hombros, manteniendo los codos pegados al cuerpo. Luego baja lentamente la barra a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Curl de bíceps con mancuernas',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_mancuernas.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie, con una mancuerna en cada mano y los brazos extendidos a los lados del cuerpo. Flexiona los codos para levantar las mancuernas hacia los hombros, manteniendo los codos pegados al cuerpo. Luego baja lentamente las mancuernas a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Curl de bíceps martillo',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_martillo.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie, con una mancuerna en cada mano y los brazos extendidos a los lados del cuerpo con las palmas mirándose. Flexiona los codos para levantar las mancuernas hacia los hombros, manteniendo los codos pegados al cuerpo. Luego baja lentamente las mancuernas a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Curl de bíceps en banco Scott',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_banco_scott.jpg',
            'aprobado' => true,
            'explicacion' => 'Siéntate en un banco Scott con los brazos extendidos y las axilas apoyadas en el cojín acolchado. Flexiona los codos para levantar la barra hacia los hombros, manteniendo los codos pegados al cuerpo. Luego baja lentamente la barra a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Curl de bíceps con polea baja',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_polea_baja.png',
            'aprobado' => true,
            'explicacion' => 'De pie frente a una polea baja con una barra corta o cuerda, agarra el asa con ambas manos y los brazos extendidos. Flexiona los codos para levantar la barra hacia los hombros, manteniendo los codos pegados al cuerpo. Luego baja lentamente la barra a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Curl de bíceps concentrado',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_concentrado.jpeg',
            'aprobado' => true,
            'explicacion' => 'Siéntate en un banco con las piernas separadas y los pies planos en el suelo. Sujeta una mancuerna con una mano y apoya el codo de esa misma mano en el interior del muslo. Flexiona el codo para levantar la mancuerna hacia los hombros, manteniendo el brazo quieto. Luego baja lentamente la mancuerna a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Curl de bíceps en polea alta',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_polea_alta.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie frente a una polea alta con una barra o cuerda, agarra el asa con ambas manos y los brazos extendidos. Flexiona los codos para levantar la barra hacia los hombros, manteniendo los codos pegados al cuerpo. Luego baja lentamente la barra a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Curl de bíceps 21',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_21.jpeg',
            'aprobado' => true,
            'explicacion' => 'Realiza 7 repeticiones desde la posición inicial hasta la mitad del recorrido, luego 7 repeticiones desde la mitad hasta la posición final y finalmente 7 repeticiones completas desde la posición inicial hasta la final sin descanso.'
        ),
        array(
            'nombre_ejercicio' => 'Curl de bíceps con gomas elásticas',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_gomas_elasticas.jpg',
            'aprobado' => true,
            'explicacion' => 'Párate sobre una goma elástica con los pies separados al ancho de los hombros. Agarra los extremos de la goma con las manos y flexiona los codos para levantar las manos hacia los hombros, manteniendo los codos pegados al cuerpo. Luego baja lentamente las manos a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Curl de bíceps invertido',
            'musculo' => 'biceps',
            'imagen' => 'curl_biceps_invertido.jpg',
            'aprobado' => true,
            'explicacion' => 'De pie, agarra una barra con las palmas hacia abajo y las manos separadas al ancho de los hombros. Flexiona los codos para levantar la barra hacia los hombros, manteniendo los codos pegados al cuerpo. Luego baja lentamente la barra a la posición inicial.'
        ),
        //ejercicios hombro
        array(
            'nombre_ejercicio' => 'Press de hombros con barra',
            'musculo' => 'hombro',
            'imagen' => 'press_hombros_barra.png',
            'aprobado' => true,
            'explicacion' => 'De pie, sostén una barra con las manos separadas al ancho de los hombros y los brazos extendidos por encima de la cabeza. Flexiona los codos para bajar la barra hacia los hombros, manteniendo la espalda recta y los abdominales contraídos. Luego extiende los codos para levantar la barra hacia arriba.'
        ),
        array(
            'nombre_ejercicio' => 'Press de hombros con mancuernas',
            'musculo' => 'hombro',
            'imagen' => 'press_hombros_mancuernas.png',
            'aprobado' => true,
            'explicacion' => 'De pie, con una mancuerna en cada mano y los brazos extendidos por encima de la cabeza. Flexiona los codos para bajar las mancuernas hacia los hombros, manteniendo la espalda recta y los abdominales contraídos. Luego extiende los codos para levantar las mancuernas hacia arriba.'
        ),
        array(
            'nombre_ejercicio' => 'Elevaciones laterales',
            'musculo' => 'hombro',
            'imagen' => 'elevaciones_laterales.jpg',
            'aprobado' => true,
            'explicacion' => 'De pie, con una mancuerna en cada mano y los brazos extendidos a los lados del cuerpo. Levanta las mancuernas hacia los lados hasta que estén paralelas al suelo, manteniendo los codos ligeramente flexionados. Luego baja lentamente las mancuernas a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Elevaciones frontales con mancuernas',
            'musculo' => 'hombro',
            'imagen' => 'elevaciones_frontales_mancuernas.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie, con una mancuerna en cada mano y los brazos extendidos frente al cuerpo. Levanta las mancuernas hacia adelante hasta la altura de los hombros, manteniendo los codos ligeramente flexionados. Luego baja lentamente las mancuernas a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Remo al mentón',
            'musculo' => 'hombro',
            'imagen' => 'remo_al_menton.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie, sostén una barra con las manos separadas al ancho de los hombros y los brazos extendidos frente al cuerpo. Flexiona los codos y lleva la barra hacia arriba, debajo del mentón, manteniendo los codos elevados y los hombros hacia atrás. Luego baja lentamente la barra a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Elevaciones frontales con polea',
            'musculo' => 'hombro',
            'imagen' => 'elevaciones_frontales_polea.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie frente a una polea baja con una cuerda, agarra el asa con ambas manos y los brazos extendidos frente al cuerpo. Levanta las manos hacia adelante hasta la altura de los hombros, manteniendo los codos ligeramente flexionados. Luego baja lentamente las manos a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Elevaciones posteriores con mancuernas',
            'musculo' => 'hombro',
            'imagen' => 'elevaciones_posteriores_mancuernas.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie, con una mancuerna en cada mano y los brazos extendidos frente al cuerpo. Levanta las mancuernas hacia atrás hasta que estén paralelas al suelo, manteniendo los codos ligeramente flexionados. Luego baja lentamente las mancuernas a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Elevaciones frontales alternadas',
            'musculo' => 'hombro',
            'imagen' => 'elevaciones_frontales_alternadas.jpg',
            'aprobado' => true,
            'explicacion' => 'De pie, con una mancuerna en cada mano y los brazos extendidos frente al cuerpo. Levanta una mancuerna hacia adelante hasta la altura del hombro, manteniendo el codo ligeramente flexionado. Luego baja lentamente la mancuerna a la posición inicial y repite con el otro brazo.'
        ),
        array(
            'nombre_ejercicio' => 'Elevaciones laterales en máquina',
            'musculo' => 'hombro',
            'imagen' => 'elevaciones_laterales_maquina.png',
            'aprobado' => true,
            'explicacion' => 'Sentado en una máquina de elevaciones laterales con los brazos a los lados del cuerpo, levanta los brazos hacia los lados hasta que estén paralelos al suelo, manteniendo los codos ligeramente flexionados. Luego baja lentamente los brazos a la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Press Arnold',
            'musculo' => 'hombro',
            'imagen' => 'press_arnold.jpeg',
            'aprobado' => true,
            'explicacion' => 'Sentado en un banco con respaldo vertical y una mancuerna en cada mano, con los codos flexionados y los brazos a los lados del cuerpo. Levanta las mancuernas hacia arriba y hacia afuera, girando las palmas hacia adelante durante el movimiento. Luego baja lentamente las mancuernas a la posición inicial.'
        ),
        //ejercicios de pecho
        array(
            'nombre_ejercicio' => 'Press de banca plano',
            'musculo' => 'pecho',
            'imagen' => 'press_banca_plano.png',
            'aprobado' => true,
            'explicacion' => 'Acostado en un banco plano con una barra sobre el pecho, baja la barra hacia el pecho doblando los codos y manteniendo los pies en el suelo. Luego empuja la barra hacia arriba hasta que los brazos estén extendidos, manteniendo los codos ligeramente flexionados al final del movimiento.'
        ),
        array(
            'nombre_ejercicio' => 'Press de banca inclinado',
            'musculo' => 'pecho',
            'imagen' => 'press_banca_inclinado.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acostado en un banco inclinado con una barra sobre el pecho, baja la barra hacia el pecho doblando los codos y manteniendo los pies en el suelo. Luego empuja la barra hacia arriba hasta que los brazos estén extendidos, manteniendo los codos ligeramente flexionados al final del movimiento.'
        ),
        array(
            'nombre_ejercicio' => 'Press de banca declinado',
            'musculo' => 'pecho',
            'imagen' => 'press_banca_declinado.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acostado en un banco declinado con una barra sobre el pecho, baja la barra hacia el pecho doblando los codos y manteniendo los pies en el suelo. Luego empuja la barra hacia arriba hasta que los brazos estén extendidos, manteniendo los codos ligeramente flexionados al final del movimiento.'
        ),
        array(
            'nombre_ejercicio' => 'Aperturas con mancuernas',
            'musculo' => 'pecho',
            'imagen' => 'aperturas_mancuernas.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acostado en un banco plano con una mancuerna en cada mano, los brazos extendidos y las palmas de las manos mirando hacia arriba, baja las mancuernas hacia los lados hasta que los brazos estén paralelos al suelo. Luego sube las mancuernas hacia arriba hasta que estén casi juntas.'
        ),
        array(
            'nombre_ejercicio' => 'Flexiones de brazos',
            'musculo' => 'pecho',
            'imagen' => 'flexiones_brazos.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acostado en el suelo boca abajo con las manos a la altura de los hombros y los pies juntos, baja el cuerpo hacia el suelo doblando los codos. Luego empuja el cuerpo hacia arriba hasta que los brazos estén extendidos, manteniendo el cuerpo recto.'
        ),
        array(
            'nombre_ejercicio' => 'Cruces en polea',
            'musculo' => 'pecho',
            'imagen' => 'cruces_polea.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie frente a una polea alta con las manos agarrando las asas, cruza las manos frente al pecho manteniendo los brazos ligeramente flexionados. Luego vuelve lentamente las manos a la posición inicial, manteniendo la tensión en los músculos pectorales.'
        ),
        array(
            'nombre_ejercicio' => 'Pull-over con mancuerna',
            'musculo' => 'pecho',
            'imagen' => 'pull_over_mancuerna.jpg',
            'aprobado' => true,
            'explicacion' => 'Acostado en un banco plano con una mancuerna en ambas manos, los brazos extendidos sobre la cabeza y los codos ligeramente flexionados, baja la mancuerna hacia atrás detrás de la cabeza manteniendo los brazos extendidos. Luego sube la mancuerna hacia arriba hasta la posición inicial.'
        ),
        array(
            'nombre_ejercicio' => 'Press con mancuernas en banco inclinado',
            'musculo' => 'pecho',
            'imagen' => 'press_mancuernas_inclinado.png',
            'aprobado' => true,
            'explicacion' => 'Acostado en un banco inclinado con una mancuerna en cada mano sobre el pecho, baja las mancuernas hacia los lados del pecho doblando los codos. Luego empuja las mancuernas hacia arriba hasta que los brazos estén extendidos, manteniendo los codos ligeramente flexionados al final del movimiento.'
        ),
        array(
            'nombre_ejercicio' => 'Flexiones diamante',
            'musculo' => 'pecho',
            'imagen' => 'flexiones_diamante_pecho.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acostado en el suelo boca abajo con las manos juntas debajo del pecho formando un diamante, baja el cuerpo hacia el suelo doblando los codos. Luego empuja el cuerpo hacia arriba hasta que los brazos estén extendidos, manteniendo el cuerpo recto.'
        ),
        //Ejercicios espalda
        array(
            'nombre_ejercicio' => 'Dominadas',
            'musculo' => 'espalda',
            'imagen' => 'dominadas.jpeg',
            'aprobado' => true,
            'explicacion' => 'Agárrate a una barra con las manos separadas al ancho de los hombros, sube el cuerpo hacia arriba doblando los codos y llevando la barbilla sobre la barra. Luego baja el cuerpo lentamente hasta que los brazos estén extendidos.'
        ),
        array(
            'nombre_ejercicio' => 'Peso muerto',
            'musculo' => 'espalda',
            'imagen' => 'peso_muerto.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie con los pies separados al ancho de los hombros y una barra en las manos, baja el cuerpo hacia adelante doblando las caderas y manteniendo la espalda recta. Luego levanta la barra hacia arriba hasta que el cuerpo esté erguido.'
        ),
        array(
            'nombre_ejercicio' => 'Remo con barra',
            'musculo' => 'espalda',
            'imagen' => 'remo_barra.jpeg',
            'aprobado' => true,
            'explicacion' => 'Agárrate a una barra con las manos separadas al ancho de los hombros, inclina el torso hacia adelante manteniendo la espalda recta y baja la barra hacia el cuerpo doblando los codos. Luego sube la barra hacia arriba hasta que toque el torso.'
        ),
        array(
            'nombre_ejercicio' => 'Remo con mancuerna',
            'musculo' => 'espalda',
            'imagen' => 'remo_mancuerna.png',
            'aprobado' => true,
            'explicacion' => 'De pie con una mancuerna en cada mano y el torso inclinado hacia adelante, baja las mancuernas hacia el cuerpo doblando los codos. Luego sube las mancuernas hacia arriba hasta que toquen el torso.'
        ),
        array(
            'nombre_ejercicio' => 'Jalón al pecho',
            'musculo' => 'espalda',
            'imagen' => 'jalon_pecho.jpg',
            'aprobado' => true,
            'explicacion' => 'Sentado en una máquina de poleas con las manos en la barra, jala la barra hacia abajo hacia el pecho doblando los codos. Luego levanta la barra hacia arriba hasta que los brazos estén extendidos.'
        ),
        array(
            'nombre_ejercicio' => 'Pulldown en polea alta',
            'musculo' => 'espalda',
            'imagen' => 'pulldown_polea_alta.jpeg',
            'aprobado' => true,
            'explicacion' => 'Sentado en una máquina de poleas con las manos en la barra, jala la barra hacia abajo hacia el pecho doblando los codos. Luego levanta la barra hacia arriba hasta que los brazos estén extendidos.'
        ),
        array(
            'nombre_ejercicio' => 'Hiperextensiones',
            'musculo' => 'espalda',
            'imagen' => 'hiperextensiones.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acuéstate boca abajo en una máquina de hiperextensiones con los tobillos sujetos, baja el torso hacia abajo doblando la cintura y manteniendo la espalda recta. Luego levanta el torso hacia arriba hasta que esté en línea recta con las piernas.'
        ),
        array(
            'nombre_ejercicio' => 'Peso muerto rumano',
            'musculo' => 'espalda',
            'imagen' => 'peso_muerto_rumano_pierna.jpeg',
            'aprobado' => true,
            'explicacion' => 'De pie con los pies separados al ancho de los hombros y una barra en las manos, baja el cuerpo hacia adelante doblando las caderas manteniendo la espalda recta. Luego levanta el cuerpo hacia arriba hasta que esté erguido.'
        ),
        array(
            'nombre_ejercicio' => 'Remo con barra T',
            'musculo' => 'espalda',
            'imagen' => 'remo_barra_t.jpeg',
            'aprobado' => true,
            'explicacion' => 'Agarra una barra T con las manos separadas al ancho de los hombros, inclina el torso hacia adelante y baja la barra hacia el cuerpo doblando los codos. Luego sube la barra hacia arriba hasta que toque el torso.'
        ),
        array(
            'nombre_ejercicio' => 'Pull Over',
            'musculo' => 'espalda',
            'imagen' => 'pull_over.png',
            'aprobado' => true,
            'explicacion' => 'Acuéstate en un banco con la cabeza y los hombros apoyados, agarra una mancuerna con ambas manos y baja los brazos hacia atrás por encima de la cabeza. Luego levanta la mancuerna hacia arriba hasta que esté sobre el pecho.'
        ),
        //ejercicios abdominales
        array(
            'nombre_ejercicio' => 'Crunch',
            'musculo' => 'abdominales',
            'imagen' => 'crunch.jpg',
            'aprobado' => true,
            'explicacion' => 'Acuéstate boca arriba con las rodillas dobladas y los pies apoyados en el suelo, coloca las manos detrás de la cabeza y eleva los hombros del suelo hacia las rodillas. Contrae los abdominales en la parte superior del movimiento y luego baja de nuevo.'
        ),
        array(
            'nombre_ejercicio' => 'Plank',
            'musculo' => 'abdominales',
            'imagen' => 'plank.jpg',
            'aprobado' => true,
            'explicacion' => 'Colócate boca abajo con los antebrazos y los dedos de los pies en el suelo, mantén el cuerpo en línea recta desde la cabeza hasta los talones. Mantén esta posición el mayor tiempo posible, contrayendo los abdominales y evitando que la cadera se hunda.'
        ),
        array(
            'nombre_ejercicio' => 'Leg Raises',
            'musculo' => 'abdominales',
            'imagen' => 'leg_raises.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acuéstate boca arriba con las piernas extendidas y las manos debajo de los glúteos, levanta las piernas hacia arriba manteniendo los pies juntos y los abdominales contraídos. Baja las piernas lentamente hacia abajo sin tocar el suelo y luego vuelve a subir.'
        ),
        array(
            'nombre_ejercicio' => 'Russian Twist',
            'musculo' => 'abdominales',
            'imagen' => 'russian_twist.png',
            'aprobado' => true,
            'explicacion' => 'Siéntate en el suelo con las rodillas dobladas y los pies apoyados en el suelo, inclina el torso hacia atrás ligeramente y levanta los pies del suelo. Gira el torso hacia un lado y luego hacia el otro, tocando el suelo con las manos en cada lado.'
        ),
        array(
            'nombre_ejercicio' => 'Mountain Climbers',
            'musculo' => 'abdominales',
            'imagen' => 'mountain_climbers.jpeg',
            'aprobado' => true,
            'explicacion' => 'Colócate en posición de plancha con las manos en el suelo y el cuerpo en línea recta desde la cabeza hasta los talones. Lleva una rodilla hacia el pecho y luego cambia de pierna rápidamente como si estuvieras corriendo en el lugar.'
        ),
        array(
            'nombre_ejercicio' => 'Bicycle Crunches',
            'musculo' => 'abdominales',
            'imagen' => 'bicycle_crunches.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acuéstate boca arriba con las rodillas dobladas y las manos detrás de la cabeza, lleva el codo derecho hacia la rodilla izquierda mientras extiendes la pierna derecha. Luego cambia de lado llevando el codo izquierdo hacia la rodilla derecha.'
        ),
        array(
            'nombre_ejercicio' => 'V-Ups',
            'musculo' => 'abdominales',
            'imagen' => 'v_ups.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acuéstate boca arriba con los brazos extendidos sobre la cabeza y las piernas extendidas, levanta el torso y las piernas al mismo tiempo formando una "V" con el cuerpo. Mantén los abdominales contraídos en la parte superior del movimiento.'
        ),
        array(
            'nombre_ejercicio' => 'Sit-Ups',
            'musculo' => 'abdominales',
            'imagen' => 'sit_ups.jpeg',
            'aprobado' => true,
            'explicacion' => 'Acuéstate boca arriba con las rodillas dobladas y los pies apoyados en el suelo, coloca las manos detrás de la cabeza y eleva el torso del suelo hacia las rodillas. Contrae los abdominales en la parte superior del movimiento y luego baja de nuevo.'
        ),
        array(
            'nombre_ejercicio' => 'Flutter Kicks',
            'musculo' => 'abdominales',
            'imagen' => 'flutter_kicks.jpg',
            'aprobado' => true,
            'explicacion' => 'Acuéstate boca arriba con las manos debajo de los glúteos y las piernas extendidas, levanta las piernas del suelo y alterna el movimiento de arriba abajo rápidamente. Mantén los abdominales contraídos y la espalda pegada al suelo.'
        ),
        array(
            'nombre_ejercicio' => 'Hanging Leg Raises',
            'musculo' => 'abdominales',
            'imagen' => 'hanging_leg_raises.jpeg',
            'aprobado' => true,
            'explicacion' => 'Agárrate a una barra con las manos separadas el ancho de los hombros y las piernas colgando, levanta las piernas hacia arriba manteniéndolas extendidas y los abdominales contraídos. Baja las piernas lentamente y repite el movimiento.'
        ),
    );
}