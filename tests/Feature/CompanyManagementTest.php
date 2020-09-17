<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;

class CompanyManagementTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /** @test */
    public function a_company_can_be_added_to_the_company_list(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'42602168',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertRedirect('/company');
        $this->assertCount(1,Company::all());
    }
    /** @test */
    public function a_name_is_required(){
        $response = $this->post('/company',[
            'name'=>'',
            'cui'=>'42602168',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertSessionHasErrors('name');
    }
    /** @test */
    public function a_cui_is_required(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertSessionHasErrors('cui');
    }

    /** @test */
    public function a_rc_is_required(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'42602168',
            'rc'=>'',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertSessionHasErrors('rc');
    }

    /** @test */
    public function a_email_is_required(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'42602168',
            'rc'=>'J40/6070/2020',
            'email'=>'',
            'rl'=>'Antonio Primera',
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_rl_is_required(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'42602168',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'',
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertSessionHasErrors('rl');
    }

    /** @test */
    public function a_site_is_required(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'42602168',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>''
        ]);
        $response->assertSessionHasErrors('site');
    }

    /** @test */
    public function an_email_must_be_valid(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'42602168',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_rl_should_have_a_maximum_of_50_characters(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'42602168',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>$this->nameGenerator(51),
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertSessionHasErrors('rl');
    }
    /** @test */
    public function a_rl_can_contain_alpha_whitespaces_and_hyphens_only(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'42602168',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera1',
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertSessionHasErrors('rl');
    }
    /** @test */
    public function a_cui_is_an_integer(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'12s',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>'http://agrocity.eu'
        ]);
        $response->assertSessionHasErrors('cui');
    }
    /** @test */
    public function a_cui_has_max_10_digits(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'999999999999',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>'http://agrocity.eu'

        ]);
        $response->assertSessionHasErrors('cui');
    }
    /** @test */
    public function a_cui_has_min_2_digits(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'1',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>'http://agrocity.eu'

        ]);
        $response->assertSessionHasErrors('cui');
    }
    /** @test */
    public function a_link_should_have_a_valid_form(){
        $response = $this->post('/company',[
            'name'=>'AGROCITY TECHNOLOGIES SRL',
            'cui'=>'42602168',
            'rc'=>'J40/6070/2020',
            'email'=>'agrocity@agrocity.eu',
            'rl'=>'Antonio Primera',
            'site'=>'agrocity.eu'
        ]);
        $response->assertSessionHasErrors('site');
    }

}
