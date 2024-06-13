<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class JadwalsholatController extends Controller
{
    public function showForm()
    {
        $cities = $this->getCities();
        $defaultCityId = 1638; // ID kota Surabaya
        $jadwalDefault = $this->getJadwalSholatByCityId($defaultCityId);
        // dd($jadwalDefault);

        return view('sholat-form', [
            'cities' => $cities,
            'jadwalDefault' => $jadwalDefault,
            'defaultCityId' => $defaultCityId,
        ]);
    }

   // Method untuk menangani hasil pencarian
    public function getJadwalSholat(Request $request)
    {
        $cityId = $request->input('city_id');
        $year = Carbon::now()->year;
        $month = Carbon::now()->format('m');

        if (!$cityId) {
            return view('jadwal-sholat', ['data' => null, 'error' => 'Kota tidak ditemukan']);
        }

        $data = $this->getJadwalSholatByCityId($cityId);
        // dd($data);
        if (isset($data['data']) && isset($data['data']['jadwal'])) {
            return view('jadwal-sholat', ['data' => $data['data'], 'error' => null]);
        } else {
            return view('jadwal-sholat', ['data' => null, 'error' => 'Data tidak ditemukan']);
        }
    }

   // Method untuk mendapatkan jadwal sholat berdasarkan cityId
    private function getJadwalSholatByCityId($cityId)
    {
        $client = new Client();
        $year = Carbon::now()->year;
        $month = Carbon::now()->format('m');
        $url = "https://api.myquran.com/v2/sholat/jadwal/$cityId/$year/$month";

        try {
            $response = $client->request('GET', $url);
            return json_decode($response->getBody()->getContents(), true);
            // $data = json_decode($response->getBody()->getContents(), true);
            // dd($data);
            // return $data;
        } catch (\Exception $e) {
            return ['data' => null, 'error' => $e->getMessage()];
        }
    }

   // Method untuk mendapatkan daftar kota dari API
    private function getCities()
    {
        $client = new Client();
        $url = "https://api.myquran.com/v2/sholat/kota/semua";

        try {
            $response = $client->request('GET', $url);
            $cities = json_decode($response->getBody()->getContents(), true);
            // dd($cities);
            return $cities['data'];
        } catch (\Exception $e) {
            return [];
        }
    }

   // Method untuk mendapatkan ID kota berdasarkan nama kota
    private function getCityId($cityName)
    {
        $cities = $this->getCities();

        foreach ($cities as $city) {
            if (strcasecmp($city['lokasi'], $cityName) == 0) {
                return $city['id'];
            }
        }

        return null;
    }
}
