<?php

namespace App\Http\Requests;


use App\Repositories\ZipCodeRepository;
use Illuminate\Http\Exception\HttpResponseException;

trait HandlesAddressRequest
{

    public function addGeoDataViaZip()
    {
        if (!$this->has('zip')) {
            return false;
        }

        $geo = $this->zips()->findGeoData(intval($this->get('zip')));

        if (!$geo) {
            return $this->zipCodeNotFound();
        }

        $this->offsetSet('latitude', $geo->latitude);
        $this->offsetSet('longitude', $geo->longitude);

        return true;
    }

    private function zips() : ZipCodeRepository
    {
        return app()->make(ZipCodeRepository::class);
    }

    private function zipCodeNotFound()
    {
        throw new HttpResponseException($this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withError('Zipcode not found.'));
    }
}