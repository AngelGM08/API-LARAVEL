<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Producto;
use PHPUnit\Framework\Attributes\Test;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function puede_crear_producto()
    {
        $response = $this->postJson('/producto/nuevo', [
            'id' => 0,
            'nombre_prod' => 'Masa de maíz',
            'descripcion' => 'Masa para tamales',
            'precio_unitario' => 23.5
        ]);

        $response->assertStatus(200)
                 ->assertJson(['status' => 'ok']);

        $this->assertDatabaseHas('producto', [
            'nombre_prod' => 'Masa de maíz'
        ]);
    }

    #[Test]
    public function puede_actualizar_producto()
    {
        $producto = Producto::create([
            'nombre_prod' => 'Harina',
            'descripcion' => 'Harina vieja',
            'precio_unitario' => 20
        ]);

        $response = $this->postJson('/producto/nuevo', [
            'id' => $producto->id_producto,
            'nombre_prod' => 'Harina actualizada',
            'descripcion' => 'Harina para tamales',
            'precio_unitario' => 22
        ]);

        $response->assertStatus(200)
                 ->assertJson(['status' => 'ok']);

        $this->assertDatabaseHas('producto', [
            'id_producto' => $producto->id_producto,
            'nombre_prod' => 'Harina actualizada'
        ]);
    }

    #[Test]
    public function puede_listar_productos()
    {
        Producto::create([
            'nombre_prod' => 'Hoja de maíz',
            'descripcion' => 'Para envolver tamales',
            'precio_unitario' => 10
        ]);

        $response = $this->postJson('/productos');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                    '*' => ['id_producto', 'nombre_prod', 'descripcion', 'precio_unitario']
                 ]);
    }

    #[Test]
    public function puede_mostrar_producto_por_id()
    {
        $producto = Producto::create([
            'nombre_prod' => 'Tamal verde',
            'descripcion' => 'Rico tamal de salsa verde',
            'precio_unitario' => 18
        ]);

        $response = $this->getJson("/producto/{$producto->id_producto}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['nombre_prod' => 'Tamal verde']);
    }

    #[Test]
    public function puede_eliminar_producto()
    {
        $producto = Producto::create([
            'nombre_prod' => 'Eliminarme',
            'descripcion' => 'Producto temporal',
            'precio_unitario' => 10
        ]);

        $response = $this->postJson('/producto/eliminar', [
            'id' => $producto->id_producto
        ]);

        $response->assertStatus(200)
                 ->assertJson(['status' => 'ok']);

        $this->assertDatabaseMissing('producto', ['id_producto' => $producto->id_producto]);
    }

    #[Test]
    public function muestra_error_si_producto_no_existe_al_eliminar()
    {
        $response = $this->postJson('/producto/eliminar', [
            'id' => 999 // ID inexistente
        ]);

        $response->assertStatus(404)
                 ->assertJson(['status' => 'not found']);
    }
}
