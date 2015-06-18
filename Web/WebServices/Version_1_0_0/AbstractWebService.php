<?php

namespace Web\WebServices\Version_1_0_0;

use MToolkit\Controller\MAbstractHttpHandler;

abstract class AbstractWebService extends MAbstractHttpHandler
{

    private $result = true;
    private $resultDescription = null;
    private $requestId = null;
    private $webServiceName = null;
    private $responseKey = null;
    private $responseValue = null;

    public function run()
    {
        $this->requestId = $this->getPost()->getValue("requestId");

        $this->exec();

        $responseArray = array(
            "WebService" => $this->webServiceName
            , "ResponseId" => $this->requestId
            , "Result" => $this->result
            , "ResultDescription" => $this->resultDescription
        );

        // Aggiunge la response custom del servizio se settata
        if ($this->responseKey != null)
        {
            $responseArray[$this->responseKey] = $this->responseValue;
        }

        $this->setOutput(json_encode($responseArray));
    }

    public function setResponse($key, array $value)
    {
        MDataType::mustBeString($key);

        $this->responseKey = $key;
        $this->responseValue = $value;
    }

    public abstract function exec();

    public function getResult()
    {
        return $this->result;
    }

    public function getResultDescription()
    {
        return $this->resultDescription;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function getWebServiceName()
    {
        return $this->webServiceName;
    }

    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    public function setResultDescription($resultDescription)
    {
        $this->resultDescription = $resultDescription;
        return $this;
    }

    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
        return $this;
    }

    public function setWebServiceName($webServiceName)
    {
        $this->webServiceName = $webServiceName;
        return $this;
    }

    protected function objectToArray($obj)
    {
        if (is_object($obj))
        {
            $obj = (array) $obj;
        }

        if (is_array($obj))
        {
            $new = array();

            foreach ($obj as $key => $val)
            {
                $new[$key] = $this->objectToArray($val);
            }
        }
        else
        {
            $new = $obj;
        }

        return $new;
    }

}
