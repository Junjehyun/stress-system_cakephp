<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaisyoSoshikiTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaisyoSoshikiTable Test Case
 */
class TaisyoSoshikiTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TaisyoSoshikiTable
     */
    protected $TaisyoSoshiki;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TaisyoSoshiki',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TaisyoSoshiki') ? [] : ['className' => TaisyoSoshikiTable::class];
        $this->TaisyoSoshiki = $this->getTableLocator()->get('TaisyoSoshiki', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TaisyoSoshiki);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TaisyoSoshikiTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
