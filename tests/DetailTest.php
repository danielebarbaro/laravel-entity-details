<?php

namespace Danielebarbaro\EntityDetail\Tests;

use Danielebarbaro\EntityDetail\Models\Detail;
use Danielebarbaro\EntityDetail\Tests\helper\TestModel;
use Illuminate\Database\QueryException;

class DetailTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->assertCount(0, Detail::all());
    }

    /** @test */
    public function it_can_create_a_detail()
    {
        $detail = new Detail();

        $dataset = Detail::factory()->make()->toArray();
        $dataset['last_name'] = 'Doe';

        $detail->fill($dataset)->save();

        $this->assertCount(1, Detail::all());
        $this->assertSame('Doe', $detail->last_name);
        $this->assertSame('IT10101010011', $detail->vat);
        $this->assertSame('12345', $detail->postal_code);
        $this->assertSame('IT', $detail->country);
    }

    /** @test */
    public function it_can_create_a_test_model()
    {
        $test_model = new TestModel();

        $test_model->fill([
            'property' => 'dummy',
        ])->save();


        $this->assertCount(1, TestModel::all());
        $this->assertSame('dummy', $test_model->property);
    }

    /** @test */
    public function it_can_not_create_a_detail_without_is_company_set()
    {
        $detail = new Detail();

        $dataset = Detail::factory()->make()->toArray();
        $dataset['is_company'] = null;
        $this->expectException(QueryException::class);

        $detail->fill($dataset)->save();

        $this->assertCount(0, Detail::all());
    }

    /** @test */
    public function it_can_not_create_a_detail()
    {
        $detail = new Detail();

        $this->expectException(QueryException::class);
        $detail->fill([])->save();

        $this->assertCount(0, Detail::all());
    }

    /** @test */
    public function it_can_create_a_valid_detail_relation()
    {
        $detail = new Detail();

        $detail_dataset = Detail::factory()->make()->toArray();
        $detail->fill($detail_dataset)->save();


        $this->assertCount(1, Detail::all());
        $this->assertSame('IT10101010011', $detail->vat);

        $test_model = new TestModel();
        $test_model->fill([
            'property' => 'dummy',
        ])->save();

        $test_model->detail()->save($detail);
        $test_model->fresh();

        $this->assertCount(1, TestModel::all());
        $this->assertSame('dummy', $test_model->property);
        $this->assertSame('IT10101010011', $test_model->detail->vat);
    }

    /** @test */
    public function it_can_not_create_a_valid_detail_relation()
    {
        $detail = new Detail();

        $detail_dataset = Detail::factory()->make()->toArray();
        $detail->fill($detail_dataset)->save();

        $this->assertCount(1, Detail::all());
        $this->assertSame('IT10101010011', $detail->vat);

        $test_model = new TestModel();
        $test_model->fill([
            'property' => 'dummy',
        ])->save();

        $this->assertCount(1, TestModel::all());
        $this->assertNull($test_model->detail);
        $this->assertSame('dummy', $test_model->property);
    }

    /** @test */
    public function it_can_read_a_valid_owner_relation()
    {
        $detail = new Detail();

        $detail_dataset = Detail::factory()->make()->toArray();
        $detail->fill($detail_dataset)->save();

        $detail->fresh();

        $this->assertCount(1, Detail::all());
        $this->assertSame('IT10101010011', $detail->vat);

        $test_model = new TestModel();
        $test_model->fill([
            'property' => 'dummy',
        ])->save();

        $test_model->detail()->save($detail);
        $test_model->fresh();

        $this->assertCount(1, TestModel::all());
        $this->assertSame('dummy', $test_model->property);
        $this->assertSame('IT10101010011', $test_model->detail->vat);

        $this->assertSame(1, $detail->owner->id);
        $this->assertSame('dummy', $detail->owner->property);
    }

    /** @test */
    public function it_can_use_is_company_scope()
    {
        $detail = new Detail();

        $detail_dataset = Detail::factory()->make()->toArray();
        $detail_dataset['is_company'] = true;
        $detail->fill($detail_dataset)->save();

        $detail->fresh();

        $this->assertCount(1, Detail::all());
        $this->assertCount(1, Detail::isCompany()->get());
    }

    /** @test */
    public function it_can_use_for_owner_scope()
    {
        $detail = new Detail();

        $detail_dataset = Detail::factory()->make()->toArray();
        $detail->fill($detail_dataset)->save();

        $detail->fresh();

        $test_model = new TestModel();
        $test_model->fill([
            'property' => 'dummy',
        ])->save();

        $test_model->detail()->save($detail);
        $test_model->fresh();

        $this->assertCount(1, TestModel::all());

        $for_owner_data = Detail::forOwner($test_model)->get();
        $this->assertCount(1, $for_owner_data);
        $this->assertCount(1, Detail::all());
        $this->assertSame('IT10101010011', $for_owner_data->first()->vat);
    }
}
