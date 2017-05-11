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

    public function CCCodesParser()
    {
        global $db;
        $this->db = &$db;
    }

    public function startParsing()
    {
        $sql = "SELECT `id`, `city`, `cityCode`, `countryCode`, `countryName` FROM `airports` WHERE `city_id` = 0 OR `country_id` = 0";
        $response = $this->db->getAll($sql);
        $this->response = $response;
        $this->countries = Countries::getAllCountries();
        $this->cities = Cities::getAllCities();
        $this->countriesIdParsing();
    }

    private function countriesIdParsing()
    {
        foreach ($this->response as $airport) {
	        $countryId = $this->getCountryId($airport['countryCode'], $airport['countryName']);
	        Airports::addCountryId ($countryId, $airport['id']);
	        $cityId = $this->getCityId($airport['cityCode'], $airport['city']);
	        Airports::addCityId ($cityId, $airport['id']);
        }
    }

    private function getCountryId($countryCode, $countryName)
    {
        foreach ($this->countries as $country) {
            if ($country['code'] == $countryCode || $country['name'] == $countryName) {
                return $country['id'];
            }
        }
        return 0;
    }

    private function getCityId($cityCode, $cityName)
    {
        foreach ($this->cities as $city) {
            if ($city['code'] == $cityCode || $city['name'] == $cityName) {
                return $city['id'];
            }
        }
        return 0;
    }
}
