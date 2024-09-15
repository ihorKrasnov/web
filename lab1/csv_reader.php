<?php
class CSVReader {
    private $filename;
    private $delimiter;

    // Конструктор для ініціалізації імені файлу та роздільника
    public function __construct($filename, $delimiter = ',') {
        $this->filename = $filename;
        $this->delimiter = $delimiter;
    }

    // Метод для зчитування даних з CSV файлу
    public function readCSV(): array {
        $data = [];
    
        if (($handle = fopen($this->filename, 'r')) !== false) {
            // Зчитуємо заголовки
            $headers = fgetcsv($handle, 1000, $this->delimiter);
    
            // Якщо є заголовки, додаємо їх у масив даних
            if ($headers !== false) {
                $data[] = $headers;
            }
    
            // Зчитуємо решту рядків з CSV
            while (($row = fgetcsv($handle, 1000, $this->delimiter)) !== false) {
                $data[] = $row;
            }
    
            fclose($handle);
        } else {
            throw new Exception("Не вдалося відкрити файл для читання: " . $this->filename);
        }
    
        return $data;
    }

    // Метод для виведення даних на екран
    public function displayData(): void {
        try {
            $data = $this->readCSV();
            $headers = array_shift($data);

            foreach($data as $row) {
                for($i = 0; $i < count($row); $i++) {
                    echo $headers[$i] . ": " . $row[$i] . "\n";
                }
                echo "------------------------\n"; // Розділювач
            }  
            
        } catch (Exception $e) {
            echo "Помилка: " . $e->getMessage() . "\n";
        }
    }
}

// Приклад використання класу
$csvReader = new CSVReader('color_points.csv', ';');
$csvReader->displayData();
?>
