<?php
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\DRH;
use App\Entity\Astreignable;

class DRHTest extends TestCase
{
    public function testNomGetterSetter(): void
    {
        $drh = new DRH();
        $drh->setNom('Dupont');
        $this->assertSame('Dupont', $drh->getNom());
    }
    // ... other tests
}
