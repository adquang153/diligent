<?php

namespace App\Services;

use App\Models\SalaryAdvance;

class SalaryService{

    public function advance(){
        return SalaryAdvance::all();
    }

}

?>