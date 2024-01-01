<?php

namespace App\Services;

class Uploader
{
    protected $file;
    protected $subPath;
    protected static $instance;
    protected $path;
    protected $url;

    static function getInstance($file=NULL, $subPath = NULL){
        if(!is_object(self::$instance)){
            self::$instance = new static($file, $subPath);
        }
        return self::$instance;
    }

    function __construct($file=NULL, $subPath = NULL){
        if($file){
            $this->__set("file", $file);
        }
        if($subPath){
            $this->__set("subPath", $subPath);
        }
    }

    function __set($var, $value){
        switch ($var){
            case "subPath":
                $this->path = storage_path("app\\public\\" . $value);
                if(!file_exists($this->path)){
                    throw new \Exception("Path {$this->path} is not valid!");
                }
                else if(!is_dir($this->path)){
                    throw new \Exception("Path {$this->path} is not a directory!");
                }
                break;

            case "file":
                $value = request()->file($value);
                break;

            default:
                throw new \Exception("Can't set value {$value} for var {$var}!");
                break;

        }
        $this->{$var} = $value;


    }

    function __get($var){
        switch ($var){
            case "url":

                break;

            case "path":

                break;

            default:
                throw new \Exception("var {$var} doesn't exist");
                break;
        }

        return $this->{$var};
    }



    function upload($file=NULL, $subPath = NULL){
        if($file){
            $this->__set("file", $file);
        }
        if($subPath){
            $this->__set("subPath", $subPath);
        }

        if(!is_object($this->file)){
            throw new \Exception("Uploadable file is not set");
        }

        if(!$this->path){
            //throw new \Exception("path is not set");
            $this->__set("subPath", "");
        }

        $this->file->store("public/{$this->subPath}");

        if(file_exists($this->path . "/" . $this->file->hashName())){
            $this->path .= "/" . $this->file->hashName();
            $this->url = asset("storage" . ($this->subPath) ? "/{$this->subPath}" : "");
            return $this->file->hashName();
        }
        else{
            throw new \Exception("Unable to upload file!");
        }

    }



}
