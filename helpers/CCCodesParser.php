<?php
    /* *
	 * CCCodesParser
	 */

class CCCodesParser
{
    private $db;

    private $response;

    private $countries;

    private $cities;

    public function __construct()
    {
        global $db;
        $this->db = &$db;
    }

    public function startParsing()
    {
        $sql = "SELECT `id`, `city`, `cityCode`, `countryCode`, `countryName` FROM `airports`";
        $response = $this->db->getAll($sql);
        $this->response = $response;
        $this->countries = Countries::getAllCountries();
        $this->cities = Cities::getAllCities();
        $this->countriesIdParsing();
    }

    private function countriesIdParsing()
    {
	    $i = 0;
        foreach ($this->response as $airport) {
	        $countryId = $this->getCountryId($airport['countryCode'], $airport['countryName']);
	        print_r("CountryId: " . $countryId . " AirportId: " . $airport['id'] . "\n");
	        Airports::addCountryId ($countryId, $airport['id']);
	        $cityId = $this->getCityId($airport['cityCode'], $airport['city']);
	        Airports::addCityId ($cityId, $airport['id']);
			$i++;
        }
        print_r($i);
    }

    private function getCountryId($countryCode, $countryName)
    {
        foreach ($this->countries as $country) {
            if (($country['code'] == $countryCode && !empty($country['code'])) || $country['name'] == $countryName) {
                return $country['id'];
            }
        }
        return 0;
    }

    private function getCityId($cityCode, $cityName)
    {
        foreach ($this->cities as $city) {
            if (($city['code'] == $cityCode && $city['code']) || $city['name'] == $cityName) {
                return $city['id'];
            }
        }
        return 0;
    }
}
