# Coding Standards

## Installation

Install package version
```
composer req sokil/php-coding-standarts
```

## Code style rule sets

Add rule to your root `phpcs.xml.dist`:

```
<?xml version="1.0" encoding="UTF-8"?>

<ruleset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="vendor/squizlabs/php_codesniffer/phpcs.xsd">
    <!-- your rulesets -->
    <rule ref="App"/>
    <!-- your rulesets -->
    <arg name="extensions" value="php" />
    <file>src/</file>
</ruleset>
```

## Git hooks

Configure composer hooks in your root `composer.json`:

```
"scripts": {
    "post-install-cmd": [
        "Sokil\\CodingStandard\\GitHook\\GitHookInstallerComposerEventListener::installGitHooks"
    ],
    "post-update-cmd": [
        "Sokil\\CodingStandard\\GitHook\\GitHookInstallerComposerEventListener::installGitHooks"
    ]
}
```



