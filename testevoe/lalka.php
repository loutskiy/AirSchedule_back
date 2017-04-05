<?php
$array = array( "name" => "Mikhail Луцкий",
               "celoe" => 432,
             "float" => 3.14,
              "object" => array(
                "title" => "<a href='airs'>AirSchedule</a>"
                "time" => 345876
              ),
              "massiv_Array" => array(
                array(
                  "name" =>"Airbus"
                  "place_count" => 105
                )
              ));
              $json = json_encode($array);
              echo $json
