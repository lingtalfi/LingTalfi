<?php


namespace Ling\LingTalfi\Util;

use Ling\Bat\ConvertTool;
use Ling\Bat\FileSystemTool;
use Ling\Bat\ZipTool;
use Ling\CliTools\Output\OutputInterface;
use Ling\LingTalfi\Exception\LingTalfiException;
use Ling\UniverseTools\DependencyTool;
use Ling\UniverseTools\PlanetTool;

/**
 * The AppBoilerplateUtil class.
 */
class AppBoilerplateUtil
{


    /**
     * This property holds the uniDir for this instance.
     * @var string
     */
    private string $uniDir;


    /**
     * This property holds the output for this instance.
     * @var OutputInterface|null
     */
    private ?OutputInterface $output;


    /**
     * Builds the AppBoilerplateUtil instance.
     */
    public function __construct()
    {
        $this->uniDir = "/myphp/universe";
        $this->output = null;
    }

    /**
     * Sets the output.
     *
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }


    /**
     * Returns the dependencies packed in the boilerplate.
     * It returns an array of planet dot names.
     * @return array
     * @throws \Exception
     */
    public function getBoilerplateDependencies(): array
    {

        $planets = [
            "Ling.BumbleBee",
            "Ling.Light_Cli",
            "Ling.Light_PlanetInstaller",
        ];
        $errors = [];
        $ret = DependencyTool::getDependencyListRecursiveByUniverseDirPlanets($this->uniDir, $planets, true, $errors, [
            "recursive" => true,
        ]);
        if ($errors) {
            throw new LingTalfiException("Some errors occurred while collecting dependencies: " . implode(PHP_EOL, $errors));
        }
        return $ret;
    }


    /**
     * Upgrades the boilerplate for the Light_AppBoilerplate planet.
     *
     * @throws \Exception
     *
     */
    public function upgradeBoilerplate()
    {

        $dir = FileSystemTool::mkTmpDir();


        FileSystemTool::mkdir($dir);


        //--------------------------------------------
        // BASIC FILES
        //--------------------------------------------
        $boilerplateDir = __DIR__ . "/../assets/light-app-boilerplate";
        $otherFiles = [
            "config/services/_zzz.byml",
            "universe/bigbang.php",
            "www/index.php",
        ];
        foreach ($otherFiles as $rpath) {
            $file = $boilerplateDir . "/$rpath";
            $dst = $dir . "/$rpath";
            FileSystemTool::copyFile($file, $dst);
        }


        //--------------------------------------------
        // PLANETS
        //--------------------------------------------
        $uniDir = $this->uniDir;
        $deps = $this->getBoilerplateDependencies();


        if ($deps) {

            $nbDeps = count($deps);

            $c = 1;
            foreach ($deps as $pDotName) {

                $pSlashName = PlanetTool::getPlanetSlashNameByDotName($pDotName);
                $planetDir = $uniDir . "/" . $pSlashName;
                $sizeHuman = ConvertTool::convertBytes(FileSystemTool::getDirectorySize($planetDir), 'h');


                $this->msg("Processing planet $pDotName ($c/$nbDeps) ($sizeHuman)" . PHP_EOL);
                flush();

                if (true === is_dir($planetDir)) {
                    PlanetTool::importPlanetByExternalDir($pDotName, $planetDir, $dir, [
                        "assets" => true,
                    ]);
                } else {
                    throw new LingTalfiException("Planet dir not found: $planetDir.");
                }
                $c++;
            }
        }


        //--------------------------------------------
        // CREATE ZIP ARCHIVE
        //--------------------------------------------

        $this->msg("Creating zip archive..." . PHP_EOL);
        flush();


        $zipFile = $dir . ".zip";
        ZipTool::zip($dir, $zipFile, [
            "ignoreName" => [
                ".git",
                ".gitignore",
            ]
        ]);
        FileSystemTool::remove($dir);


        $zipFileDst = $uniDir . "/Ling/Light_AppBoilerplate/assets/light-app-boilerplate.zip";
        $this->msg("moving zip file to $zipFileDst." . PHP_EOL);
        FileSystemTool::move($zipFile, $zipFileDst);


    }


    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Writes the message to the output.
     * @param string $message
     */
    private function msg(string $message)
    {
        $this->output->write($message);
    }
}

