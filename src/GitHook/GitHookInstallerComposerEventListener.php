<?php

declare(strict_types=1);

namespace Sokil\CodingStandard\GitHook;

use Composer\Script\Event;

class GitHookInstallerComposerEventListener
{
    public static function installGitHooks(Event $event)
    {
        if (true === $event->isDevMode()) {
            $templateDirectory = __DIR__ . '/../../gitHooks/';

            $installer = new GitHookInstaller(
                [
                    'pre-commit',
                    'prepare-commit-msg',
                ],
                $templateDirectory
            );

            try {
                $installer->install();
            } catch (\Throwable $e) {
                echo "Can not install git hooks: " . $e->getMessage();
            }
        }
    }
}
