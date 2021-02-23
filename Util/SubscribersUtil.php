<?php


namespace Ling\LingTalfi\Util;

use Ling\Light_PlanetInstaller\Helper\LpiDependenciesHelper;
use Ling\Light_PlanetInstaller\Helper\LpiVersionHelper;
use Ling\LingTalfi\Kaos\Util\CommitWizard;
use Ling\UniverseTools\LocalUniverseTool;
use Ling\UniverseTools\MetaInfoTool;
use Ling\UniverseTools\PlanetTool;

/**
 * The SubscribersUtil class.
 */
class SubscribersUtil
{

    public function updateSubscribersDependenciesAndCommit(string $planetDot)
    {


        $uniDir = LocalUniverseTool::getLocalUniversePath();

        $noLpiFiles = [];

        $planetDir = $uniDir . "/" . PlanetTool::getPlanetSlashNameByDotName($planetDot);
        $currentVersion = MetaInfoTool::getVersion($planetDir);


        $depHelper = new LpiDependenciesHelper();
        $matches = $depHelper->getSubscribersList($planetDot, $uniDir, $noLpiFiles, [
            "lastOnly" => true,
        ]);


        $u = new CommitWizard();


        foreach ($matches as $subscriberDot => $info) {
            list($subscriberVersion, $referencedVersion) = $info;
            $referencedVersion = LpiVersionHelper::toMiniVersionExpression($planetDot, $referencedVersion);
            $referencedVersion = LpiVersionHelper::removeModifierSymbol($referencedVersion);

            if ($referencedVersion !== $currentVersion) {
                $subscriberPlanetDir = $uniDir . "/" . PlanetTool::getPlanetSlashNameByDotName($subscriberDot);
                MetaInfoTool::incrementVersion($subscriberPlanetDir);
                $u->commit($subscriberDot, "Update dependencies");
                a("Commiting $subscriberDot");

            }

        }
    }
}