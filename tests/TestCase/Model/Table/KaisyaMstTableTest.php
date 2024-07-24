<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KaisyaMstTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KaisyaMstTable Test Case
 */
class KaisyaMstTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\KaisyaMstTable
     */
    protected $KaisyaMst;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.KaisyaMst',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('KaisyaMst') ? [] : ['className' => KaisyaMstTable::class];
        $this->KaisyaMst = $this->getTableLocator()->get('KaisyaMst', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->KaisyaMst);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\KaisyaMstTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
