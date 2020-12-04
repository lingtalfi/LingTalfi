<?php


namespace Ling\LingTalfi\Kaos\Util;


use Ling\Bat\FileSystemTool;
use Ling\LingTalfi\Exception\LingTalfiException;
use Ling\UniverseTools\MetaInfoTool;
use Ling\UniverseTools\PlanetTool;

/**
 * The ReadmeUtil class.
 */
class ReadmeUtil
{

    /**
     * This property holds the errors for this instance.
     * @var array
     */
    protected $errors;

    /**
     * This property holds the isLight for this instance.
     * @var bool
     */
    protected $isLight;


    /**
     * This property holds the serviceContent for this instance.
     * @var string
     */
    protected $serviceContent;

    /**
     * This property holds the historyLogRegex for this instance.
     * @var string
     */
    private $historyLogRegex;


    /**
     * Builds the ReadmeUtil instance.
     */
    public function __construct()
    {
        $this->errors = [];
        $this->isLight = false;
        $this->serviceContent = '';
        $this->historyLogRegex = '!History\s*Log!i';
    }

    /**
     * Sets the isLight.
     *
     * @param bool $isLight
     */
    public function setIsLight(bool $isLight)
    {
        $this->isLight = $isLight;
    }

    /**
     * Sets the serviceContent.
     *
     * @param string $serviceContent
     */
    public function setServiceContent(string $serviceContent)
    {
        $this->serviceContent = $serviceContent;
    }


    /**
     * Writes a basic README file at the given location, and returns whether the creation of the file
     * was successful.
     *
     *
     *
     * @param $readmeFile
     * @param array $tags
     * Must contains the following tags:
     *
     * - galaxy: the name of the galaxy
     * - planet: the name of the planet
     * - ?date: the starting (mysql) date of the project (the current date will be used by default)
     *
     *
     * @return bool
     */
    public function createBasicReadmeFile($readmeFile, array $tags)
    {

        if (false === $this->isLight) {
            $tpl = __DIR__ . "/../assets/README.tpl.md";
        } else {
            $tpl = __DIR__ . "/../assets/README-light.tpl.md";
        }


        $keys = [
            "Ling",
            "WebBox",
            "2019-02-22",
            "__summary_links__",
        ];
        $values = [
            $tags['galaxy'] ?? "Ling",
            $tags['planet'] ?? "WebBox",
            $tags['date'] ?? date('Y-m-d'),
            $tags['summaryLinks'] ?? "",
        ];


        if (true === $this->isLight) {
            $keys[] = "theBabyYamlHere";
            $values[] = $this->serviceContent;
        }


        $content = file_get_contents($tpl);
        $content = str_replace($keys, $values, $content);
        return FileSystemTool::mkfile($readmeFile, $content);
    }


    /**
     * Returns information about the latest version found in the **History Log**
     * section of the given README file.
     *
     * Returns false if a problem occurred, in which case errors are accessible via the getErrors method.
     *
     * In case of success, the array has the following structure:
     *
     * - 0: version
     * - 1: text
     *
     *
     *
     *
     * @param string $readMeFile
     * @return array|false
     */
    public function getLatestVersionInfo(string $readMeFile)
    {
        $this->errors = [];
        $ret = false;
        if (file_exists($readMeFile)) {

            $lines = file($readMeFile);

            // assuming the last version is at the top

            $historyLogSectionFound = false;
            $versionFound = false;
            $version = null;
            $text = null;
            foreach ($lines as $line) {
                if (true === $historyLogSectionFound) {
                    if (false === $versionFound) {
                        if (0 === strpos($line, '- ')) {
                            if (preg_match('!([0-9]+\.[0-9]+(\.[0-9]+)?) -- [0-9]{4}-[0-9]{2}-[0-9]{2}!', $line, $match)) {
                                $version = $match[1];
                                $versionFound = true;
                            }
                        }
                    } else {
                        if (preg_match('!^\s+- (.*)!', $line, $match)) {
                            $text = $match[1];
                            break;
                        }
                    }
                } else {
                    if ('History Log' === trim($line)) {
                        $historyLogSectionFound = true;
                    }
                }
            }

            if (false === $historyLogSectionFound) {
                $this->addError("No \"History Log\" section found in this README file ($readMeFile).");
            } elseif (null !== $version && null !== $text) {
                $ret = [
                    $version,
                    $text,
                ];
            } else {
                $this->addError("Could not find the version and/or the commit text from the \"History Log\" section (in $readMeFile).");
            }

        } else {
            $this->addError("This entry is not a file: $readMeFile.");
        }
        return $ret;
    }


