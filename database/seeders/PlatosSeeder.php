<?php

namespace Database\Seeders;

use App\Models\Plato;
use App\Models\ValorNutricional;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlatosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->platos as $plato) {
            try {
                $p = new Plato();
                $c = new ValorNutricional();
                $p->nombre_plato = $plato['nombre_plato'];
                $p->slug = Str::slug($plato['nombre_plato']);
                $p->ingredientes = $plato['ingredientes'];
                $p->elaboracion = $plato['elaboracion'];
                $p->comida_dia = $plato['comida_dia'];
                $p->imagen = $plato['imagen'];
                $p->aprobado = $plato['aprobado'];
                $p->save();
                $c->calorias = $plato['calorias'];
                $c->azucar = $plato['azucar'];
                $c->carbohidratos = $plato['carbohidratos'];
                $c->grasas = $plato['grasas'];
                $c->vitaminas = $plato['vitaminas'];
                $c->proteinas = $plato['proteinas'];
                $c->fibra = $plato['fibra'];
                $c->plato_id = $p->id;
                $c->save();
                $p->valor_nutricional_id = $c->id;
            } catch (Exception $e) {
                $this->command->error('Error al insertar datos: ' . $e->getMessage());
            }
        }
    }

    private $platos = array(
        array(
            'nombre_plato' => 'Tostadas con aguacate',
            'ingredientes' => 'Pan, aguacate, aceite',
            'elaboracion' => 'Calienta dos tostadas de pan en tu tostadora o sarten y echa un chorro de aceite, despues untalas con aguacate',
            'comida_dia' => 'desayuno',
            'imagen' => 'tostadas_aguacate.jpeg',
            'aprobado' => true,
            'calorias' => 300,
            'azucar' => 5,
            'carbohidratos' => 30,
            'grasas' => 15,
            'vitaminas' => 20,
            'proteinas' => 10,
            'fibra' => 30
        ),
        array(
            'nombre_plato' => 'Batido de frutas',
            'ingredientes' => 'Fresas, plátano, leche de almendras, yogur griego',
            'elaboracion' => 'Licúa las fresas, el plátano, la leche de almendras y el yogur griego hasta que estén suaves y cremosos. Sirve frío.',
            'comida_dia' => 'desayuno',
            'imagen' => 'batido_frutas.jpeg',
            'aprobado' => true,
            'calorias' => 250,
            'azucar' => 20,
            'carbohidratos' => 40,
            'grasas' => 5,
            'vitaminas' => 35,
            'proteinas' => 8,
            'fibra' => 15
        ),
        array(
            'nombre_plato' => 'Avena con frutas',
            'ingredientes' => 'Avena, leche, plátano, fresas, nueces',
            'elaboracion' => 'Cocina la avena en la leche según las instrucciones del paquete. Sirve caliente y cubre con plátano en rodajas, fresas picadas y nueces.',
            'comida_dia' => 'desayuno',
            'imagen' => 'avena_frutas.jpg',
            'aprobado' => true,
            'calorias' => 350,
            'azucar' => 15,
            'carbohidratos' => 50,
            'grasas' => 10,
            'vitaminas' => 25,
            'proteinas' => 12,
            'fibra' => 20
        ),
        array(
            'nombre_plato' => 'Huevos revueltos con espinacas',
            'ingredientes' => 'Huevos, espinacas, aceite de oliva, sal, pimienta',
            'elaboracion' => 'En una sartén, calienta el aceite de oliva y saltea las espinacas hasta que estén tiernas. Agrega los huevos batidos y revuelve hasta que estén cocidos. Sazona con sal y pimienta al gusto.',
            'comida_dia' => 'desayuno',
            'imagen' => 'huevos_espinacas.jpeg',
            'aprobado' => true,
            'calorias' => 280,
            'azucar' => 2,
            'carbohidratos' => 5,
            'grasas' => 20,
            'vitaminas' => 40,
            'proteinas' => 15,
            'fibra' => 10
        ),
        array(
            'nombre_plato' => 'Panqueques de avena',
            'ingredientes' => 'Harina de avena, huevo, leche, polvo de hornear, canela, frutas frescas',
            'elaboracion' => 'Mezcla la harina de avena, el huevo, la leche, el polvo de hornear y la canela hasta obtener una masa homogénea. Cocina en una sartén caliente hasta que estén dorados por ambos lados. Sirve con frutas frescas encima.',
            'comida_dia' => 'desayuno',
            'imagen' => 'panqueques_avena.jpg',
            'aprobado' => true,
            'calorias' => 320,
            'azucar' => 10,
            'carbohidratos' => 40,
            'grasas' => 12,
            'vitaminas' => 30,
            'proteinas' => 10,
            'fibra' => 18
        ),
        array(
            'nombre_plato' => 'Yogur con granola y frutas',
            'ingredientes' => 'Yogur griego, granola, fresas, arándanos, almendras',
            'elaboracion' => 'Sirve el yogur griego en un bol y cubre con granola, fresas picadas, arándanos y almendras fileteadas.',
            'comida_dia' => 'desayuno',
            'imagen' => 'yogur_granola_frutas.jpeg',
            'aprobado' => true,
            'calorias' => 280,
            'azucar' => 15,
            'carbohidratos' => 30,
            'grasas' => 10,
            'vitaminas' => 25,
            'proteinas' => 15,
            'fibra' => 8
        ),
        array(
            'nombre_plato' => 'Tortilla de espinacas',
            'ingredientes' => 'Huevos, espinacas, cebolla, pimiento, sal, pimienta',
            'elaboracion' => 'Bate los huevos en un bol y añade las espinacas picadas, la cebolla y el pimiento cortados en trozos pequeños. Vierte la mezcla en una sartén caliente y cocina hasta que esté dorada por ambos lados. Sazona con sal y pimienta al gusto.',
            'comida_dia' => 'desayuno',
            'imagen' => 'tortilla_espinacas.jpeg',
            'aprobado' => true,
            'calorias' => 250,
            'azucar' => 3,
            'carbohidratos' => 8,
            'grasas' => 15,
            'vitaminas' => 35,
            'proteinas' => 14,
            'fibra' => 6
        ),
        array(
            'nombre_plato' => 'Smoothie bowl de frutas tropicales',
            'ingredientes' => 'Plátano, mango, piña, leche de coco, espinacas, granola',
            'elaboracion' => 'Licúa el plátano, el mango, la piña, la leche de coco y las espinacas hasta obtener una consistencia suave. Vierte en un bol y decora con granola y frutas frescas.',
            'comida_dia' => 'desayuno',
            'imagen' => 'smoothie_bowl_tropical.jpeg',
            'aprobado' => true,
            'calorias' => 320,
            'azucar' => 20,
            'carbohidratos' => 45,
            'grasas' => 10,
            'vitaminas' => 50,
            'proteinas' => 10,
            'fibra' => 12
        ),
        array(
            'nombre_plato' => 'Tostadas francesas',
            'ingredientes' => 'Pan de molde, huevo, leche, canela, vainilla, mantequilla',
            'elaboracion' => 'Bate el huevo con la leche, la canela y la vainilla en un bol. Sumerge las rebanadas de pan en la mezcla y fríelas en una sartén caliente con un poco de mantequilla hasta que estén doradas por ambos lados. Sirve caliente con sirope de arce o frutas frescas.',
            'comida_dia' => 'desayuno',
            'imagen' => 'tostadas_francesas.jpeg',
            'aprobado' => true,
            'calorias' => 380,
            'azucar' => 15,
            'carbohidratos' => 50,
            'grasas' => 18,
            'vitaminas' => 20,
            'proteinas' => 12,
            'fibra' => 8
        ),
        array(
            'nombre_plato' => 'Muffins de arándanos y avena',
            'ingredientes' => 'Harina de trigo integral, avena, arándanos, yogur griego, huevo, aceite de coco',
            'elaboracion' => 'Mezcla la harina de trigo integral, la avena, los arándanos, el yogur griego, el huevo y el aceite de coco en un bol. Vierte la mezcla en moldes para muffins y hornea en el horno precalentado a 180°C durante 20-25 minutos o hasta que estén dorados.',
            'comida_dia' => 'desayuno',
            'imagen' => 'muffins_arandanos_avena.jpg',
            'aprobado' => true,
            'calorias' => 300,
            'azucar' => 10,
            'carbohidratos' => 35,
            'grasas' => 14,
            'vitaminas' => 25,
            'proteinas' => 10,
            'fibra' => 12
        ),
        //comidas
        array(
            'nombre_plato' => 'Ensalada César',
            'ingredientes' => 'Lechuga romana, pollo a la parrilla, crutones, queso parmesano, aderezo César',
            'elaboracion' => 'Combina la lechuga romana picada, el pollo a la parrilla en tiras, los crutones, el queso parmesano rallado y el aderezo César en un bol grande y mezcla bien. Sirve frío.',
            'comida_dia' => 'comida',
            'imagen' => 'ensalada_cesar.jpg',
            'aprobado' => true,
            'calorias' => 400,
            'azucar' => 8,
            'carbohidratos' => 20,
            'grasas' => 25,
            'vitaminas' => 30,
            'proteinas' => 30,
            'fibra' => 10
        ),
        array(
            'nombre_plato' => 'Salmón al horno con vegetales',
            'ingredientes' => 'Filete de salmón, brócoli, zanahorias, calabacín, aceite de oliva, sal, pimienta, hierbas provenzales',
            'elaboracion' => 'Coloca el salmón en una bandeja para hornear y añade los vegetales cortados en trozos. Rocía con aceite de oliva, sazona con sal, pimienta y hierbas provenzales. Hornea a 180°C durante 20-25 minutos o hasta que el salmón esté cocido y los vegetales estén tiernos.',
            'comida_dia' => 'comida',
            'imagen' => 'salmon_horno_vegetales.jpg',
            'aprobado' => true,
            'calorias' => 450,
            'azucar' => 5,
            'carbohidratos' => 15,
            'grasas' => 30,
            'vitaminas' => 40,
            'proteinas' => 35,
            'fibra' => 12
        ),
        array(
            'nombre_plato' => 'Pasta con salsa marinara',
            'ingredientes' => 'Pasta de trigo integral, tomates, cebolla, ajo, aceite de oliva, albahaca fresca, queso parmesano',
            'elaboracion' => 'Cocina la pasta según las instrucciones del paquete. Mientras tanto, calienta el aceite de oliva en una sartén y saltea la cebolla y el ajo picados hasta que estén dorados. Agrega los tomates picados y la albahaca fresca picada y cocina a fuego lento durante 15-20 minutos. Sirve la salsa sobre la pasta cocida y espolvorea con queso parmesano rallado.',
            'comida_dia' => 'comida',
            'imagen' => 'pasta_salsa_marinara.jpeg',
            'aprobado' => true,
            'calorias' => 380,
            'azucar' => 10,
            'carbohidratos' => 50,
            'grasas' => 12,
            'vitaminas' => 25,
            'proteinas' => 15,
            'fibra' => 8
        ),
        array(
            'nombre_plato' => 'Arroz frito con verduras y tofu',
            'ingredientes' => 'Arroz integral, tofu, brócoli, zanahorias, pimiento rojo, cebolla, ajo, jengibre, salsa de soja, aceite de sésamo',
            'elaboracion' => 'Cocina el arroz integral según las instrucciones del paquete. Mientras tanto, saltea el tofu en cubos y las verduras cortadas en una sartén con aceite de sésamo, ajo y jengibre picados. Agrega el arroz cocido y la salsa de soja y revuelve bien hasta que esté todo caliente.',
            'comida_dia' => 'comida',
            'imagen' => 'arroz_frito_verduras_tofu.jpg',
            'aprobado' => true,
            'calorias' => 420,
            'azucar' => 6,
            'carbohidratos' => 55,
            'grasas' => 18,
            'vitaminas' => 35,
            'proteinas' => 20,
            'fibra' => 10
        ),
        array(
            'nombre_plato' => 'Lasaña de verduras',
            'ingredientes' => 'Pasta de lasaña, espinacas, calabacín, berenjena, champiñones, salsa de tomate, queso mozzarella, queso ricotta',
            'elaboracion' => 'Cocina la pasta de lasaña según las instrucciones del paquete. Mientras tanto, saltea las espinacas, el calabacín, la berenjena y los champiñones en una sartén con un poco de aceite de oliva. Monta la lasaña en un molde para hornear alternando capas de pasta, verduras salteadas, salsa de tomate y queso ricotta. Cubre con queso mozzarella rallado y hornea a 180°C durante 30-35 minutos o hasta que esté dorada y burbujeante.',
            'comida_dia' => 'comida',
            'imagen' => 'lasana_verduras.jpeg',
            'aprobado' => true,
            'calorias' => 380,
            'azucar' => 8,
            'carbohidratos' => 45,
            'grasas' => 20,
            'vitaminas' => 30,
            'proteinas' => 18,
            'fibra' => 12
        ),
        array(
            'nombre_plato' => 'Hamburguesa de lentejas',
            'ingredientes' => 'Lentejas cocidas, cebolla, ajo, zanahoria, pan rallado, huevo, comino, pimienta, pan de hamburguesa integral, tomate, lechuga, aguacate',
            'elaboracion' => 'Tritura las lentejas cocidas en un procesador de alimentos. Saltea la cebolla, el ajo y la zanahoria picados en una sartén con un poco de aceite de oliva. Mezcla las lentejas trituradas, las verduras salteadas, el pan rallado, el huevo batido, el comino y la pimienta en un bol y forma hamburguesas con la mezcla. Cocina las hamburguesas en una sartén caliente con un poco de aceite hasta que estén doradas por ambos lados. Sirve en pan de hamburguesa integral con rodajas de tomate, hojas de lechuga y aguacate.',
            'comida_dia' => 'comida',
            'imagen' => 'hamburguesa_lentejas.jpg',
            'aprobado' => true,
            'calorias' => 420,
            'azucar' => 6,
            'carbohidratos' => 55,
            'grasas' => 18,
            'vitaminas' => 30,
            'proteinas' => 22,
            'fibra' => 14
        ),
        array(
            'nombre_plato' => 'Sopa de verduras',
            'ingredientes' => 'Caldo de verduras, zanahoria, apio, cebolla, pimiento, tomate, judías verdes, espinacas, pasta pequeña, albahaca fresca',
            'elaboracion' => 'Hierve el caldo de verduras en una olla grande. Agrega las zanahorias, el apio, la cebolla y el pimiento cortados en trozos y cocina a fuego lento durante 10-15 minutos. Añade los tomates picados, las judías verdes, las espinacas y la pasta pequeña y cocina hasta que las verduras estén tiernas y la pasta esté cocida. Sazona al gusto con albahaca fresca picada antes de servir.',
            'comida_dia' => 'comida',
            'imagen' => 'sopa_verduras.jpg',
            'aprobado' => true,
            'calorias' => 250,
            'azucar' => 5,
            'carbohidratos' => 35,
            'grasas' => 8,
            'vitaminas' => 45,
            'proteinas' => 10,
            'fibra' => 15
        ),
        array(
            'nombre_plato' => 'Wraps de pollo y aguacate',
            'ingredientes' => 'Tortillas de trigo integral, pechuga de pollo a la parrilla, aguacate, lechuga, tomate, cebolla morada, mayonesa baja en grasa',
            'elaboracion' => 'Coloca una tortilla de trigo integral en una superficie plana y añade tiras de pechuga de pollo a la parrilla, rodajas de aguacate, hojas de lechuga, rodajas de tomate y cebolla morada en juliana. Unta con mayonesa baja en grasa y enrolla la tortilla. Corta en mitades y sirve frío.',
            'comida_dia' => 'comida',
            'imagen' => 'wraps_pollo_aguacate.jpg',
            'aprobado' => true,
            'calorias' => 380,
            'azucar' => 6,
            'carbohidratos' => 40,
            'grasas' => 15,
            'vitaminas' => 40,
            'proteinas' => 28,
            'fibra' => 10
        ),
        array(
            'nombre_plato' => 'Poke Bowl de salmón',
            'ingredientes' => 'Arroz blanco, salmón fresco, aguacate, pepino, zanahoria, edamame, algas nori, salsa de soja, aceite de sésamo, semillas de sésamo',
            'elaboracion' => 'Cocina el arroz blanco según las instrucciones del paquete y déjalo enfriar. Corta el salmón fresco en cubos y el resto de los ingredientes en rodajas finas. Coloca el arroz en un bol grande y añade el salmón, el aguacate, el pepino, la zanahoria, los edamames y las algas nori cortadas en trozos pequeños. Riega con salsa de soja y aceite de sésamo y espolvorea con semillas de sésamo antes de servir.',
            'comida_dia' => 'comida',
            'imagen' => 'poke_bowl_salmon.jpg',
            'aprobado' => true,
            'calorias' => 420,
            'azucar' => 7,
            'carbohidratos' => 45,
            'grasas' => 20,
            'vitaminas' => 50,
            'proteinas' => 30,
            'fibra' => 10
        ),
        array(
            'nombre_plato' => 'Burritos vegetarianos',
            'ingredientes' => 'Tortillas de maíz, frijoles negros cocidos, arroz integral, maíz, pimientos, cebolla, tomate, queso cheddar rallado, crema agria, cilantro',
            'elaboracion' => 'Calienta las tortillas de maíz en una sartén o microondas. Extiende una capa de frijoles negros cocidos y arroz integral en el centro de cada tortilla. Agrega el maíz, los pimientos, la cebolla, el tomate y el queso cheddar rallado. Dobla los extremos de la tortilla hacia adentro y enróllala. Sirve con crema agria y cilantro picado.',
            'comida_dia' => 'comida',
            'imagen' => 'burritos_vegetarianos.jpeg',
            'aprobado' => true,
            'calorias' => 380,
            'azucar' => 6,
            'carbohidratos' => 50,
            'grasas' => 15,
            'vitaminas' => 40,
            'proteinas' => 18,
            'fibra' => 14
        ),
        //meriendas
        array(
            'nombre_plato' => 'Batido de proteínas de chocolate',
            'ingredientes' => 'Leche de almendras, proteína en polvo sabor chocolate, plátano, mantequilla de almendras, hielo',
            'elaboracion' => 'Mezcla todos los ingredientes en una licuadora hasta que estén suaves y cremosos. Sirve frío.',
            'comida_dia' => 'merienda',
            'imagen' => 'batido_proteinas_chocolate.jpeg',
            'aprobado' => true,
            'calorias' => 250,
            'azucar' => 10,
            'carbohidratos' => 20,
            'grasas' => 10,
            'vitaminas' => 15,
            'proteinas' => 25,
            'fibra' => 5
        ),
        array(
            'nombre_plato' => 'Yogur griego con nueces y miel',
            'ingredientes' => 'Yogur griego, nueces, miel',
            'elaboracion' => 'Coloca el yogur griego en un bol y añade las nueces picadas y un chorrito de miel por encima. Mezcla bien y sirve frío.',
            'comida_dia' => 'merienda',
            'imagen' => 'yogur_griego_nueces_miel.jpeg',
            'aprobado' => true,
            'calorias' => 200,
            'azucar' => 8,
            'carbohidratos' => 15,
            'grasas' => 12,
            'vitaminas' => 10,
            'proteinas' => 18,
            'fibra' => 4
        ),
        array(
            'nombre_plato' => 'Huevos duros con aguacate',
            'ingredientes' => 'Huevos, aguacate, sal, pimienta',
            'elaboracion' => 'Hierve los huevos durante 10 minutos, luego enfríalos en agua fría y pélalos. Corta el aguacate en rodajas. Sirve los huevos duros con rodajas de aguacate y sazona con sal y pimienta al gusto.',
            'comida_dia' => 'merienda',
            'imagen' => 'huevos_duros_aguacate.jpg',
            'aprobado' => true,
            'calorias' => 220,
            'azucar' => 2,
            'carbohidratos' => 5,
            'grasas' => 15,
            'vitaminas' => 20,
            'proteinas' => 14,
            'fibra' => 6
        ),
        array(
            'nombre_plato' => 'Tortitas de avena y plátano',
            'ingredientes' => 'Avena, plátano maduro, huevo, canela, extracto de vainilla',
            'elaboracion' => 'Tritura la avena en un procesador de alimentos hasta obtener una harina fina. En un bol, machaca el plátano maduro con un tenedor y luego mezcla con la harina de avena, el huevo, la canela y el extracto de vainilla. Calienta una sartén antiadherente y vierte la masa en pequeñas porciones para formar las tortitas. Cocina por ambos lados hasta que estén doradas. Sirve caliente.',
            'comida_dia' => 'merienda',
            'imagen' => 'tortitas_avena_platano.jpg',
            'aprobado' => true,
            'calorias' => 280,
            'azucar' => 8,
            'carbohidratos' => 35,
            'grasas' => 10,
            'vitaminas' => 15,
            'proteinas' => 12,
            'fibra' => 6
        ),
        array(
            'nombre_plato' => 'Rollitos de pechuga de pavo y queso',
            'ingredientes' => 'Pechuga de pavo en lonchas, queso crema bajo en grasa, espinacas',
            'elaboracion' => 'Extiende una loncha de pechuga de pavo y unta una capa fina de queso crema bajo en grasa. Coloca unas hojas de espinacas encima y enrolla la pechuga de pavo. Corta en rodajas y sirve frío.',
            'comida_dia' => 'merienda',
            'imagen' => 'rollitos_pechuga_pavo_queso.jpeg',
            'aprobado' => true,
            'calorias' => 180,
            'azucar' => 2,
            'carbohidratos' => 5,
            'grasas' => 8,
            'vitaminas' => 10,
            'proteinas' => 20,
            'fibra' => 3
        ),
        array(
            'nombre_plato' => 'Batido de frutas y proteínas',
            'ingredientes' => 'Leche de almendras, proteína en polvo sin sabor, fresas, plátano, espinacas frescas',
            'elaboracion' => 'Mezcla todos los ingredientes en una licuadora hasta que estén suaves y cremosos. Añade hielo si lo deseas y sirve frío.',
            'comida_dia' => 'merienda',
            'imagen' => 'batido_frutas_proteinas.jpg',
            'aprobado' => true,
            'calorias' => 220,
            'azucar' => 12,
            'carbohidratos' => 25,
            'grasas' => 8,
            'vitaminas' => 20,
            'proteinas' => 18,
            'fibra' => 5
        ),
        array(
            'nombre_plato' => 'Yogur griego con frutos secos',
            'ingredientes' => 'Yogur griego, almendras, nueces, avellanas, miel',
            'elaboracion' => 'Coloca el yogur griego en un bol y añade las almendras, nueces y avellanas picadas. Rocía con un poco de miel por encima y sirve frío.',
            'comida_dia' => 'merienda',
            'imagen' => 'yogur_griego_frutos_secos.jpeg',
            'aprobado' => true,
            'calorias' => 250,
            'azucar' => 10,
            'carbohidratos' => 15,
            'grasas' => 15,
            'vitaminas' => 15,
            'proteinas' => 12,
            'fibra' => 6
        ),
        array(
            'nombre_plato' => 'Ensalada de atún y garbanzos',
            'ingredientes' => 'Atún en lata, garbanzos cocidos, pepino, tomate, cebolla morada, pimiento rojo, aceitunas negras, aceite de oliva, vinagre balsámico',
            'elaboracion' => 'Combina el atún en lata escurrido con los garbanzos cocidos en un bol grande. Agrega el pepino, el tomate, la cebolla morada, el pimiento rojo y las aceitunas negras cortados en trozos. Aliña con aceite de oliva y vinagre balsámico al gusto y mezcla bien. Sirve frío.',
            'comida_dia' => 'merienda',
            'imagen' => 'ensalada_atun_garbanzos.jpg',
            'aprobado' => true,
            'calorias' => 280,
            'azucar' => 5,
            'carbohidratos' => 20,
            'grasas' => 12,
            'vitaminas' => 25,
            'proteinas' => 22,
            'fibra' => 8
        ),
        array(
            'nombre_plato' => 'Hummus con palitos de zanahoria',
            'ingredientes' => 'Garbanzos cocidos, tahini, ajo, jugo de limón, aceite de oliva, sal, palitos de zanahoria',
            'elaboracion' => 'Tritura los garbanzos cocidos en un procesador de alimentos con tahini, ajo picado, jugo de limón, aceite de oliva y sal hasta obtener una mezcla suave. Sirve el hummus con palitos de zanahoria para mojar.',
            'comida_dia' => 'merienda',
            'imagen' => 'hummus_palo_zanahoria.jpeg',
            'aprobado' => true,
            'calorias' => 200,
            'azucar' => 3,
            'carbohidratos' => 25,
            'grasas' => 10,
            'vitaminas' => 20,
            'proteinas' => 10,
            'fibra' => 6
        ),
        array(
            'nombre_plato' => 'Tostadas de aguacate y huevo',
            'ingredientes' => 'Pan integral, aguacate, huevo, tomate cherry, sal, pimienta',
            'elaboracion' => 'Tuesta el pan integral y unta con aguacate maduro. Cocina un huevo escalfado y colócalo sobre el aguacate. Decora con tomates cherry cortados por la mitad y sazona con sal y pimienta al gusto.',
            'comida_dia' => 'merienda',
            'imagen' => 'tostadas_aguacate_huevo.jpg',
            'aprobado' => true,
            'calorias' => 230,
            'azucar' => 4,
            'carbohidratos' => 20,
            'grasas' => 12,
            'vitaminas' => 15,
            'proteinas' => 14,
            'fibra' => 6
        ),
        //Cenas
        array(
            'nombre_plato' => 'Pollo a la parrilla con verduras asadas',
            'ingredientes' => 'Pechuga de pollo, pimientos, cebolla, calabacín, aceite de oliva, sal, pimienta, hierbas aromáticas',
            'elaboracion' => 'Sazona la pechuga de pollo con sal, pimienta y hierbas aromáticas al gusto. Asa a la parrilla o en una sartén antiadherente hasta que esté cocido por completo. Acompaña con verduras asadas al gusto.',
            'comida_dia' => 'cena',
            'imagen' => 'pollo_parrilla_verduras.jpeg',
            'aprobado' => true,
            'calorias' => 300,
            'azucar' => 4,
            'carbohidratos' => 10,
            'grasas' => 12,
            'vitaminas' => 20,
            'proteinas' => 35,
            'fibra' => 8
        ),
        array(
            'nombre_plato' => 'Salmón al horno con espárragos',
            'ingredientes' => 'Filete de salmón, espárragos, aceite de oliva, limón, sal, pimienta, ajo en polvo',
            'elaboracion' => 'Coloca el filete de salmón en una bandeja para hornear y rocía con aceite de oliva, jugo de limón, sal, pimienta y ajo en polvo al gusto. Hornea a 180°C durante 15-20 minutos o hasta que el salmón esté cocido. Acompaña con espárragos asados.',
            'comida_dia' => 'cena',
            'imagen' => 'salmon_horno_esparragos.jpg',
            'aprobado' => true,
            'calorias' => 320,
            'azucar' => 3,
            'carbohidratos' => 8,
            'grasas' => 15,
            'vitaminas' => 25,
            'proteinas' => 30,
            'fibra' => 10
        ),
        array(
            'nombre_plato' => 'Ensalada de quinoa con aguacate y camarones',
            'ingredientes' => 'Quinoa, aguacate, camarones, tomate, pepino, pimiento rojo, cilantro, limón, aceite de oliva, sal, pimienta',
            'elaboracion' => 'Cuece la quinoa según las instrucciones del paquete y deja enfriar. Mezcla la quinoa con aguacate en cubos, camarones cocidos, tomate, pepino y pimiento rojo picados, y cilantro fresco picado. Aliña con jugo de limón, aceite de oliva, sal y pimienta al gusto.',
            'comida_dia' => 'cena',
            'imagen' => 'ensalada_quinoa_aguacate_camarones.jpg',
            'aprobado' => true,
            'calorias' => 350,
            'azucar' => 5,
            'carbohidratos' => 30,
            'grasas' => 18,
            'vitaminas' => 30,
            'proteinas' => 25,
            'fibra' => 7
        ),
        array(
            'nombre_plato' => 'Filete de ternera a la plancha con ensalada verde',
            'ingredientes' => 'Filete de ternera, lechuga, espinacas, rúcula, tomate cherry, pepino, vinagreta',
            'elaboracion' => 'Cocina el filete de ternera a la plancha con un poco de sal y pimienta al gusto. Prepara una ensalada verde con lechuga, espinacas, rúcula, tomate cherry y pepino. Aliña con tu vinagreta favorita y sirve junto con el filete de ternera.',
            'comida_dia' => 'cena',
            'imagen' => 'filete_ternera_plan.jpg',
            'aprobado' => true,
            'calorias' => 320,
            'azucar' => 3,
            'carbohidratos' => 8,
            'grasas' => 15,
            'vitaminas' => 25,
            'proteinas' => 30,
            'fibra' => 10
        ),
        array(
            'nombre_plato' => 'Pechuga de pollo rellena de espinacas y queso feta',
            'ingredientes' => 'Pechuga de pollo, espinacas frescas, queso feta, ajo, aceite de oliva, sal, pimienta',
            'elaboracion' => 'Abre la pechuga de pollo por la mitad y rellena con espinacas frescas y queso feta desmenuzado. Sella los bordes con palillos de dientes. En una sartén caliente con aceite de oliva, cocina la pechuga de pollo rellena hasta que esté dorada por ambos lados y cocida por dentro. Sazona con sal, pimienta y ajo picado al gusto.',
            'comida_dia' => 'cena',
            'imagen' => 'pechuga_pollo_espinacas_queso_feta.jpeg',
            'aprobado' => true,
            'calorias' => 300,
            'azucar' => 3,
            'carbohidratos' => 5,
            'grasas' => 12,
            'vitaminas' => 20,
            'proteinas' => 35,
            'fibra' => 6
        ),
        array(
            'nombre_plato' => 'Sopa de lentejas con jamón',
            'ingredientes' => 'Lentejas, jamón serrano, cebolla, zanahoria, apio, tomate, ajo, caldo de pollo, laurel, sal, pimienta',
            'elaboracion' => 'En una olla grande, sofríe la cebolla, zanahoria, apio y ajo picados en un poco de aceite de oliva. Añade el tomate picado y cocina hasta que se ablande. Agrega las lentejas, el jamón serrano en trozos, el caldo de pollo, el laurel, la sal y la pimienta. Cocina a fuego lento hasta que las lentejas estén tiernas. Sirve caliente.',
            'comida_dia' => 'cena',
            'imagen' => 'sopa_lentejas_jamon.jpg',
            'aprobado' => true,
            'calorias' => 280,
            'azucar' => 3,
            'carbohidratos' => 30,
            'grasas' => 8,
            'vitaminas' => 20,
            'proteinas' => 20,
            'fibra' => 12
        ),
        array(
            'nombre_plato' => 'Wrap de pollo con guacamole',
            'ingredientes' => 'Tortillas de maíz, pechuga de pollo, aguacate, tomate, cebolla morada, cilantro, limón, sal, pimienta, chile en polvo',
            'elaboracion' => 'Cocina la pechuga de pollo a la parrilla o en una sartén hasta que esté cocida por completo. Desmenuza el pollo y mezcla con aguacate aplastado, tomate picado, cebolla morada picada, cilantro picado, jugo de limón, sal, pimienta y chile en polvo al gusto. Calienta las tortillas de maíz y rellena con la mezcla de pollo y guacamole. Enrolla y sirve.',
            'comida_dia' => 'cena',
            'imagen' => 'wrap_pollo_guacamole.jpeg',
            'aprobado' => true,
            'calorias' => 320,
            'azucar' => 4,
            'carbohidratos' => 25,
            'grasas' => 15,
            'vitaminas' => 25,
            'proteinas' => 28,
            'fibra' => 8
        ),
        array(
            'nombre_plato' => 'Tortilla de espinacas y champiñones',
            'ingredientes' => 'Huevos, espinacas frescas, champiñones, cebolla, ajo, aceite de oliva, sal, pimienta',
            'elaboracion' => 'Saltea la cebolla y el ajo picados en un poco de aceite de oliva hasta que estén dorados. Añade los champiñones en rodajas y las espinacas frescas y cocina hasta que las espinacas se marchiten. Bate los huevos y vierte sobre la mezcla de espinacas y champiñones. Cocina a fuego lento hasta que la tortilla esté cuajada por ambos lados. Sirve caliente.',
            'comida_dia' => 'cena',
            'imagen' => 'tortilla_espinacas_champinones.jpg',
            'aprobado' => true,
            'calorias' => 280,
            'azucar' => 3,
            'carbohidratos' => 10,
            'grasas' => 14,
            'vitaminas' => 25,
            'proteinas' => 22,
            'fibra' => 8
        ),
        array(
            'nombre_plato' => 'Pescado al horno con patatas asadas',
            'ingredientes' => 'Filete de pescado blanco (merluza, lenguado, bacalao), patatas, aceite de oliva, limón, sal, pimienta, hierbas provenzales',
            'elaboracion' => 'Coloca el filete de pescado en una bandeja para hornear y sazona con sal, pimienta, jugo de limón y hierbas provenzales al gusto. Corta las patatas en rodajas finas y colócalas alrededor del pescado. Rocía las patatas con un poco de aceite de oliva. Hornea a 180°C durante 20-25 minutos o hasta que el pescado esté cocido y las patatas estén doradas.',
            'comida_dia' => 'cena',
            'imagen' => 'pescado_horno_patatas.jpg',
            'aprobado' => true,
            'calorias' => 320,
            'azucar' => 3,
            'carbohidratos' => 20,
            'grasas' => 12,
            'vitaminas' => 25,
            'proteinas' => 30,
            'fibra' => 8
        ),
        array(
            'nombre_plato' => 'Berenjenas rellenas de carne picada',
            'ingredientes' => 'Berenjenas, carne picada de ternera o pollo, cebolla, ajo, tomate triturado, queso rallado, aceite de oliva, sal, pimienta, hierbas aromáticas',
            'elaboracion' => 'Corta las berenjenas por la mitad y retira la pulpa con cuidado. Sofríe la cebolla y el ajo picados en un poco de aceite de oliva hasta que estén dorados. Agrega la carne picada y cocina hasta que esté dorada. Añade el tomate triturado, la pulpa de berenjena picada, sal, pimienta y hierbas aromáticas al gusto y cocina a fuego lento durante unos minutos. Rellena las berenjenas con la mezcla de carne, espolvorea con queso rallado y hornea a 180°C durante 25-30 minutos o hasta que estén doradas.',
            'comida_dia' => 'cena',
            'imagen' => 'berenjenas_rellenas_carne.jpg',
            'aprobado' => true,
            'calorias' => 310,
            'azucar' => 4,
            'carbohidratos' => 15,
            'grasas' => 16,
            'vitaminas' => 20,
            'proteinas' => 28,
            'fibra' => 10
        )

    );
}