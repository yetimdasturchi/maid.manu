<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7ec61d9e5d895a34537f70aed811e42d
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '09fc349b549513bf7f4291502426f919' => __DIR__ . '/..' . '/embed/embed/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Yaml\\' => 23,
            'Slim\\Psr7\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
            'Psr\\EventDispatcher\\' => 20,
        ),
        'M' => 
        array (
            'ML\\JsonLD\\' => 10,
        ),
        'L' => 
        array (
            'League\\Config\\' => 14,
            'League\\CommonMark\\' => 18,
        ),
        'H' => 
        array (
            'HtmlParser\\' => 11,
        ),
        'F' => 
        array (
            'Fig\\Http\\Message\\' => 17,
        ),
        'E' => 
        array (
            'Embed\\' => 6,
        ),
        'D' => 
        array (
            'Dflydev\\DotAccessData\\' => 22,
        ),
        'C' => 
        array (
            'Composer\\CaBundle\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Slim\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/psr7/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'Psr\\EventDispatcher\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/event-dispatcher/src',
        ),
        'ML\\JsonLD\\' => 
        array (
            0 => __DIR__ . '/..' . '/ml/json-ld',
        ),
        'League\\Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/config/src',
        ),
        'League\\CommonMark\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/commonmark/src',
        ),
        'HtmlParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/oscarotero/html-parser/src',
        ),
        'Fig\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/fig/http-message-util/src',
        ),
        'Embed\\' => 
        array (
            0 => __DIR__ . '/..' . '/embed/embed/src',
        ),
        'Dflydev\\DotAccessData\\' => 
        array (
            0 => __DIR__ . '/..' . '/dflydev/dot-access-data/src',
        ),
        'Composer\\CaBundle\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/ca-bundle/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'ML\\IRI' => 
            array (
                0 => __DIR__ . '/..' . '/ml/iri',
            ),
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Nette\\ArgumentOutOfRangeException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\DeprecatedException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\DirectoryNotFoundException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\FileNotFoundException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\HtmlStringable' => __DIR__ . '/..' . '/nette/utils/src/HtmlStringable.php',
        'Nette\\IOException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\InvalidArgumentException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\InvalidStateException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\Iterators\\CachingIterator' => __DIR__ . '/..' . '/nette/utils/src/Iterators/CachingIterator.php',
        'Nette\\Iterators\\Mapper' => __DIR__ . '/..' . '/nette/utils/src/Iterators/Mapper.php',
        'Nette\\Localization\\ITranslator' => __DIR__ . '/..' . '/nette/utils/src/compatibility.php',
        'Nette\\Localization\\Translator' => __DIR__ . '/..' . '/nette/utils/src/Translator.php',
        'Nette\\MemberAccessException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\NotImplementedException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\NotSupportedException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\OutOfRangeException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\Schema\\Context' => __DIR__ . '/..' . '/nette/schema/src/Schema/Context.php',
        'Nette\\Schema\\DynamicParameter' => __DIR__ . '/..' . '/nette/schema/src/Schema/DynamicParameter.php',
        'Nette\\Schema\\Elements\\AnyOf' => __DIR__ . '/..' . '/nette/schema/src/Schema/Elements/AnyOf.php',
        'Nette\\Schema\\Elements\\Base' => __DIR__ . '/..' . '/nette/schema/src/Schema/Elements/Base.php',
        'Nette\\Schema\\Elements\\Structure' => __DIR__ . '/..' . '/nette/schema/src/Schema/Elements/Structure.php',
        'Nette\\Schema\\Elements\\Type' => __DIR__ . '/..' . '/nette/schema/src/Schema/Elements/Type.php',
        'Nette\\Schema\\Expect' => __DIR__ . '/..' . '/nette/schema/src/Schema/Expect.php',
        'Nette\\Schema\\Helpers' => __DIR__ . '/..' . '/nette/schema/src/Schema/Helpers.php',
        'Nette\\Schema\\Message' => __DIR__ . '/..' . '/nette/schema/src/Schema/Message.php',
        'Nette\\Schema\\Processor' => __DIR__ . '/..' . '/nette/schema/src/Schema/Processor.php',
        'Nette\\Schema\\Schema' => __DIR__ . '/..' . '/nette/schema/src/Schema/Schema.php',
        'Nette\\Schema\\ValidationException' => __DIR__ . '/..' . '/nette/schema/src/Schema/ValidationException.php',
        'Nette\\SmartObject' => __DIR__ . '/..' . '/nette/utils/src/SmartObject.php',
        'Nette\\StaticClass' => __DIR__ . '/..' . '/nette/utils/src/StaticClass.php',
        'Nette\\UnexpectedValueException' => __DIR__ . '/..' . '/nette/utils/src/exceptions.php',
        'Nette\\Utils\\ArrayHash' => __DIR__ . '/..' . '/nette/utils/src/Utils/ArrayHash.php',
        'Nette\\Utils\\ArrayList' => __DIR__ . '/..' . '/nette/utils/src/Utils/ArrayList.php',
        'Nette\\Utils\\Arrays' => __DIR__ . '/..' . '/nette/utils/src/Utils/Arrays.php',
        'Nette\\Utils\\AssertionException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Callback' => __DIR__ . '/..' . '/nette/utils/src/Utils/Callback.php',
        'Nette\\Utils\\DateTime' => __DIR__ . '/..' . '/nette/utils/src/Utils/DateTime.php',
        'Nette\\Utils\\FileSystem' => __DIR__ . '/..' . '/nette/utils/src/Utils/FileSystem.php',
        'Nette\\Utils\\Floats' => __DIR__ . '/..' . '/nette/utils/src/Utils/Floats.php',
        'Nette\\Utils\\Helpers' => __DIR__ . '/..' . '/nette/utils/src/Utils/Helpers.php',
        'Nette\\Utils\\Html' => __DIR__ . '/..' . '/nette/utils/src/Utils/Html.php',
        'Nette\\Utils\\IHtmlString' => __DIR__ . '/..' . '/nette/utils/src/compatibility.php',
        'Nette\\Utils\\Image' => __DIR__ . '/..' . '/nette/utils/src/Utils/Image.php',
        'Nette\\Utils\\ImageException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Json' => __DIR__ . '/..' . '/nette/utils/src/Utils/Json.php',
        'Nette\\Utils\\JsonException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\ObjectHelpers' => __DIR__ . '/..' . '/nette/utils/src/Utils/ObjectHelpers.php',
        'Nette\\Utils\\ObjectMixin' => __DIR__ . '/..' . '/nette/utils/src/Utils/ObjectMixin.php',
        'Nette\\Utils\\Paginator' => __DIR__ . '/..' . '/nette/utils/src/Utils/Paginator.php',
        'Nette\\Utils\\Random' => __DIR__ . '/..' . '/nette/utils/src/Utils/Random.php',
        'Nette\\Utils\\Reflection' => __DIR__ . '/..' . '/nette/utils/src/Utils/Reflection.php',
        'Nette\\Utils\\RegexpException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Strings' => __DIR__ . '/..' . '/nette/utils/src/Utils/Strings.php',
        'Nette\\Utils\\Type' => __DIR__ . '/..' . '/nette/utils/src/Utils/Type.php',
        'Nette\\Utils\\UnknownImageFileException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Validators' => __DIR__ . '/..' . '/nette/utils/src/Utils/Validators.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7ec61d9e5d895a34537f70aed811e42d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7ec61d9e5d895a34537f70aed811e42d::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7ec61d9e5d895a34537f70aed811e42d::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit7ec61d9e5d895a34537f70aed811e42d::$classMap;

        }, null, ClassLoader::class);
    }
}