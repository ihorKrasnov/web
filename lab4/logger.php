<?php
interface ILogger {
    public function logMessage($message);
}

trait DateTimeTrait {
    public function getCurrentDateTime() {
        return date('F j, Y, g:i a');
    }
}

trait FileLoggerTrait {
    public function writeToFile($message) {
        $filePath = 'log.txt';
        file_put_contents($filePath, $message . PHP_EOL, FILE_APPEND);
    }
}

class FileLogger implements ILogger {
    use DateTimeTrait, FileLoggerTrait;

    public function logMessage($message) {
        $dateTime = $this->getCurrentDateTime();
        $logEntry = "$dateTime: $message";
        $this->writeToFile($logEntry);
    }
}

$logger = new FileLogger();

$logger->logMessage("First message");
$logger->logMessage("The second test message");

?>
