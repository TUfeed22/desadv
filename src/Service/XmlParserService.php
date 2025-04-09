<?php

namespace App\Service;
use App\Dto\DesadvXmlDto;
use DateMalformedStringException;
use DateTimeImmutable;
use RuntimeException;
use SimpleXMLElement;

class XmlParserService
{
    /**
     * @throws DateMalformedStringException
     */
    public function parseXml(string $filename): DesadvXmlDto
    {
        $xml = $this->loadXml($filename);
        return $this->createDtoFromXml($xml);
    }

    /**
     * Загрузка xml данных из файла
     *
     * @param string $file
     * @return SimpleXMLElement
     */
    private function loadXml(string $file): SimpleXMLElement
    {
        if (!file_exists($file)) {
            throw new RuntimeException('XML file not found');
        }

        $xml = simplexml_load_file($file);
        if ($xml === false) {
            throw new RuntimeException('Failed to parse XML');
        }

        return $xml;
    }

    /**
     * Создание объекта DTO. Собираем только нужные данные
     *
     * @throws DateMalformedStringException
     */
    private function createDtoFromXml(SimpleXMLElement $xml): DesadvXmlDto
    {
        return new DesadvXmlDto(
            number: (int)$xml->NUMBER,
            date: new DateTimeImmutable((string)$xml->DATE),
            recipient: (int)$xml->HEAD->RECIPIENT,
            sender: (int)$xml->HEAD->SENDER,
            body: json_decode(json_decode($xml->HEAD->PACKINGSEQUENCE, JSON_UNESCAPED_UNICODE), true)
        );
    }

}