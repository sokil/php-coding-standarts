<?php

declare(strict_types=1);

namespace Sokil\CodingStandard\GitHook;

class GitHookInstaller
{
    /**
     * @var string[]
     */
    private $availableHooks;

    /**
     * @var string
     */
    private $templatesDir;

    /**
     * @param string[] $availableHooks
     * @param string $templatesDir
     */
    public function __construct(
        array $availableHooks,
        string $templatesDir
    ) {
        $this->availableHooks = $availableHooks;
        $this->templatesDir = rtrim($templatesDir, '/');
    }

    public function install(): void
    {
        $expectedGitHookDirs = [
            # Production mode. Update hooks of project
            __DIR__ . '/../../../../../.git/hooks',
            # Library maintenance mode. Update this library hooks
            __DIR__ . '/../../.git/hooks',
        ];

        $actualGitHookDir = null;
        foreach ($expectedGitHookDirs as $expectedGitHookDir) {
            if (file_exists($expectedGitHookDir)) {
                $actualGitHookDir = $expectedGitHookDir;
                break;
            }
        }

        if ($actualGitHookDir === null) {
            throw new \RuntimeException(
                sprintf(
                    'Git hooks directory not found among %s',
                    implode(', ', $expectedGitHookDirs)
                )
            );
        }

        foreach ($this->availableHooks as $hook) {
            $hookPath = $actualGitHookDir . '/' . $hook;

            copy(
                $this->templatesDir . '/' . $hook,
                $hookPath
            );

            chmod($hookPath, 0775);
        }
    }
}
