<?php 
namespace App\Repository;

interface IOrganizationRepository 
{
    public function getAllOrganizations();

    public function getOrganizationById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteOrganization($id);
}