    /**
     * Returns an array of all version numbers found in the in the "History Log" section of the "read me" file.
     * @return array
     */
    public function getAllVersionNumbers(string $readmePath): array
    {
        $lines = file($readmePath, FILE_SKIP_EMPTY_LINES);


        //--------------------------------------------
        // FIRST COLLECT HISTORY LINES
        //--------------------------------------------
        $started = false;
        $historyLines = [];
        foreach ($lines as $line) {
            $line = trim($line);

            if (true === $started) {
                $historyLines[] = $line;
            } else {
                if (preg_match($this->historyLogRegex, $line, $match)) {
                    $started = true;
                }
            }
        }

        //--------------------------------------------
        // NOW COLLECT THE VERSION NUMBERS
        //--------------------------------------------
        $versionNumbers = [];
        foreach ($historyLines as $line) {
            if (preg_match('!-\s([0-9][^-]+)\s-+\s[0-9]{4}-[0-9]{2}-[0-9]{2}!', $line, $match)) {
                $versionNumbers[] = $match[1];
            }
        }

        sort($versionNumbers);
        return $versionNumbers;
    }

    /**
     * Returns the errors of this instance.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }


    /**
     *
     * Adds an history entry to the given "read me" file, with the given message, date and version.
     * Throws an exception if it fails.
     *
     * @param string $readmePath
     * @param string $version
     * @param string $date
     * @param string $message
     */
    public function addHistoryLogEntry(string $readmePath, string $version, string $date, string $message)
    {
        $lines = file($readmePath, FILE_SKIP_EMPTY_LINES);
        //--------------------------------------------
        // FIRST COLLECT HISTORY LINES
        //--------------------------------------------
        $started = false;
        $index = null;
        foreach ($lines as $k => $line) {
            $line = trim($line);
            if (true === $started) {
                if (preg_match('!- [0-9].*!', $line, $match)) {
                    $index = $k - 1;
                    break;
                }
            } else {
                if (preg_match($this->historyLogRegex, $line, $match)) {
                    $started = true;
                }
            }
        }

        if (null !== $index) {
            array_splice($lines, $index, 1, [
                '' . PHP_EOL,
                "- $version -- $date" . PHP_EOL,
                '' . PHP_EOL,
                "    - $message" . PHP_EOL,
                '' . PHP_EOL,
            ]);
            FileSystemTool::mkfile($readmePath, implode('', $lines));
        } else {
            throw new LingTalfiException("Didn't find a log entry section for this README file: $readmePath.");
        }
    }


    /**
     * Adds a commit message to the history log section of the README files for each planet in the given universeDir.
     * The version number is incremented from the last version found, using a minor version number increment.
     * The date is set to the current date.
     *
     *
     *
     * @param string $universeDir
     * @param string $message
     */
    public function addCommitMessageByUniverseDir(string $universeDir, string $message)
    {
        $planetDirs = PlanetTool::getPlanetDirs($universeDir);
        $date = date("Y-m-d");
        foreach ($planetDirs as $planetDir) {
            $lastVersion = MetaInfoTool::getVersion($planetDir);
            $p = explode(".", $lastVersion);
            $lastComponent = (int)array_pop($p);
            $lastComponent++;
            $p[] = $lastComponent;
            $version = implode('.', $p);
            $readmePath = $planetDir . "/README.md";
            $this->addHistoryLogEntry($readmePath, $version, $date, $message);
        }
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Adds a message error.
     *
     * @param string $msg
     */
    protected function addError(string $msg)
    {
        $this->errors[] = $msg;
    }
}