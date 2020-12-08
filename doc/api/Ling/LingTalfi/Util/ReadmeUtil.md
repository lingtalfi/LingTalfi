[Back to the Ling/LingTalfi api](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi.md)



The ReadmeUtil class
================
2019-03-13 --> 2020-12-08






Introduction
============

The ReadmeUtil class.



Class synopsis
==============


class <span class="pl-k">ReadmeUtil</span> extends [ReadmeUtil](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil.md)  {

- Inherited properties
    - protected array [ReadmeUtil::$errors](#property-errors) ;
    - protected bool [ReadmeUtil::$isLight](#property-isLight) ;
    - protected string [ReadmeUtil::$serviceContent](#property-serviceContent) ;

- Inherited methods
    - public [ReadmeUtil::__construct](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/__construct.md)() : void
    - public [ReadmeUtil::setIsLight](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/setIsLight.md)(bool $isLight) : void
    - public [ReadmeUtil::setServiceContent](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/setServiceContent.md)(string $serviceContent) : void
    - public [ReadmeUtil::createBasicReadmeFile](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/createBasicReadmeFile.md)($readmeFile, array $tags) : bool
    - public [ReadmeUtil::getLatestVersionInfo](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getLatestVersionInfo.md)(string $readMeFile) : array | false
    - public [ReadmeUtil::getAllVersionNumbers](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getAllVersionNumbers.md)(string $readmePath) : array
    - public [ReadmeUtil::getErrors](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getErrors.md)() : array
    - public [ReadmeUtil::addHistoryLogEntry](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/addHistoryLogEntry.md)(string $readmePath, string $version, string $date, string $message) : void
    - public [ReadmeUtil::addCommitMessageByUniverseDir](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/addCommitMessageByUniverseDir.md)(string $universeDir, string $message) : void
    - protected [ReadmeUtil::addError](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/addError.md)(string $msg) : void

}






Methods
==============

- [ReadmeUtil::__construct](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/__construct.md) &ndash; Builds the ReadmeUtil instance.
- [ReadmeUtil::setIsLight](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/setIsLight.md) &ndash; Sets the isLight.
- [ReadmeUtil::setServiceContent](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/setServiceContent.md) &ndash; Sets the serviceContent.
- [ReadmeUtil::createBasicReadmeFile](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/createBasicReadmeFile.md) &ndash; was successful.
- [ReadmeUtil::getLatestVersionInfo](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getLatestVersionInfo.md) &ndash; section of the given README file.
- [ReadmeUtil::getAllVersionNumbers](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getAllVersionNumbers.md) &ndash; Returns an array of all version numbers found in the in the "History Log" section of the "read me" file.
- [ReadmeUtil::getErrors](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/getErrors.md) &ndash; Returns the errors of this instance.
- [ReadmeUtil::addHistoryLogEntry](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/addHistoryLogEntry.md) &ndash; Adds an history entry to the given "read me" file, with the given message, date and version.
- [ReadmeUtil::addCommitMessageByUniverseDir](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/addCommitMessageByUniverseDir.md) &ndash; Adds a commit message to the history log section of the README files for each planet in the given universeDir.
- [ReadmeUtil::addError](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Util/ReadmeUtil/addError.md) &ndash; Adds a message error.





Location
=============
Ling\LingTalfi\Util\ReadmeUtil<br>
See the source code of [Ling\LingTalfi\Util\ReadmeUtil](https://github.com/lingtalfi/LingTalfi/blob/master/Util/ReadmeUtil.php)



SeeAlso
==============
Previous class: [CommitUtil](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Util/CommitUtil.md)<br>