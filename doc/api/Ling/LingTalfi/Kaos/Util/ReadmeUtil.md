[Back to the Ling/LingTalfi api](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi.md)



The ReadmeUtil class
================
2019-03-13 --> 2021-12-02






Introduction
============

The ReadmeUtil class.



Class synopsis
==============


class <span class="pl-k">ReadmeUtil</span>  {

- Properties
    - protected array [$errors](#property-errors) ;
    - protected bool [$isLight](#property-isLight) ;
    - protected string [$serviceContent](#property-serviceContent) ;
    - private string [$historyLogRegex](#property-historyLogRegex) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/__construct.md)() : void
    - public [setIsLight](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/setIsLight.md)(bool $isLight) : void
    - public [setServiceContent](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/setServiceContent.md)(string $serviceContent) : void
    - public [createBasicReadmeFile](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/createBasicReadmeFile.md)($readmeFile, array $tags) : bool
    - public [getLatestVersionInfo](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getLatestVersionInfo.md)(string $readMeFile, ?array &$errors = []) : array | false
    - public [getErrors](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getErrors.md)() : array

}




Properties
=============

- <span id="property-errors"><b>errors</b></span>

    This property holds the errors for this instance.
    
    

- <span id="property-isLight"><b>isLight</b></span>

    This property holds the isLight for this instance.
    
    

- <span id="property-serviceContent"><b>serviceContent</b></span>

    This property holds the serviceContent for this instance.
    
    

- <span id="property-historyLogRegex"><b>historyLogRegex</b></span>

    This property holds the historyLogRegex for this instance.
    
    



Methods
==============

- [ReadmeUtil::__construct](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/__construct.md) &ndash; Builds the ReadmeUtil instance.
- [ReadmeUtil::setIsLight](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/setIsLight.md) &ndash; Sets the isLight.
- [ReadmeUtil::setServiceContent](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/setServiceContent.md) &ndash; Sets the serviceContent.
- [ReadmeUtil::createBasicReadmeFile](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/createBasicReadmeFile.md) &ndash; was successful.
- [ReadmeUtil::getLatestVersionInfo](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getLatestVersionInfo.md) &ndash; Proxy to the standardReadmeUtil's getLatestVersionInfo method.
- [ReadmeUtil::getErrors](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getErrors.md) &ndash; Returns the errors of this instance.





Location
=============
Ling\LingTalfi\Kaos\Util\ReadmeUtil<br>
See the source code of [Ling\LingTalfi\Kaos\Util\ReadmeUtil](https://github.com/lingtalfi/LingTalfi/blob/master/Kaos/Util/ReadmeUtil.php)



SeeAlso
==============
Previous class: [CommitWizard](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/CommitWizard.md)<br>Next class: [PhpStormMetaHelper](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/PhpStormMeta/PhpStormMetaHelper.md)<br>
