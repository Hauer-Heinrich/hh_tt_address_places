<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\ViewHelpers;

use \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Erzeugt ein schema.org-konformes JSON-Array von OpeningHoursSpecification-
 * Objekten aus einer Menge von PeriodOfTime-Datensätzen.
 *
 * Verwendung im Template:
 *   {hhplaces:openingHoursJson(periods: address.openingHours)}
 *
 * Rückgabe (Beispiel):
 *   [{"@type":"OpeningHoursSpecification","dayOfWeek":"https://schema.org/Monday","opens":"08:00","closes":"12:00"}, ...]
 *
 * Gibt einen Leerstring zurück, wenn keine Öffnungszeiten vorhanden sind,
 * damit im Template einfach mit <f:if condition="..."> geprüft werden kann.
 */
final class OpeningHoursJsonViewHelper extends AbstractViewHelper {
    protected $escapeOutput = false;

    public function initializeArguments(): void {
        $this->registerArgument(
            'periods',
            'object',
            'ObjectStorage or Array of Domain/Model/PeriodOfTime',
            true
        );
    }

    public function render(): string {
        $specifications = [];

        foreach ($this->arguments['periods'] as $period) {
            // Schließzeiten (z. B. Betriebsferien):
            // Konvention opens = closes = 00:00 + Gültigkeitszeitraum
            if ($period->getClosed()) {
                $from = $this->formatDate($period->getClosedFromDate());
                $to = $this->formatDate($period->getClosedToDate());

                if ($from !== null && $to !== null) {
                    $specifications[] = [
                        '@type' => 'OpeningHoursSpecification',
                        'opens' => '00:00',
                        'closes' => '00:00',
                        'validFrom' => $from,
                        'validThrough' => $to,
                    ];
                }
                continue;
            }

            // Reguläre Öffnungszeiten aus dem strukturierten Array:
            // ['monday' => ['open' => ['08:00:00', '13:00:00'], 'close' => ['12:00:00', '17:00:00']], ...]
            foreach ($period->getStructuredOpeningTimes() as $day => $times) {
                foreach ($times['open'] ?? [] as $index => $open) {
                    $close = $times['close'][$index] ?? null;

                    if (empty($open) || empty($close)) {
                        continue;
                    }

                    $specifications[] = [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => 'https://schema.org/' . ucfirst((string)$day),
                        'opens' => $this->formatTime($open),
                        'closes' => $this->formatTime($close),
                    ];
                }
            }
        }

        if ($specifications === []) {
            return '';
        }

        return (string)json_encode(
            $specifications,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        );
    }

    /**
     * '08:00:00' bzw. \DateTimeInterface -> '08:00' (schema.org erwartet HH:MM)
     */
    private function formatTime(mixed $time): string {
        if ($time instanceof \DateTimeInterface) {
            return $time->format('H:i');
        }

        return substr((string)$time, 0, 5);
    }

    /**
     * \DateTimeInterface oder Unix-Timestamp (int) -> 'Y-m-d', sonst null
     */
    private function formatDate(mixed $date): ?string {
        if ($date instanceof \DateTimeInterface) {
            return $date->format('Y-m-d');
        }

        if (is_int($date) && $date > 0) {
            return date('Y-m-d', $date);
        }

        return null;
    }
}
