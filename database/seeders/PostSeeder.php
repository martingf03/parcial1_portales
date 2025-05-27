<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("posts")->insert([
            [
                "title" => "¿Formatear la PC la mejora? Cuándo conviene hacerlo",
                "summary" => "Si tu computadora está lenta, se tilda o tarda mucho en arrancar, puede que un formateo sea la solución. Pero también hay que evaluar otros factores antes de hacerlo. Te contamos cuándo conviene y qué tener en cuenta.",
                "content" => "Formatear una PC puede ser una excelente manera de mejorar su rendimiento, pero no siempre es la única ni la primera solución. Con el paso del tiempo, la acumulación de programas innecesarios, archivos temporales y posibles virus o malware pueden hacer que el sistema operativo funcione lento. En esos casos, el formateo puede devolverle agilidad a la computadora, dejándola como nueva.
                Sin embargo, formatear implica borrar todo lo que hay en el disco, por lo que siempre debe hacerse con una copia de seguridad previa. No es recomendable hacerlo por cualquier motivo, ya que muchas veces con una limpieza del sistema, desinstalación de software innecesario o escaneo antivirus es suficiente para mejorar el rendimiento sin perder información.
                Conviene formatear cuando el sistema está muy dañado, hay fallos constantes, la PC está infectada con virus difíciles de eliminar, o cuando queremos hacer una instalación limpia de Windows. En nuestro servicio incluimos, además, respaldo de archivos y reinstalación de drivers para que el equipo quede listo para usar.",
                "publish_date" => "2025-02-03",
                "featured" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "¿Windows 10 o Windows 11? ¿Cuál conviene instalar hoy?",
                "summary" => "Muchos clientes nos preguntan qué versión de Windows es mejor. La respuesta depende del uso que le das a tu PC y de su hardware.",
                "content" => "La duda entre instalar Windows 10 o Windows 11 es cada vez más común. Ambos sistemas son estables, pero cada uno tiene ventajas dependiendo del hardware y las necesidades del usuario. Windows 11 presenta un diseño más moderno, mejoras de rendimiento en equipos compatibles y nuevas funciones como escritorios virtuales optimizados y mayor integración con herramientas como Teams.
                Por otro lado, Windows 10 sigue siendo una excelente opción, especialmente en PCs con hardware más modesto o cuando se necesita garantizar compatibilidad con ciertos programas o periféricos. Además, seguirá recibiendo soporte oficial hasta octubre de 2025, lo que lo mantiene vigente para muchos usuarios.
                Nuestra recomendación es evaluar cada caso: si tu equipo es relativamente nuevo (procesadores de 8° generación o superior), Windows 11 puede darte una experiencia más fluida y moderna. Si el hardware es más antiguo, Windows 10 sigue siendo una apuesta segura. En ambos casos, nosotros nos encargamos de la instalación y configuración personalizada.",
                "publish_date" => "2025-04-18",
                "featured" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Mantenimiento preventivo: el secreto para que tu PC no falle",
                "summary" => "Limpiar el polvo, chequear el disco rígido, y actualizar Windows son tareas simples que pueden evitar grandes problemas en el futuro.",
                "content" => "Así como un auto necesita mantenimiento regular, tu computadora también requiere cuidados para seguir funcionando correctamente. El mantenimiento preventivo incluye tareas como limpieza física del equipo (especialmente de ventiladores y disipadores), revisión de componentes, actualización de software y escaneos de seguridad.
                Muchas fallas comunes —como sobrecalentamiento, lentitud o errores inesperados— se pueden evitar con un buen mantenimiento. La acumulación de polvo, por ejemplo, puede hacer que la PC se apague sola por temperatura, mientras que los discos duros pueden avisar con tiempo cuando están por fallar, si se monitorean correctamente.
                En nuestro servicio ofrecemos mantenimientos preventivos programados, tanto para usuarios particulares como para oficinas. Incluye diagnóstico completo del equipo, limpieza interna, pruebas de hardware y asesoramiento personalizado. Prevenir una falla siempre es más barato (y menos estresante) que repararla a último momento.",
                "publish_date" => "2025-05-26",
                "featured" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],

        ]);
    }
}
