<?php


namespace Ling\LingTalfi\GranularDependency;

use Ling\BabyYaml\BabyYamlUtil;
use Ling\LingTalfi\Kaos\Util\ReadmeUtil;
use Ling\UniverseTools\DependencyTool;
use Ling\UniverseTools\MetaInfoTool;

/**
 * The GranularDependencyUtil class.
 */
class GranularDependencyUtil
{


    /**
     * Returns the array of all version numbers found in the README.md of the given planetDir.
     *
     *
     * @param string $planetDir
     * @return array
     */
    public function getReadmeVersionsByPlanetDir(string $planetDir): array
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
     * Creates the lpi-deps file for the given planetDir.
     * Available options are:
     * - force, bool=false. Whether to overwrite the lpi-deps file if it already exists
     *
     *
     * @param string $planetDir
     */
    public function createLpiDepsFileByPlanetDir(string $planetDir, array $options = [])
    {
        $uniDir = '/myphp/universe';
        $force = $options['force'] ?? false;
        $lpiDepsFilePath = $planetDir . "/lpi-deps.byml";

        $createTheFile = false;
        if (true === file_exists($lpiDepsFilePath)) {
            if (true === $force) {
                $createTheFile = true;
            }
        } else {
            $createTheFile = true;
        }


        if (true === $createTheFile) {

            $data = [];
            $rawDependencies = DependencyTool::getDependencyList($planetDir);
            $versionNumbers = $this->getReadmeVersionsByPlanetDir($planetDir);
            $deps = [];

            foreach ($rawDependencies as $dependency) {
                list($galaxy, $planet) = $dependency;
                $depPlanetDir = $uniDir . "/$galaxy/$planet";
                $version = MetaInfoTool::getVersion($depPlanetDir);
                $deps[] = implode(':', [$galaxy, $planet, $version]);
            }


            foreach ($versionNumbers as $number) {
                $data[$number] = $deps;
            }

            BabyYamlUtil::writeFile($data, $lpiDepsFilePath);
        }
    }
}