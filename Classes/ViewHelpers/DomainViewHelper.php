<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\ViewHelpers;

// use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;


/**
 * DomainViewHelper
 *
 * usage e.g. for tt_address field "www":
 * {address.www} = "https://www.domain.tld/some-site" or "t3://page?uid=79 _blank my-class link-title"
 * returns "www.domain.tld"
 *
 * <html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
 *       xmlns:place="http://typo3.org/ns/HauerHeinrich/HhTtAddressPlaces/ViewHelpers"
 *       data-namespace-typo3-fluid="true">
 *
 * <place:domain url="{f:uri.typolink(parameter: '{address.www}', absolute: 1)}" domainOnly="1" withoutScheme="1" />
 */
final class DomainViewHelper extends AbstractViewHelper {

    public function initializeArguments() {
        $this->registerArgument('url', 'string', '', true);
        $this->registerArgument('domainOnly', 'bool', 'Return only the domain host, eg. www.domain.tld ', false, false);
        $this->registerArgument('withoutScheme', 'bool', 'Return url without "scheme"', false, false);
    }

    public function render(): string {
        $givenUrl = $this->arguments['url'];
        $domainOnly = $this->arguments['domainOnly'];
        $withoutScheme = $this->arguments['withoutScheme'];

        if(filter_var($givenUrl, FILTER_VALIDATE_URL)) {
            $urlParts = parse_url($givenUrl);

            $host = $urlParts['host'];

            if($domainOnly === true && $withoutScheme === true) {
                return $host;
            }

            if($domainOnly === true) {
                return $urlParts['scheme'] . '://' . $host;
            }

            if($withoutScheme === true) {
                return $host . $urlParts['path'];
            }
        }

        return $givenUrl;
    }
}
