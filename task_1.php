<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    $numCard = $_POST['cardNumber'];
    $string =  $_POST['cardNumber']/*"4417 1234 5678 9113"*/;
    // Удаляем все пробелы из строки
    $stringWithoutSpaces = str_replace(' ', '', $string);
    $sum =0;
    $paySys="";
    // Подсчитываем количество символов в строке без пробелов
    $length = mb_strlen($stringWithoutSpaces);
    if($length>=14)
    {
        if($length%2 != 0)
        {
            $i=1;
            $j=0;
        }
        else
        {
            $i=0;
            $j=1;
        }

        for (;$i < $length; $i+=2,$j+=2)
        {
            $charForMult = mb_substr($stringWithoutSpaces, $i, 1);
            if($i==0){
                switch ($charForMult){
                    case '2':
                        $paySys = "Mir";
                        break;
                    case '4':
                        $paySys = "Visa";
                        break;
                    case '5':
                        $paySys = "Master";
                        break;
                    case '3':
                    case '6':
                        $paySys = "Maestro";
                        break;
                    default:
                        switch (mb_substr($stringWithoutSpaces, 0, 2) && $length==14){
                            case '14':
                            case '81':
                            case '99':
                                $paySys = "Даронь кредит";
                                break;
                            default:
                                $paySys = "Неизвестна!";
                        }
                        break;
                }
            }
            $char = mb_substr($stringWithoutSpaces, $j, 1);
            $x2char = ((int)$charForMult*2);
            echo"Значение: $charForMult умножено на 2 <br>";
           if ($x2char>=10)
           {
               $charTwoDigit = sprintf($x2char);
               $charFirstNum = mb_substr($charTwoDigit, 0, 1);
               $charTwoNum = mb_substr($charTwoDigit, 1, 1);
               $sum += (int)$charFirstNum + (int)$charTwoNum + (int)$char;

           }
           else
           {
               $sum += (int)$x2char + (int)$char;
           }
        }
    
       if($sum%10==0){
           echo"Ваша платежная система: $paySys <br> \n Номер карточки верный!";
       }
       else
       {
           echo "Ваша платежная система: $paySys <br> Указанный номер карты не существует!";
       }
    }
    else
    {
        echo "<script>alert('Не верный номер карты');</script>";
    
    }




