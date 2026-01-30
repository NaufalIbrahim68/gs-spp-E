<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_view_another_users_order_detail()
    {
        // Create two users with customers
        $user1 = User::factory()->create(['role' => 'customer']);
        $customer1 = Customer::create(['user_id' => $user1->id, 'name' => 'User 1', 'phone_number' => '0811', 'address' => 'Addr 1', 'status' => true]);
        
        $user2 = User::factory()->create(['role' => 'customer']);
        $customer2 = Customer::create(['user_id' => $user2->id, 'name' => 'User 2', 'phone_number' => '0812', 'address' => 'Addr 2', 'status' => true]);

        // Create an order for user 1
        $order = Order::create([
            'invoice' => 'INV-001',
            'customer_id' => $customer1->id,
            'customer_name' => $customer1->name,
            'customer_phone' => $customer1->phone_number,
            'customer_address' => $customer1->address,
            'subtotal' => 1000
        ]);

        // Act: User 2 tries to view User 1's order
        $response = $this->actingAs($user2)->get(route('customer.detailOrder', $order->invoice));

        // Assert: Redirected to dashboard with error
        $response->assertRedirect(route('customer.dashboard'));
        $response->assertSessionHas('error', 'Anda tidak memiliki akses ke pesanan ini.');
    }

    public function test_guest_cannot_view_order_detail()
    {
        $user = User::factory()->create(['role' => 'customer']);
        $customer = Customer::create(['user_id' => $user->id, 'name' => 'User 1', 'phone_number' => '0811', 'address' => 'Addr 1', 'status' => true]);
        
        $order = Order::create([
            'invoice' => 'INV-002',
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone_number,
            'customer_address' => $customer->address,
            'subtotal' => 1000
        ]);

        // Act: Guest tries to view order
        $response = $this->get(route('customer.detailOrder', $order->invoice));

        // Assert: Redirected to login (standard Laravel auth behavior)
        $response->assertRedirect('/login');
    }
}
