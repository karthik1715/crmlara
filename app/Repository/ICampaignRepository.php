<?php 
namespace App\Repository;

interface ICampaignRepository 
{
    public function getAllCampaigns();

    public function getCampaignById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteCampaign($id);
    
    public function statisticsCampaign($id);

    public function copyCampaign($id);

}