<?php

/**
 * @file
 * Contains \Drush.
 */
namespace Drush;

use Consolidation\SiteAlias\AliasRecord;
use Consolidation\SiteAlias\SiteAliasManager;
use Consolidation\SiteProcess\ProcessBase;
use Consolidation\SiteProcess\SiteProcess;
use Drush\Style\DrushStyle;
use League\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// TODO: Not sure if we should have a reference to PreflightArgs here.
// Maybe these constants should be in config, and PreflightArgs can
// reference them from there as well.
use Drush\Preflight\PreflightArgs;
use Symfony\Component\Process\Process;

/**
 * Static Service Container wrapper.
 *
 * This code is analogous to the \Drupal class in Drupal 8.
 *
 * We would like to move Drush towards the model of using constructor
 * injection rather than globals. This class serves as a unified global
 * accessor to arbitrary services for use by legacy Drush code.
 *
 * Advice from Drupal 8's 'Drupal' class:
 *
 * This class exists only to support legacy code that cannot be dependency
 * injected. If your code needs it, consider refactoring it to be object
 * oriented, if possible. When this is not possible, and your code is more
 * than a few non-reusable lines, it is recommended to instantiate an object
 * implementing the actual logic.
 *
 * @code
 *   // Legacy procedural code.
 *   $object = drush_get_context('DRUSH_CLASS_LABEL');
 *
 * Better:
 *   $object = Drush::service('label');
 *
 * @endcode
 */
class Drush
{

    /**
     * The version of Drush from the drush.info file, or FALSE if not read yet.
     *
     * @var string|FALSE
     */
    protected static $version = false;
    protected static $majorVersion = false;
    protected static $minorVersion = false;

    /**
     * The Robo Runner -- manages and constructs all commandfile classes
     *
     * @var \Robo\Runner
     */
    protected static $runner;

    /**
     * Number of seconds before timeout for subprocesses. Can be customized via setTimeout() method.
     *
     * @var int
     */
    const TIMEOUT = 14400;

    /**
     * @return int
     */
    public static function getTimeout()
    {
        return self::TIMEOUT;
    }

    /**
     * Return the current Drush version.
     *
     * n.b. Called before the DI container is initialized.
     * Do not log, etc. here.
     */
    public static function getVersion()
    {
        if (!static::$version) {
            $drush_info = static::drushReadDrushInfo();
            static::$version = $drush_info['drush_version'];
        }
        return static::$version;
    }

    public static function getMajorVersion()
    {
        if (!static::$majorVersion) {
            $drush_version = static::getVersion();
            $version_parts = explode('.', $drush_version);
            static::$majorVersion = $version_parts[0];
        }
        return static::$majorVersion;
    }

    public static function getMinorVersion()
    {
        if (!static::$minorVersion) {
            $drush_version = static::getVersion();
            $version_parts = explode('.', $drush_version);
            static::$minorVersion = $version_parts[1];
        }
        return static::$minorVersion;
    }

    /**
     * Sets a new global container.
     *
     * @param \League\Container\Container $container
     *   A new container instance to replace the current.
     */
    public static function setContainer(ContainerInterface $container)
    {
        \Robo\Robo::setContainer($container);
    }

    /**
     * Unsets the global container.
     */
    public static function unsetContainer()
    {
        \Robo\Robo::unsetContainer();
    }

    /**
     * Returns the currently active global container.
     *
     * @return \League\Container\ContainerInterface|null
     *
     * @throws RuntimeException
     */
    public static function getContainer()
    {
        if (!\Robo\Robo::hasContainer()) {
            debug_print_backtrace();
            throw new \RuntimeException('Drush::$container is not initialized yet. \Drush::setContainer() must be called with a real container.');
        }
        return \Robo\Robo::getContainer();
    }

    /**
     * Returns TRUE if the container has been initialized, FALSE otherwise.
     *
     * @return bool
     */
    public static function hasContainer()
    {
        return \Robo\Robo::hasContainer();
    }

    /**
     * Get the current Symfony Console Application.
     *
     * @return Application
     */
    public static function getApplication()
    {
        return self::getContainer()->get('application');
    }

