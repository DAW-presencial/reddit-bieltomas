<?php

namespace Database\Seeders;

use App\Models\Comunidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comentario;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $andreu = User::factory()->create([
            'name' => 'Andreu',
            'email' => 'Andreu@gmail.com',
        ]);

        $biel = User::factory()->create([
            'name' => 'Biel',
            'email' => 'biel@gmail.com',
        ]);

        for($i = 1; $i < 10; $i++){
            if($i % 2 == 0){
                $user = $andreu;
            }else{
                $user = $biel;
            }
        }

        $comunidad = Comunidad::factory()->create([
            'nombre' => 'Comunidad de prueba'. $i,
            'descripcion' => 'Esta es la comunidad de prueba' . $i,
        ]);

        $post = Post::factory(rand(1,6))->create([
            'titulo' => 'Post de prueba' . $i,
            'contenido' => 'Este es el contenido del post de prueba' . $i,
            'user_id' => $user->id,
            'comunidad_id' => $comunidad->id
        ]);

        foreach($post as $p){
            $comentario = Comentario::factory(rand(1,3))->create([
                'mensaje' => 'Este es el mensaje del comentario de prueba' . $i,
                'user_id' => $user->id,
                'post_id' => $p->id
            ]);
        }

        $user->comunidades()->attach($comunidad);
    }
}
