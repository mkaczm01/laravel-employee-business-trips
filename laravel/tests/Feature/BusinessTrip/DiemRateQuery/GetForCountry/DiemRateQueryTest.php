<?php

declare(strict_types=1);

namespace Tests\Feature\BusinessTrip\DiemRateQuery\GetForCountry;

use Tests\TestCase;
use App\Models\DiemRate;
use BusinessTrip\DiemRateQuery;
use BusinessTrip\Entities\Enums\CountryCode;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DiemRateQueryTest extends TestCase
{
    use DatabaseTransactions;
    use DiemRateQueryTrait;

    protected DiemRateQuery $service;

    protected function setUp(): void
    {
        parent::setUp();

        DiemRate::query()->forceDelete();

        $this->service = $this->app->make(DiemRateQuery::class);
    }

    /**
     * @feature Business Trip
     * @scenario Get Diem Rate value for selected Country
     * @case Provided Country exists in database
     *
     * @expectation Return Diem Rate amount and currency for Country
     *
     * @test
     */
    public function getForCountry_providedCountryExistsInDatabase(): void
    {
        // GIVEN
        $this->createDiemRate('PL', 24, 'PLN');

        // WHEN
        $results = $this->service->getForCountry(CountryCode::PL);

        // THEN
        $this->assertEquals(24, $results->getAmount());
        $this->assertEquals('PLN', $results->getCurrency()->getIsoCode());
    }
}
