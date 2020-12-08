<?php


namespace Ling\LingTalfi\GranularDependency;

use Ling\BabyYaml\BabyYamlUtil;
use Ling\Light_PlanetInstaller\Helper\LightPlanetInstallerHelper;
use Ling\LingTalfi\Kaos\Util\ReadmeUtil;
use Ling\UniverseTools\PlanetTool;

/**
 * The GranularDependencyUtil class.
 */
class GranularDependencyUtil
{


    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Returns the array of all version numbers found in the README.md of the given planetDir.
     *
     *
     * @param string $planetDir
     * @return array
     */
    public static function getReadmeVersionsByPlanetDir(string $planetDir): array
    {
        $ret = [];
        $readmePath = $planetDir . "/README.md";
        if (file_exists($readmePath)) {
            $util = new ReadmeUtil();
            $ret = $util->getAllVersionNumbers($readmePath);
        }
        return $ret;
    }





    /**
     * Creates the master dependency file content for the given universe directory and returns it.
     *
     * Feeds the errors array with errors that might happen.
     *
     *
     * @param string $universeDir
     * @param array $errors
     * @return string
     */
    public function getMasterDependencyFileContentByUniverseDir(string $universeDir, array &$errors = []): string
    {
        $i4 = str_repeat(' ', 4);
        $s = '';
        $s .= 'dependencies:' . PHP_EOL;


        $planetDirs = PlanetTool::getPlanetDirs($universeDir);
        foreach ($planetDirs as $planetDir) {
            list($galaxy, $planet) = PlanetTool::getGalaxyNamePlanetNameByDir($planetDir);
            $planetDot = $galaxy . "." . $planet;
            $depsFile = $planetDir . "/lpi-deps.byml";
            if (false === file_exists($depsFile)) {
                $errors[] = "Planet $planetDot: no lpi-deps.byml file found, skipping";
                continue;
            }
            $deps = BabyYamlUtil::readFile($depsFile);
            $s .= $i4 . $planetDot . ':';
            if ($deps) {
                $s .= PHP_EOL;
                foreach ($deps as $version => $planetDeps) {
                    $s .= $i4 . $i4 . $version . ":";
                    if ($planetDeps) {
                        $s .= PHP_EOL;
                        foreach ($planetDeps as $planetDep) {
                            $s .= $i4 . $i4 . $i4 . "- " . $planetDep . PHP_EOL;
                        }
                    } else {
                        $s .= ' []' . PHP_EOL;
                    }
                }
            } else {
                $s .= ' []' . PHP_EOL;
            }

        }
        return $s;
    }

}