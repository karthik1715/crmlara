<?php 
namespace App\Repository;

interface IContactRepository 
{
    public function getAllContacts();

    public function getContactById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteContact($id);

    public function checkEmail($collection = []);

}