<?php
class AnalysisText
{
    const REGEX = "/(?<=[.?!] )|(?<=[.?!] )/";
    // первая версия текста
    protected $text1;
    // вторая версия текста
    protected $text2;
    // максимальное количество предложений
    protected $maxCount;
    // результирующий текст
    protected $result;

    public function __construct(string $text1, string $text2) {
        $this->text1 = preg_split(self::REGEX, $text1);
        $this->text2 = preg_split(self::REGEX, $text2);
        $this->maxCount = (count($this->text1) > count($this->text2)) ? count($this->text1) : count($this->text2);
    }

    /**
     * анализ текста
     * 
     * @return array
     */
    public function analysis()
    {
        for ($i=0; $i < $this->maxCount; $i++) { 
            // добавлено новое предложение
            if (!isset($this->text1[$i]) || empty($this->text1[$i])) {
                $this->result[$i] = $this->formation($this->text2[$i], 'lime');
                break;
            }
            // удалено предложение
            if (!isset($this->text2[$i]) || empty($this->text2[$i])) {
                $this->result[$i] = $this->formation($this->text1[$i], 'darkred');
                break;
            }
            // предложение изменено
            if (strcmp($this->text1[$i], $this->text2[$i])) {
                $this->result[$i] = $this->formation($this->text2[$i], 'yellow', $this->text1[$i]);
            } else {
                $this->result[$i] = $this->text1[$i];
            }
        }
        return $this->convert();
    }

    /**
     * форматирование предложения
     * 
     * @param string $sentences Предложение
     * @param string $color Цвет
     * @param string $title Первая версия предложения
     * @return string
     */
    private function formation($sentences, $color, $title = '')
    {
        return  '<span style="color:'.$color.'" title="'.$title.'">'.
                $sentences.
                '</span>';
    }

    /**
     * Перевод полученного результата в строку
     * 
     * @return string
     */
    public function convert()
    {
        $string = '';
        foreach ($this->result as $key => $sentences) {
            $string .= $sentences;
        }
        return $string;
    }
}
?>