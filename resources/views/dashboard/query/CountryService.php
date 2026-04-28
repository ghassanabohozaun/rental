<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CountryRepository;

class CountryService
{
    protected $countryRepository;
    //__construct
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    // get country
    public function getCountry($id)
    {
        $country = $this->countryRepository->getCountry($id);
        if (!$country) {
            return false;
        }
        return $country;
    }

    // get countries
    public function getCountries($filters = [])
    {
        return $this->countryRepository->getCountries($filters);
    }

    // get active countries
    public function getActiveCountries()
    {
        return $this->countryRepository->getActiveCountries();
    }

    // get all countries without relations
    public function getAllCountriesWithoutRelations()
    {
        return $this->countryRepository->getAllCountriesWithoutRelations();
    }

    // get all cities by country
    public function getAllCitiesByCountry($id)
    {
        $country = self::getCountry($id);
        return $this->countryRepository->getAllCitiesByCountry($country);
    }

    // store country
    public function storeCountry($data)
    {
        $country = $this->countryRepository->storeCountry($data);
        if (!$country) {
            return false;
        }
        return $country;
    }
    // update country
    public function updateCountry($data, $id)
    {
        $country = self::getCountry($id);
        if (!$country) {
            return false;
        }

        $country = $this->countryRepository->updateCountry($data, $country);
        if (!$country) {
            return false;
        }
        return $country;
    }

    // destroy country
    public function destroyCountry($id)
    {
        $country = $this->getCountry($id);

        if (!$country) {
            return 'not_found';
        }

        if (
            $country->cities()->exists() ||
            $country->fromFlightTicket()->exists() ||
            $country->toFlightTicket()->exists() ||
            $country->tours()->exists() ||
            $country->flights()->exists() ||
            $country->departureReservations()->exists() ||
            $country->fromReservations()->exists() ||
            $country->toReservations()->exists()
        ) {
            return 'restricted';
        }

        $result = $this->countryRepository->destroyCountry($country);
        return $result ? 'success' : 'failed';
    }


    // change status admin
    public function changeStatusCountry($id, $status)
    {
        $country = $this->countryRepository->getCountry($id);
        if (!$country) {
            return false;
        }

        $country = $this->countryRepository->changeStatusCountry($country, $status);
        if (!$country) {
            return false;
        }
        return $country;
    }

    // autocomplete
    public function autocompleteCountry($searchValue)
    {
        return $this->countryRepository->autocompleteCountry($searchValue);
    }
}