    /**
     * Return the Robo runner.
     *
     * @return \Robo\Runner
     */
    public static function runner()
    {
        if (!isset(static::$runner)) {
            static::$runner = new \Robo\Runner();
        }
        return static::$runner;
    }

    /**
     * Retrieves a service from the container.
     *
     * Use this method if the desired service is not one of those with a dedicated
     * accessor method below. If it is listed below, those methods are preferred
     * as they can return useful type hints.
     *
     * @param string $id
     *   The ID of the service to retrieve.
     *
     * @return mixed
     *   The specified service.
     */
    public static function service($id)
    {
        return static::getContainer()->get($id);
    }

    /**
     * Indicates if a service is defined in the container.
     *
     * @param string $id
     *   The ID of the service to check.
     *
     * @return bool
     *   TRUE if the specified service exists, FALSE otherwise.
     */
    public static function hasService($id)
    {
        // Check hasContainer() first in order to always return a Boolean.
        return static::hasContainer() && static::getContainer()->has($id);
    }

    /**
     * Return command factory
     *
     * @return \Consolidation\AnnotatedCommand\AnnotatedCommandFactory
     */
    public static function commandFactory()
    {
        return static::service('commandFactory');
    }

    /**
     * Return the Drush logger object.
     *
     * @return LoggerInterface
     */
    public static function logger()
    {
        return static::service('logger');
    }

    /**
     * Return the configuration object
     *
     * @return \Drush\Config\DrushConfig
     */
    public static function config()
    {
        return static::service('config');
    }

    /**
     * @return SiteAliasManager
     */
    public static function aliasManager()
    {
        return static::service('site.alias.manager');
    }

    /**
     * Return the input object
     *
     * @return InputInterface
     */
    public static function input()
    {
        return static::service('input');
    }

    /**
     * Return the output object
     *
     * @return OutputInterface
     */
    public static function output()
    {
        return static::service('output');
    }

    /**
     * Run a Drush command on a site alias (or @self).
     *
     * @param AliasRecord $siteAlias
     * @param string $command
     * @param array $args
     * @param array $options
     * @param array $options_double_dash
     * @return SiteProcess
     */
    public static function drush(AliasRecord $siteAlias, $command, $args = [], $options = [], $options_double_dash = [])
    {
        array_unshift($args, $command);
        return static::drushSiteProcess($siteAlias, $args, $options, $options_double_dash);
    }

    /**
     * drushSiteProcess should be avoided in favor of the drush method above.
     * drushSiteProcess exists specifically for use by the RedispatchHook,
     * which does not have specific knowledge about which argument is the command.
     *
     * @param AliasRecord $siteAlias
     * @param array $args
     * @param array $options
     * @param array $options_double_dash
     * @return ProcessBase
     */
    public static function drushSiteProcess(AliasRecord $siteAlias, $args = [], $options = [], $options_double_dash = [])
    {
        $defaultDrushScript = !$siteAlias->isLocal() ? 'drush' : static::drushScript();

        // Fill in the root and URI from the site alias, if the caller
        // did not already provide them in $options.
        if ($siteAlias->has('uri')) {
            $options += [ 'uri' => $siteAlias->uri(), ];
        }
        if ($siteAlias->hasRoot()) {
            $options += [ 'root' => $siteAlias->root(), ];
        }
        array_unshift($args, $siteAlias->get('paths.drush-script', $defaultDrushScript));

        return static::siteProcess($siteAlias, $args, $options, $options_double_dash);
    }

    /**
     * Run a bash fragment on a site alias. Use Drush::drush() instead of this
     * method when calling Drush.
     *
     * @param AliasRecord $siteAlias
     * @param array $args
     * @param array $options
     * @param array $options_double_dash
     * @return ProcessBase
     */
    public static function siteProcess(AliasRecord $siteAlias, $args = [], $options = [], $options_double_dash = [])
    {
        $process = new SiteProcess($siteAlias, $args, $options, $options_double_dash);
        return static::configureProcess($process);
    }

