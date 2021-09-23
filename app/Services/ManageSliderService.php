<?php


namespace App\Services;


use App\Models\Admin\ManageSlider;

class ManageSliderService
{
    public function __construct(ManageSlider $manageSlider)
    {
        $this->model = $manageSlider;
    }
}
