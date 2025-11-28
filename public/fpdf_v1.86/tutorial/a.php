     /////////////////////////////////////////////////////////////////////////////////////// CHECK HOLIDAY.TXT
    public function checkHoliday($requestDuration){

        $path = public_path('holiday.txt'); 
        $convertDate = date('Y-M-d',strtotime($requestDuration));

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            list($getDate , $getDay , $getHoliday) = explode("\t" , $line);
            $getDate = date('Y-M-d' , strtotime($getDate));

            if($convertDate == $getDate){
                $requestDuration = $requestDuration->addDays(1);
                $convertDate = date('Y-M-d',strtotime($requestDuration));
            }
        }

        // GET NAME OF THE DAY
        $getNameOfDay = $requestDuration->format('l');

        if($getNameOfDay == 'Saturday'){
            $requestDuration = $requestDuration->addDays(2);
        }
        if($getNameOfDay == 'Sunday'){
             $requestDuration = $requestDuration->addDays(1);
        }

        return $requestDuration;
    }