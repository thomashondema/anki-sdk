# Anki PHP SDK
An Anki SDK for PHP developers

## Quick start
```Shell
composer require thomashondema/anki-sdk
```
```PHP
use AnkiSDK\Builder\Package as PackageBuilder
$packageBuilder = new PackageBuilder();
$packageBuilder = PackageBuilder::fromArchive('./input.apkg');    
$packageBuilder = PackageBuilder::fromFolder('./input');

$card = new Card([
    'guid' => uniqid(),
    'flds' => '<b>hello</b>[sound:hello.mp3]<u>hola</u>',
    'sfld' => 'hello[sound:hello.mp3]',
    'tags' => 'greetings',
]);
$card->save();

$packageBuilder->saveArchive('./output.apkg');
```
