<?php


namespace App\Services;


use App\Models\Admin\ManageSlider;

class ManageSliderService
{
    public function __construct(ManageSlider $manageSlider)
    {
        $this->model = $manageSlider;
    }

    public function saveSliderInfo($inputData, $imageFile)
    {
        $imageFileName = time().'.'.$imageFile->getClientOriginalExtension();
        $destination_path= '/images/slider-img';
        if ($imageFile){
            $inputData['slider_image'] = $imageFile->storeAs($destination_path, $imageFileName);
            $dataSaved = $this->model->create($inputData);
            if ($dataSaved){
                return [
                    'status' => 200,
                    'message' => 'Slider information created successfully',
                ];
            }
        }else{
            $dataSaved = $this->model->create($inputData);
            return [
                'status' => 404,
                'message' => 'File not uploaded',
            ];
        }
    }
}