    /**
     * Run a bash fragment locally.
     *
     * The timeout parameter on this method doesn't work. It exists for compatibility with parent.
     * Call this method to get a Process and then call setters as needed.
     *
     * @param string|array   $commandline The command line to run
     * @param string|null    $cwd         The working directory or null to use the working dir of the current PHP process
     * @param array|null     $env         The environment variables or null to use the same environment as the current PHP process
     * @param mixed|null     $input       The input as stream resource, scalar or \Traversable, or null for no input
     * @param int|float|null $timeout     The timeout in seconds or null to disable
     * @param array          $options     An array of options for proc_open
     *
     * @return ProcessBase
     *   A wrapper around Symfony Process.
     */
    public static function process($commandline, $cwd = null, array $env = null, $input = null, $timeout = 60, array $options = null)
    {
        $process = new ProcessBase($commandline, $cwd, $env, $input, $timeout, $options);
        return static::configureProcess($process);
    }

    /**
     * configureProcess sets up a process object so that it is ready to use.
     */
    protected static function configureProcess(ProcessBase $process)
    {
        $process->setSimulated(Drush::simulate());
        $process->setVerbose(Drush::verbose());
        $process->inheritEnvironmentVariables();
        $process->setLogger(Drush::logger());
        $process->setRealtimeOutput(new DrushStyle(Drush::input(), Drush::output()));
        $process->setTimeout(self::getTimeout());
        return $process;
    }

    /**
     * Return the path to this Drush
     */
    public static function drushScript()
    {
        return \Drush\Drush::config()->get('runtime.drush-script', 'drush');
    }

    /**
     * Return 'true' if we are in simulated mode
     */
    public static function simulate()
    {
        return \Drush\Drush::config()->get(\Robo\Config\Config::SIMULATE);
    }

    /**
     * Return 'true' if we are in backend mode
     */
    public static function backend()
    {
        return \Drush\Drush::config()->get(PreflightArgs::BACKEND);
    }

    /**
     * Return 'true' if we are in affirmative mode
     */
    public static function affirmative()
    {
        if (!static::hasService('input')) {
            throw new \Exception('No input service available.');
        }
        return Drush::input()->getOption('yes') || (Drush::backend() && !Drush::negative());
    }

    /**
     * Return 'true' if we are in negative mode
     */
    public static function negative()
    {
        if (!static::hasService('input')) {
            throw new \Exception('No input service available.');
        }
        return Drush::input()->getOption('no');
    }

    /**
     * Return 'true' if we are in verbose mode
     */
    public static function verbose()
    {
        if (!static::hasService('output')) {
            return false;
        }
        return \Drush\Drush::output()->isVerbose();
    }

    /**
     * Return 'true' if we are in debug mode
     */
    public static function debug()
    {
        if (!static::hasService('output')) {
            return false;
        }
        return \Drush\Drush::output()->isDebug();
    }

    /**
     * Return the Bootstrap Manager.
     *
     * @return \Drush\Boot\BootstrapManager
     */
    public static function bootstrapManager()
    {
        return static::service('bootstrap.manager');
    }

    /**
     * Return the Bootstrap object.
     *
     * @return \Drush\Boot\Boot
     */
    public static function bootstrap()
    {
        return static::bootstrapManager()->bootstrap();
    }

    public static function redispatchOptions($input = null)
    {
        $input = $input ?: static::input();

        // $input->getOptions() returns an associative array of option => value
        $options = $input->getOptions();

        // The 'runtime.options' config contains a list of option names on th cli
        $optionNamesFromCommandline = static::config()->get('runtime.options');

        // Remove anything in $options that was not on the cli
        $options = array_intersect_key($options, array_flip($optionNamesFromCommandline));

        // Add in the 'runtime.context' items, which includes --include, --alias-path et. al.
        return $options + array_filter(static::config()->get(PreflightArgs::DRUSH_RUNTIME_CONTEXT_NAMESPACE));
    }

    /**
     * Read the drush info file.
     */
    private static function drushReadDrushInfo()
    {
        $drush_info_file = dirname(__FILE__) . '/../drush.info';

        return parse_ini_file($drush_info_file);
    }
}
