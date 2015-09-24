<?php 
namespace JSONlite;

use Rhumsaa\Uuid\Uuid;
use Rhumsaa\Uuid\Exception\UnsatisfiedDependencyException;

class JSONlite
{
    /**
     * Path to folder store jsonlite files
     * @var string
     */
    public $dataPath    = './jsonlite.data';

    /**
     * Version of this package
     * @var string
     */
    public $version     = '0.4.2';

    /**
     * Set object with Auto document_id
     * @param mixed $object Receive object to store
     * @return string Return string with $document_id
     */
    public function set($object, $document_id=null)
    {
        if (is_null($document_id) || !Uuid::isValid($document_id)) {
            $document_id = strtoupper(Uuid::uuid1());
        }

        $this->resolvePath($this->dataPath);

        file_put_contents($this->dataPath.DIRECTORY_SEPARATOR.$document_id, json_encode($object, JSON_PRETTY_PRINT), LOCK_EX);

        return $document_id;
    }

    /**
     * Get object from document id
     * @param  string $document_id  Idenfifier to get document
     * @return mixed                Return a object when found, else NULL
     */
    public function get($document_id)
    {
        if (is_null($document_id) || !Uuid::isValid($document_id)) 
            return null;

        if (file_exists($file = $this->dataPath.DIRECTORY_SEPARATOR.$document_id))
            return json_decode(file_get_contents($file));

        return null;
    }

    /**
     * Delete object from database
     * @param  string $document_id Identifier to delete document
     * @return boolean             Return TRUE if delete, else, FALSE
     */
    public function delete($document_id)
    {
        if (is_null($document_id) || !Uuid::isValid($document_id)) 
            return false;

        if (file_exists($file = $this->dataPath.DIRECTORY_SEPARATOR.$document_id))
            return unlink($file);

        return false;
    }
    
    /**
     * Drop database
     * @return boolean Return TRUE if database dropped, else FALSE
     */
    public function drop()
    {
        return rmdir($this->dataPath);

    }

    /**
     * Return version of Package
     * @return string Return a string with version
     */
    public function version()
    {
        return $this->version;
    }

    /**
     * Define path to storage database
     * @param string $path Path to folder database. Like: './database/jsonlite.data/'
     */
    public function setDataPath($path)
    {
        if (!$this->checkPath($path)) {
            throw new Exception("Path is not writeable: {$path}", 1);
        }
                
        $this->dataPath = $path;
    }

    /**
     * Check if path folder database is dir and writeable
     * @param  string $path Path to folder database
     * @return boolean       Return TRUE if everything ok, else FALSE
     */
    public function checkPath($path)
    {
        return (bool) is_string($path) && is_dir($path) && is_writable($path);
    }

    /**
     * Auto create folder if not exists
     * @param  string $path Path to folder database
     * @return boolean       Return TRUE if created, else FALSE
     */
    public function resolvePath($path)
    {
        if (!$this->checkPath($path)) {
            return mkdir($path, 0777, true);
        }
    }

}