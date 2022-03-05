<?php 
namespace App\Repository;

interface ISegmentRepository 
{
    public function getAllSegments();

    public function getSegmentById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteSegment($id);

    public function copySegment($id);
}