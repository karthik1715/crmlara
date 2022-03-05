<?php 
namespace App\Traits;
  
use Illuminate\Http\Request;
  
trait ImageTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndUpload( $request, $fieldName, $directoryName ) {

        if ($request[$fieldName]) {

                $imagePath = $request[$fieldName];
                $allowedfileExtension=['jpg','png'];
                $extension = $imagePath->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if( $check ) {
                    /*  $namewithextension = $imagePath->getClientOriginalName();
                        $imageName = explode('.', $namewithextension)[0]; */

                    $imageFullName = time().rand(100,9999).'.'.$extension;
                    $path = $request[$fieldName]->storeAs($directoryName, $imageFullName);
                    return $imageFullName;
                }
                else {
                    return 'error';
                    // return redirect()->back()->withInput();
                }
          }
  
    }
  
}