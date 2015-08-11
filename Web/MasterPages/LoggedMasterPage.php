<?php

namespace Web\MasterPages;

use MToolkit\Controller\MAbstractMasterPageController;
use BusinessLogic\GoogleApiServices\GoogleApiServices;
use MToolkit\Network\MNetworkSession;
use BusinessLogic\Enum\Session;
use MToolkit\Core\MDataType;

class LoggedMasterPage extends MAbstractMasterPageController
{
    /**
     * @var GoogleApiServices
     */
    private $googleService;
    
    private $userInfo;
    
    public function __construct( $parent )
    {
        parent::__construct( __DIR__ . '/LoggedMasterPage.view.php', $parent );
    }

    public function init()
    {
        $this->googleService=new GoogleApiServices(
            MNetworkSession::get( Session::GOOGLE_ACCESS_TOKEN )
            , MNetworkSession::get( Session::GOOGLE_TOKEN_ID )
            , MNetworkSession::get( Session::GOOGLE_CREATED )
            , MNetworkSession::get( Session::GOOGLE_TOKEN_TYPE )
            , MNetworkSession::get( Session::GOOGLE_EXPIRES_IN )
        );
        
        // Controlla se il token di Google è valido
        if( $this->googleService->isValidToken()===false )
        {
            echo "Invalid Token";
            
            $currentFile = $_SERVER["PHP_SELF"];
            $parts = Explode('/', $currentFile);
            $currentPage= $parts[count($parts) - 1];
            
            $this->logout("currentPage=".$currentPage);
        }
        
        $this->userInfo=$this->googleService->userInfo();
        
//        var_dump($this->userInfo);
        
        // Fa il logout solo se è in postback
        if( parent::isPostBack() )
        {
            if( parent::getPost()->getValue( 'logout_button' )!=null )
            {
                $this->logout();
            }
        }
        
        // Se è valorizzata currentPage in query string allora rendirizza l'utente alla pagina
        $currentPage=$this->getGet()->getValue( "currentPage" );
        if( $currentPage!=null )
        {
            $this->getHttpResponse()->redirect( $currentPage );
        }
    }
    
    /**
     * Restituisce il nome dell'utente connesso.
     * 
     * @return string
     */
    public function getUserName()
    {
        return $this->userInfo['displayName'];
    }
    
    /**
     * Restituisce l'url dell'avatar dell'utente connesso.
     * 
     * @return string
     */
    public function getUserAvatar()
    {
        return $this->userInfo['image']['url'];
    }
    
    public function getUserCoverPhoto()
    {
        return $this->userInfo['cover']['coverPhoto']['url'];
    }
    
    /**
     * @param string $queryString
     */
    public function logout($queryString="")
    {
        MDataType::mustBeString($queryString);
     
        $this->googleService->revokeToken( MNetworkSession::get(Session::GOOGLE_ACCESS_TOKEN) );
        $this->getHttpResponse()->redirect('Login.php?'.$queryString);
    }
}
