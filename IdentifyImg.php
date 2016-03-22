<?php

class PatternDigit {
    private $matches;
    private $pattern;
    
    // $numPattern это закодированное число в шаблоне
    public function __construct($numPattern, array $pattern) {
        $this->matches = 0;
        $this->pattern = $pattern[$numPattern];
    }
    
    public function compare($x, $y, $bit) {
      if(($x < count($this->pattern[0])) && ($this->pattern[$y][$x] == $bit)) {
          $this->matches++;
      }
    }
    
    public function getMatches() {
        return $this->matches;
    }
    
    public function resetMatches() {
        $this->matches = 0;
    }
}

$IdentifyImg = new IdentifyImg();
$IdentifyImg->LoadPng('http://example.com/image.php');
$IdentifyImg->printCaptcha();
echo $IdentifyImg->getCodeCaptcha();

class IdentifyImg {
    private $digit;
    private $im;
    private $strFoundNumber;
    
    public function __construct() {
        $patternDigit = array(
            array(
              array(0,0,1,1,1,1,1,1,0,0),
              array(0,1,1,0,0,0,0,1,1,0),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,1,1,0,0,0,0,1,1,0),
              array(0,0,1,1,1,1,1,1,0,0)
            ),
            array(
              array(1,1,1,1),
              array(0,1,1,1),
              array(0,1,1,1),
              array(0,1,1,1),
              array(0,1,1,1),
              array(0,1,1,1),
              array(0,1,1,1),
              array(0,1,1,1),
              array(0,1,1,1),
              array(0,1,1,1),
              array(0,1,1,1)
            ),
            array(
              array(0,0,1,1,1,1,1,1,0,0),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,0,0,0,0,0,0,1,1,1),
              array(0,0,0,0,0,0,0,1,1,1),
              array(0,0,0,0,0,0,0,1,1,0),
              array(0,0,0,0,0,1,1,1,0,0),
              array(0,0,0,0,1,1,0,0,0,0),
              array(0,0,0,0,1,0,0,0,0,0),
              array(0,0,1,1,1,0,0,0,0,0),
              array(0,0,1,1,1,0,0,0,0,0),
              array(1,1,1,1,1,1,1,1,1,1)
            ),
            array(
              array(0,0,1,1,1,1,1,1,0,0),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,0,0,0,0,0,0,1,1,1),
              array(0,0,0,0,0,0,0,1,1,1),
              array(0,0,0,0,1,1,1,1,1,0),
              array(0,0,0,0,0,0,1,1,0,0),
              array(0,0,0,0,0,0,0,1,0,0),
              array(0,0,0,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,1,1,0,0,0,0,1,1,0),
              array(0,0,1,1,1,1,1,1,0,0)
            ),
            array(
              array(0,0,0,0,1,1,1,1,0),
              array(0,0,0,0,1,1,1,1,0),
              array(0,0,1,1,1,1,1,1,0),
              array(0,0,1,0,0,1,1,1,0),
              array(1,1,1,0,0,1,1,1,0),
              array(1,1,1,0,0,1,1,1,0),
              array(1,1,1,1,1,1,1,1,1),
              array(0,0,0,0,0,1,1,1,0),
              array(0,0,0,0,0,1,1,1,0),
              array(0,0,0,0,0,1,1,1,0),
              array(0,0,0,0,0,1,1,1,0)
            ),
            array(
              array(1,1,1,1,1,1,1,1,1,1),
              array(1,1,1,0,0,0,0,0,0,0),
              array(1,1,1,0,0,0,0,0,0,0),
              array(1,1,1,0,0,0,0,0,0,0),
              array(1,1,1,0,0,0,0,0,0,0),
              array(1,1,1,1,1,1,1,1,0,0),
              array(0,0,0,0,0,0,0,1,1,0),
              array(0,0,0,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,1,1,0,0,0,0,1,1,0),
              array(0,0,1,1,1,1,1,1,0,0)
            ),
            array(
              array(0,0,1,1,1,1,1,1,0,0),
              array(0,1,1,0,0,0,0,1,1,0),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,0,0,0),
              array(1,1,1,0,0,0,0,0,0,0),
              array(1,1,1,1,1,1,1,1,0,0),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,1,1,0,0,0,0,1,1,0),
              array(0,0,1,1,1,1,1,1,0,0)
            ),
            array(
              array(1,1,1,1,1,1,1,1,1,1),
              array(0,0,0,0,0,0,0,1,1,0),
              array(0,0,0,0,0,0,0,1,1,0),
              array(0,0,0,0,0,1,1,1,0,0),
              array(0,0,0,0,0,1,1,1,0,0),
              array(0,0,0,0,0,1,1,1,0,0),
              array(0,0,0,0,0,1,0,0,0,0),
              array(0,0,0,1,1,1,0,0,0,0),
              array(0,0,0,1,1,1,0,0,0,0),
              array(0,0,0,1,1,0,0,0,0,0),
              array(0,0,1,1,1,0,0,0,0,0)
            ),
            array(
              array(0,0,1,1,1,1,1,1,0,0),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,1,1,0,0,0,0,1,1,0),
              array(0,0,1,1,1,1,1,1,0,0),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,0,1,0,0,0,0,1,0,0),
              array(0,0,1,1,1,1,1,1,0,0)
            ),
            array(
              array(0,0,1,1,1,1,1,1,0,0),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,1,1,0,0,0,0,1,1,1),
              array(0,0,1,1,1,1,1,1,1,1),
              array(0,0,0,0,0,0,0,1,1,1),
              array(0,0,0,0,0,0,0,1,1,1),
              array(1,1,1,0,0,0,0,1,1,1),
              array(0,1,1,0,0,0,0,1,1,0),
              array(0,0,1,1,1,1,1,1,0,0)
            )
        );
        $this->digit[] = new PatternDigit(0, $patternDigit);
        $this->digit[] = new PatternDigit(1, $patternDigit);
        $this->digit[] = new PatternDigit(2, $patternDigit);
        $this->digit[] = new PatternDigit(3, $patternDigit);
        $this->digit[] = new PatternDigit(4, $patternDigit);
        $this->digit[] = new PatternDigit(5, $patternDigit);
        $this->digit[] = new PatternDigit(6, $patternDigit);
        $this->digit[] = new PatternDigit(7, $patternDigit);
        $this->digit[] = new PatternDigit(8, $patternDigit);
        $this->digit[] = new PatternDigit(9, $patternDigit);
        $this->strFoundNumber = "";
    }
    
    // загружаем картинку
    public function LoadPng($url) {
      $tempIm = @imagecreatefrompng($url);
      if($tempIm) {
        $this->im = imagecreate(76, 11);
        imagecopy($this->im, $tempIm, 0, 0, 0, 4, 76, 15);
        return true;
      }
    }
    
    // возвращает исследуемую картинку
    public function printCaptcha() {
      if($this->im) {
        ob_start();
          imagepng($this->im);
          $pngString = ob_get_contents();
        ob_end_clean();
        echo '<img src="data:image/png;base64,'.base64_encode($pngString).'">';
      }
    }
    
    // возвращает код с картинки
    public function getCodeCaptcha() {
      if($this->im) {
        $strFoundNumber = '';
        $coordinatesCharAndBit = array();
        $coordinatesChar = array();
        // формирует массив начала и конца цифры Пример: (0000111110011110001110)
        for($i = 0; $i < imagesx($this->im); $i++) {
            $flag = 0;
            for($j = 0; $j < imagesy($this->im); $j++) {
                $arr = imagecolorsforindex($this->im, imagecolorat($this->im, $i, $j));
                if(($arr['red'] == 102) && ($arr['green'] == 153) && ($arr['blue'] == 0)) {
                    $flag = 1;
                }
            }
            $coordinatesCharAndBit[] = array('x' => $i, $flag);
            // определяет начало и конц символа
            if($i > 0) {
                switch($coordinatesCharAndBit[$i-1][0].$coordinatesCharAndBit[$i][0]) {
                    case '01'://начало цифры
                        $coordinatesChar[] = $coordinatesCharAndBit[$i]['x']; // записываем координату х
                    break;
                    case '10'://конец цифры
                        $coordinatesChar[] = $coordinatesCharAndBit[$i]['x'];
                    break;
                }
            }
        }
        for($i=0; $i < count($coordinatesChar); $i+=2) {
          $this->scanningCoordinates($coordinatesChar[$i], $coordinatesChar[$i+1]);
          $strFoundNumber .= $this->getDigitFromImg();
        }
        return $strFoundNumber;
      }
    }

    // читаем область по заданным координатам
    protected function scanningCoordinates($sx, $ex) {
        $matrix = array();
        for($i = 0; $i < imagesy($this->im); $i++) {
            for($k=0,$j = $sx; $j < $ex; $j++,$k++) {
                $arr = imagecolorsforindex($this->im, imagecolorat($this->im, $j, $i));
                if(($arr['red'] == 102) && ($arr['green'] == 153) && ($arr['blue'] == 0)) {
                    $this->detectionOfNum($k, $i, 1);
                } else {
                    $this->detectionOfNum($k, $i, 0);
                }
            }
        }
    }
    
    // отправляем на сравнение
    protected function detectionOfNum($x, $y, $bit) {
      for($i = 0; $i < count($this->digit); $i++) {
        $this->digit[$i]->compare($x, $y, $bit);
      }
    }
    
    // получаем результат сравнения
    protected function getDigitFromImg() {
        $matches = 0;
        $number = 0;
        for($i = 0; $i < count($this->digit); $i++) {
            if($this->digit[$i]->getMatches() > $matches) {
                $number = $i;
                $matches = $this->digit[$i]->getMatches();
            }
            $this->digit[$i]->resetMatches();
        }
        return $number;
    }
}