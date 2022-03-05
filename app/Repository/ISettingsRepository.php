<?php 
namespace App\Repository;

interface ISettingsRepository 
{
    public function getAllCategories();

    public function getCategoryById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteCategory($id);

}