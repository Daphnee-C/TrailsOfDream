<?php 

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\HikingModel;
use App\Models\ArticlesModel;


class AdminController extends MainController
{
    public function renderAdmin():void
    {
        $this->checkUserAuthorization(1);

       // La vue à rendre est admin. On la passe dans notre propriété viewType du controller parent
        $this->viewType = 'admin';
        // On vérifie si subPage existe
        if (isset($this->subPage)) {
            // si subPage existe, on modifie la propriété viewType du controller parent
            $this->view = $this->subPage;
            // si la view demandée === update
        } 
        
            // Sinon s'il n'ya pas de sous-page, on stocke dans la propriété data tous les articles pour les afficher dans la vue admin            
            $this->data['posts'] = HikingModel::getPosts();
       

        //  dans tous les cas on appelle la méthode render du controller parent pour construire la page
        $this->render();
    }
        
   

}