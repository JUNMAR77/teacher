<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Member;
use Tests\TestCase;

class MemberRegistrationTest extends TestCase
{
    use RefreshDatabase;
    /** 
     * @test 
     * */
    public function a_member_can_be_registered_to_the_group()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/members', [
            'first_name'=> 'Junmar II',
            'last_name' => 'Sales',
            'middle_name' => 'Auxtero',
        ]);

       $response->assertOK();
       $this->assertCount(1, Member::all());
    }

    /** 
     * @test 
     * */
    public function a_member_last_name_is_required()
    {
        $response = $this->post('/members', [
            'first_name'=> 'Junmar II',
            'last_name' => '',
            'middle_name' => 'Auxtero',
        ]);

       $response->assertSessionHasErrors('last_name');
    }
    /** 
     * @test 
     * */
    public function a_member_first_name_is_required()
    {
        $response = $this->post('/members', [
            'first_name'=> '',
            'last_name' => 'Sales',
            'middle_name' => 'Auxtero',
        ]);

       $response->assertSessionHasErrors('first_name');
    }
     /** 
     * @test 
     * */
    public function a_member_middle_name_is_required()
    {
        $response = $this->post('/members', [
            'first_name'=> 'Junmar II',
            'last_name' => 'Sales',
            'middle_name' => '',
        ]);

       $response->assertSessionHasErrors('middle_name');
    }
    /** 
     * @test 
     * */
    public function a_member_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/members', [
            'first_name'=> 'Junmar II',
            'last_name' => 'Sales',
            'middle_name' => 'Auxtero',
        ]);

        $member = Member::first();

        $response = $this->patch('/members/' . $member->id, [
            'first_name'=> 'Jason',
            'last_name' => 'Tobes',
            'middle_name' => 'Pogi',
        ]);
        $this->assertEquals('Jason',Member::first()->first_name);
        $this->assertEquals('Tobes',Member::first()->last_name);
    }    
}
