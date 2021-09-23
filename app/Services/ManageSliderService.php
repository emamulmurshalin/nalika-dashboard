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
        $destination_path= 'public/images';
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

    public function showSlider()
    {
        return $this->model->paginate(10);
    }

    public function deleteSlider($id)
    {
        $slider = $this->model->findOrFail($id);
        $dataDeleted = $slider->delete();

        if ($dataDeleted){
            return [
                'status' => 200,
                'message' => 'Employee deleted successfully',
            ];
        }
    }

    public function detailsSlider($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateSliderInfo($inputData, $id, $imageFile)
    {
        $slider = $this->model->findOrFail($id);
        $imageFileName = time().'.'.$imageFile->getClientOriginalExtension();
        $destination_path= 'public/images';
        if ($imageFile){
            $inputData['slider_image'] = $imageFile->storeAs($destination_path, $imageFileName);
            $dataSaved = $slider->update($inputData);
            if ($dataSaved){
                return [
                    'status' => 200,
                    'message' => 'Slider information updated successfully',
                ];
            }
        }else{
            $dataSaved = $slider->update($inputData);
            return [
                'status' => 404,
                'message' => 'File not uploaded',
            ];
        }
    }
}
