<?php
class FileProcessor {
    private $inputFile;
    private $outputFile;

    // Конструктор для ініціалізації імен файлів
    public function __construct($inputFile, $outputFile) {
        $this->inputFile = $inputFile;
        $this->outputFile = $outputFile;
    }

    // Метод для читання чисел з файлу
    private function readNumbersFromFile() {
        $inputData = file_get_contents($this->inputFile);

        if ($inputData === false) {
            throw new Exception("Не вдалося прочитати файл: " . $this->inputFile);
        }

        // Розбиваємо рядок на числа
        $numbers = explode(' ', trim($inputData));

        // Перевірка на кількість чисел
        if (count($numbers) != 10) {
            throw new Exception("Файл має містити рівно 10 цілих чисел.");
        }

        return $numbers;
    }

    // Метод для запису чисел у файл у зворотному порядку
    private function writeNumbersToFile(array $numbers) {
        // Перевертаємо порядок чисел
        $numbers = array_reverse($numbers);

        // Перетворюємо масив чисел у рядок
        $outputData = implode(' ', $numbers);

        // Записуємо у файл
        $result = file_put_contents($this->outputFile, $outputData);

        if ($result === false) {
            throw new Exception("Не вдалося записати у файл: " . $this->outputFile);
        }
    }

    // Публічний метод для обробки файлів
    public function processFiles() {
        try {
            // Читаємо числа з файлу
            $numbers = $this->readNumbersFromFile();

            // Записуємо числа у зворотному порядку у другий файл
            $this->writeNumbersToFile($numbers);

            echo "Дані успішно записані у файл: " . $this->outputFile . "\n";
        } catch (Exception $e) {
            echo "Помилка: " . $e->getMessage() . "\n";
        }
    }
}

// Приклад використання класу
$inputFile = 'text.txt';
$outputFile = 'output.txt';

$processor = new FileProcessor($inputFile, $outputFile);
$processor->processFiles();
?>