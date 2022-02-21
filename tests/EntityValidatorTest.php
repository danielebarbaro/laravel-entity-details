<?php

namespace Danielebarbaro\EntityDetail\Tests;

use Danielebarbaro\EntityDetail\EntityValidator;
use Danielebarbaro\EntityDetail\Exceptions\ValidateDetailException;

class EntityValidatorTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->validator = new EntityValidator();

        $this->rules = [
            'is_company' => 'required|boolean',
            'status' => 'required|max:20',
            'code' => 'required|max:10',
            'name' => 'string|max:100',
        ];

        $this->details = [
            'is_company' => true,
            'status' => 1,
            'code' => 'CODE',
            'name' => 'DUMMY COMPANY',
        ];

        $this->fail_rules = [
            'is_company' => 'required|boolean',
            'status' => 'required|string|max:20',
            'code' => 'required|max:10',
            'name' => 'string|max:100',
        ];
    }

    /** @test */
    public function it_can_validate_detail_dataset()
    {
        $result = $this->validator->validate($this->details, $this->rules);
        $this->assertSame($result, $this->details);
    }

    /**
     * @test
     * @expectException ValidateDetailException
     */
    public function it_can_catch_an_exception_on_validate_detail_dataset()
    {
        $this->expectException(ValidateDetailException::class);
        $this->validator->validate($this->details, $this->fail_rules);
    }
}
