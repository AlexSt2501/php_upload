<?php
namespace samson\upload;

use samson\core\CompressableExternalModule;
use samson\core\iModuleViewable;

/**
 * SamsonPHP Upload module
 *
 * @package SamsonPHP
 * @author Vitaly Iegorov <egorov@samsonos.com>
 */
class UploadController extends CompressableExternalModule
{
    /** @var string Module identifier */
    public $id = 'samson_upload';

    /** @var string FileSystem adapter class name */
    public $adapterType = 'LocalAdapter';

    /** @var  array Collection of adapter specific parameters */
    public $adapterParameters = array();

    /** @var iAdapter Pointer to current file system adapter */
    public $adapter;

    /** @var  callable External handler to build relative file path */
    public $handler;

    /**
     * Initialize module
     * @param array $params Collection of module parameters
     * @return bool True if module successfully initialized
     */
    public function init(array $params = array())
    {
        // Check if NOT current Adapter is supported
        if (!class_exists($this->adapter)) {
            // Use default adapter
            $this->adapterType = 'LocalAdapter';
        }

        // Create adapter instance and pass all its possible parameters
        $this->adapter = new $this->adapterType($this->adapterParameters);

        // Call parent initialization
        parent::init($params);
    }
}