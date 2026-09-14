<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\ViewHelpers;

use \TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Erzeugt aus den Social-Media-Feldern einer Adresse ein schema.org-konformes
 * "sameAs"-JSON-Array mit vollständigen URLs.
 *
 * In den DB-Feldern stehen nur Handles/Benutzernamen (z. B. "musterfirma"),
 * die URL-Muster entsprechen den Fluid-Partials der tt_address-Extension:
 *
 *   twitter          -> https://twitter.com/{handle}
 *   facebook         -> https://www.facebook.com/{handle}
 *   instagram        -> https://www.instagram.com/{handle}
 *   tiktok           -> https://www.tiktok.com/@{handle}
 *   linkedin         -> https://www.linkedin.com/in/{handle}
 *   linkedincompany  -> https://www.linkedin.com/company/{handle}
 *   whatsapp         -> https://wa.me/{nummer}
 *   bluesky          -> https://bsky.app/profile/{handle}
 *   youtubechannel   -> https://www.youtube.com/{handle}
 *
 * Verwendung im Template:
 *   {hhplaces:sameAsJson(address: address)}
 *
 * Rückgabe (Beispiel):
 *   ["https://twitter.com/musterfirma","https://www.facebook.com/musterfirma"]
 *
 * Gibt einen Leerstring zurück, wenn kein Feld gefüllt ist, damit im
 * Template einfach mit <f:if condition="..."> geprüft werden kann.
 */
final class SameAsJsonViewHelper extends AbstractViewHelper {
    protected $escapeOutput = false;

    /**
     * Property-Name => [URL-Muster, führendes "@" im Handle entfernen?]
     *
     * "stripAt" ist bewusst nur dort aktiv, wo die Ziel-URL kein "@"
     * enthält (bzw. das Muster es selbst ergänzt, wie bei TikTok).
     * Bei YouTube bleibt ein evtl. gespeichertes "@handle" erhalten,
     * weil youtube.com/@handle eine gültige Kanal-URL ist.
     */
    private const NETWORKS = [
        'twitter' => ['url' => 'https://twitter.com/%s', 'stripAt' => true],
        'facebook' => ['url' => 'https://www.facebook.com/%s', 'stripAt' => false],
        'instagram' => ['url' => 'https://www.instagram.com/%s', 'stripAt' => true],
        'tiktok' => ['url' => 'https://www.tiktok.com/@%s', 'stripAt' => true],
        'linkedin' => ['url' => 'https://www.linkedin.com/in/%s', 'stripAt' => false],
        'linkedincompany' => ['url' => 'https://www.linkedin.com/company/%s', 'stripAt' => false],
        'whatsapp' => ['url' => 'https://wa.me/%s', 'stripAt' => false],
        'bluesky' => ['url' => 'https://bsky.app/profile/%s', 'stripAt' => true],
        'youtubechannel' => ['url' => 'https://www.youtube.com/%s', 'stripAt' => false],
    ];

    public function initializeArguments(): void {
        $this->registerArgument(
            'address',
            'object',
            'Adress-/Place-Objekt (tt_address), aus dem die Social-Media-Felder gelesen werden',
            true
        );
    }

    public function render(): string {
        $address = $this->arguments['address'];
        $urls = [];

        foreach (self::NETWORKS as $property => $config) {
            $value = trim((string)ObjectAccess::getPropertyPath($address, $property));

            if ($value === '') {
                continue;
            }

            // Falls im Feld doch bereits eine vollständige URL steht,
            // wird sie unverändert übernommen.
            if (str_starts_with($value, 'https://') || str_starts_with($value, 'http://')) {
                $urls[] = $value;
                continue;
            }

            if ($config['stripAt']) {
                $value = ltrim($value, '@');
            }

            // wa.me erwartet die Nummer ohne "+", Leerzeichen oder Trennzeichen
            if ($property === 'whatsapp') {
                $value = preg_replace('/[^0-9]/', '', $value) ?? '';
                if ($value === '') {
                    continue;
                }
            }

            $urls[] = sprintf($config['url'], $value);
        }

        if ($urls === []) {
            return '';
        }

        return (string)json_encode(
            array_values(array_unique($urls)),
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        );
    }
}
