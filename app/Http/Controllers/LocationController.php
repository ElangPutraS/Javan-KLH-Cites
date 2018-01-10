<?php

namespace App\Http\Controllers;

use App\City;
use App\CompanyQuota;
use App\DocumentType;
use App\Province;
use App\Species;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvince($country){
        $province=Province::where('country_id',$country)->orderBy('province_name', 'asc')->get();
        return json_encode($province);
    }

    public function getCity($province){
        $city=City::where('province_id', $province)->orderBy('city_name_full', 'asc')->get();
        return json_encode($city);
    }

    public function getSpecies($appendix_type, $category_id, $source_id){
        $is_appendix='';
        if($appendix_type=='EA'){
            $is_appendix='1';
        }elseif($appendix_type=='EB'){
            $is_appendix='0';
        }

        $species=Species::where([['is_appendix',$is_appendix],['species_category_id', $category_id], ['source_id', $source_id]])->orderBy('species_scientific_name','asc')
            ->with('appendixSource')
            ->with('unit')
            ->with('speciesQuota')  
            ->with('companyQuota')
            ->get();

        return json_encode($species);
    }

    public function getDocument($id){
        $data=[];
        if($id == '1'){
            $data=[5];
        }else if($id == '2'){
            $data=[4,5];
        }else if($id == '3'){
            $data=[];
        }else if($id == '4'){
            $data=[4,3];
        }
        $document_type=DocumentType::whereIn('is_permit', $data)->get();

        return json_encode($document_type);
    }

    public function getSpeciesComodity($comodity)
    {
        $species = Species::where('species_category_id', $comodity)->orderBy('species_scientific_name','asc')
                    ->with('unit')->get();

        return json_encode($species);
    }

    public function getKuotaNasional($species_id, $year){
        $spec = Species::findOrFail($species_id)->speciesQuota->where('year', $year)->first();

        if($spec){
            $total = CompanyQuota::where([['species_id',$species_id], ['year', $year]])->sum('quota_amount');
            $quota_now = $spec->quota_amount - $total;

            return $quota_now;
        }else{
            return json_encode(0);
        }
    }

    public function markReadNotif($id){
        auth()->user()->unreadNotifications()->find($id)->markAsRead();
    }

    public function markReadNotifAll(){
        auth()->user()->unreadNotifications->markAsRead();
        //echo 'cek';
    }
}
